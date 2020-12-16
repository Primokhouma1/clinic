<?php
/**
 * Created by PhpStorm.
 * User: Seyni FAYE
 * Date: 17/08/2017
 * Time: 11:01
 */

namespace app\core;

use app\common\CommonModel;

abstract class BaseModel
{
    protected $_USER     = null;
    protected $appConfig = null;
    protected $connexion = null;
    protected $table     = null;
    protected $db_prefix = null;
    protected $jointure  = [];
    protected $champs    = [];
    protected $value     = [];
    protected $condition = [];
    protected $filter    = [];
    protected $sort      = [];
    protected $limit     = [];
    protected $group     = [];

    protected function __construct()
    {
        try {
            if ($this->connexion === null) {
                $this->appConfig = (object)\parse_ini_file(ROOT . 'config/app.config.ini');
                extract(parse_ini_file(ROOT . 'config/db.config.ini'));
                $this->_USER = (Session::existeAttribut(SESSIONNAME)) ? Session::getAttributArray(SESSIONNAME)[0] : null;
                $dsn = $DB_TYPE . ':dbname=' . $DB_NAME . ';host=' . $DB_HOST;
                $this->db_prefix = (isset($DB_PREFIX)) ? $DB_PREFIX : "";

                $this->connexion = new \PDO($dsn, $DB_USER, $DB_PASSWORD='kqT4Tozr!bvuU', [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
                $this->connexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            }
        } catch (\PDOException $ex) {
            Utils::setMessageError(["sql","<div class='text-center'>Erreur de connexion à la base de donnée ! Error : ".$ex->getMessage()." <br/>".$ex->getFile()." - ".$ex->getLine()."</div>"]);
        }
    }

    /**
     * Detruit la connexion à la BD
     */
    protected function __destruct()
    {
        $this->connexion = null;
        $this->__reset();
    }

    /**
     * @param string $return
     * @return array|bool
     */
    protected function __select($return = 'object')
    {
        $requete = null;
        if (!\is_null($this->table)) {
            $requete = "SELECT * ";

            if (count($this->champs) > 0) $requete = "SELECT " . implode(",", $this->champs);

            $requete .= " FROM " . $this->db_prefix . $this->table." ";

            if (count($this->jointure) > 0) $requete .= implode(" ", $this->jointure)." ";

            if (count($this->condition) > 0) {
                if(count($this->value) == 0){
                    $this->value = array_values($this->condition);
                    $this->condition = array_map(function($one){return $one = $one. ' ?';},array_keys($this->condition));
                }
                $requete .= " WHERE " .implode(" AND ", $this->condition);
            }

            if (count($this->group) > 0)
                $requete .= " GROUP BY ".implode(", ", $this->group);

            if (count($this->sort) > 0)
                $requete .= (count($this->sort) === 1) ? " ORDER BY ".$this->sort[0]." ASC" : " ORDER BY ".$this->sort[0]." ".$this->sort[1];

            if (count($this->limit) > 0)
                $requete .= (count($this->limit) === 1) ? " LIMIT 0, ".$this->limit[0] : " LIMIT ".$this->limit[0]." ,".$this->limit[1];
        }

        if (!\is_null($requete)) {
            try {
                $resultat = $this->connexion->prepare($requete);
                $resultat->execute($this->value);
                $this->__reset();
                return ($return == 'array') ? $resultat->fetchAll(\PDO::FETCH_ASSOC) : $resultat->fetchAll(\PDO::FETCH_OBJ);
            } catch (\PDOException $ex) {
                Utils::setMessageError(['sql',$requete." ** ".implode("; ",$this->value)." ** ".$ex->getMessage()."<br/>".$ex->getTrace()[2]['file']." - ".$ex->getTrace()[2]['line']."<br/>".$ex->getTrace()[1]['file']." - ".$ex->getTrace()[1]['line']]);
                $this->__reset();
                return false;
            }
        }
        $this->__reset();
        return false;
    }

    /**
     * @return bool|mixed
     */
    protected function __detail()
    {
        $result = $this->__select();
        return (count($result)>0) ? $result[0] : false;
    }

    /**
     * @return bool|mixed
     */
    protected function __insert()
    {
        $requete = false;
        if (!\is_null($this->table) && \count($this->champs) > 0) {
            if($this->table !== "logs") {
                $description = "champ : [ ".implode(" ** ",array_keys($this->champs))." ] valeur : [ ";
                $description .= implode(" ** ",$this->champs)." ]";
            }
            $this->value = array_values($this->champs);
            $this->champs = array_keys($this->champs);
            $requete = "INSERT INTO " . $this->db_prefix . $this->table . " (" . implode(',', $this->champs) . ") VALUES (";
            $temp = []; foreach($this->value as $item) array_push($temp, "?");
            $requete .= implode(',', $temp) . ")";
            try {
                $resultat = $this->connexion->prepare($requete);
                $resultat = $resultat->execute($this->value);
                $lastInsertId  = $this->connexion->lastInsertId();
                if(isset($description) && $this->table !== "logs") $paramLogs = ["action"=>"insert","currenttable"=>$this->table,"description"=>$description,"currentid"=>$lastInsertId, "result"=>1];
                $this->__reset();
                if(isset($paramLogs) && $this->table !== "logs" && $this->appConfig == "on") $resultat = $this->__logs($paramLogs);
                return ($resultat !== 0) ? $lastInsertId : false;
            }catch (\PDOException $ex) {
                Utils::setMessageError(['sql',$requete." ** ".implode("; ",$this->value)." ** ".$ex->getMessage()."<br/>".$ex->getTrace()[2]['file']." - ".$ex->getTrace()[2]['line']."<br/>".$ex->getTrace()[1]['file']." - ".$ex->getTrace()[1]['line']]);
                if(isset($description) && $this->table !== "logs" && $this->appConfig == "on") {
                    $paramLogs = ["action"=>"insert","currenttable"=>$this->table,"description"=>$description,"currentid"=>$this->connexion->lastInsertId(),"result"=>0,"iduser"=>$this->_USER->id];
                    $this->__logs($paramLogs);
                }
                $this->__reset();
                return false;
            }
        }
        $this->__reset();
        return $requete;
    }

    /**
     * @return bool|mixed
     */
    protected function __update()
    {
        $requete = false;
        if (!\is_null($this->table) && \count($this->champs) > 0 && \count($this->condition) > 0) {
            if($this->table !== "logs") {
                $description  = "champ : [ ".implode(" ** ",array_keys($this->champs))." ] valeur : [ ";
                $description .= implode(" ** ",$this->champs)." ]";
            }

            if(count($this->value) == 0){
                $this->value = array_values($this->champs);
                $valueCond = array_values($this->condition);
                $this->condition = array_map(function($one){return $one = $one. '?';},array_keys($this->condition));
            }else $this->value = array_merge(array_values($this->champs), $this->value);

            $requete = "UPDATE " . $this->db_prefix . $this->table . " SET ";
            $this->champs = array_map(function($one){return $one = (count(explode('=',$one)) > 1) ? $one. ' ?' : $one. ' = ?';},array_keys($this->champs));
            $requete .= implode(',', $this->champs)."  WHERE " .implode(" AND ", $this->condition);

            $this->value = (isset($valueCond)) ? array_merge($this->value, $valueCond) : $this->value;

            try {
                $resultat = $this->connexion->prepare($requete);
                $resultat = $resultat->execute($this->value);
                if(isset($description) && $this->table !== "logs") $paramLogs = ["action"=>"update","currenttable"=>$this->table,"description"=>$description,"currentid"=>$this->connexion->lastInsertId(),"result"=>1,"iduser"=>$this->_USER->id];
                $this->__reset();
                if(isset($paramLogs) && $this->table !== "logs" && $this->appConfig == "on") $this->__logs($paramLogs);

                return $resultat;
            } catch (\PDOException $ex) {
                Utils::setMessageError(['sql',$requete." ** ".implode("; ",$this->value)." ** ".$ex->getMessage()."<br/>".$ex->getTrace()[2]['file']." - ".$ex->getTrace()[2]['line']."<br/>".$ex->getTrace()[1]['file']." - ".$ex->getTrace()[1]['line']]);
                if(isset($description) && $this->table !== "logs" && $this->appConfig == "on") {
                    $paramLogs = ["action"=>"update","currenttable"=>$this->table,"description"=>$description,"currentid"=>$this->connexion->lastInsertId(),"result"=>0,"iduser"=>$this->_USER->id];
                    $this->__logs($paramLogs);
                }
                $this->__reset();
                return false;
            }
        }
        $this->__reset();
        return $requete;
    }

    /**
     * @return null|string
     */
    protected function __delete()
    {
        $requete = false;
        if (!\is_null($this->table) && \count($this->condition) > 0 ) {
            if($this->table !== "logs") {
                $description  = "champ : [ ".implode(" ** ",array_keys($this->condition))." ] valeur : [ ";
                $description .= implode(" ** ",$this->condition)." ]";
            }
            $requete = "DELETE FROM " . $this->db_prefix . $this->table;

            if(count($this->value) == 0){
                $this->value = array_values($this->condition);
                $this->condition = array_map(function($one){return $one = $one. ' ?';},array_keys($this->condition));
            }
            $requete .= " WHERE " .implode(" AND ", $this->condition);

            try {
                $resultat = $this->connexion->prepare($requete);
                $resultat = $resultat->execute($this->value);
                if(isset($description) && $this->table !== "logs") $paramLogs = ["action"=>"delete","currenttable"=>$this->table,"description"=>$description,"currentid"=>$this->connexion->lastInsertId(),"result"=>1,"iduser"=>$this->_USER->id];
                $this->__reset();
                if(isset($paramLogs) && $this->table !== "logs" && $this->appConfig == "on") $resultat = $this->__logs($paramLogs);

                return $resultat;
            } catch (\PDOException $ex) {
                Utils::setMessageError(['sql',$requete." ** ".implode("; ",$this->value)." ** ".$ex->getMessage()."<br/>".$ex->getTrace()[2]['file']." - ".$ex->getTrace()[2]['line']."<br/>".$ex->getTrace()[1]['file']." - ".$ex->getTrace()[1]['line']]);
                $this->__reset();
                return false;
            }
        }
        $this->__reset();
        return $requete;
    }

    /**
     * @return bool|mixed
     */
    protected function __processing()
    {
        $requete = null;
        $requeteCount = null;
        if (!\is_null($this->table)) {
            $requete = "SELECT * ";

            if (count($this->champs) > 0){
                $requete = "SELECT " . implode(",", $this->champs);
                $requeteCount = "SELECT COUNT(".explode(" as ",$this->champs[0])[0].") AS total";
            }
            $requete .= " FROM " . $this->db_prefix . $this->table." ";
            $requeteCount .= " FROM " . $this->db_prefix . $this->table." ";

            if (count($this->jointure) > 0){
                $requete .= implode(" ", $this->jointure)." ";
                $requeteCount .= implode(" ", $this->jointure)." ";
            }

            unset($this->champs[0]);

            $this->champs = array_map(function($one){return $one = explode(" as ",$one)[0];},array_values($this->champs));

            if (count($this->condition) > 0){
                if(count($this->value) == 0){
                    $this->value = array_values($this->condition);
                    $this->condition = array_map(function($one){return $one = $one. ' ?';},array_keys($this->condition));
                }
                $requete .= "  WHERE " .implode(" AND ", $this->condition);
                $requeteCount .= "  WHERE " .implode(" AND ", $this->condition);
                if ($_REQUEST['search']['value'] != ""){
                    $requete .= " AND (" .implode(" LIKE ? OR ", $this->champs) ." LIKE ? )" ;
                    $requeteCount .= " AND (" .implode(" LIKE ? OR ", $this->champs) ." LIKE ? )" ;
                    foreach ($this->champs as $item) array_push($this->value,"%".$_REQUEST['search']['value']."%");
                }
            }elseif ($_REQUEST['search']['value'] != ""){
                $requete .= " WHERE (" .implode(" LIKE ? OR ", $this->champs) ." LIKE ? )" ;
                $requeteCount .= " WHERE (" .implode(" LIKE ? OR ", $this->champs) ." LIKE ? )" ;
                foreach ($this->champs as $item) array_push($this->value,"%".$_REQUEST['search']['value']."%");
            }
        }

        if (count($this->group) > 0){
            $requete .= " GROUP BY ".implode(", ", $this->group);
            $requeteCount .= " GROUP BY ".implode(", ", $this->group);
        }

        if(Session::existeAttribut("default_sort")) {
            $this->sort = Session::getAttributArray("default_sort");
            Utils::unsetDefaultSort();
        };

        if(count($this->sort) > 0) {
            $_REQUEST['order'][0]['column'] = intval($this->sort[0]) - 1;
            $_REQUEST['order'][0]['dir'] = $this->sort[1];
        }

        $requete.= (intval($_REQUEST['order'][0]['column']) < count($this->champs)) ?
            " ORDER BY ".$this->champs[$_REQUEST['order'][0]['column']]." ".strtoupper($_REQUEST['order'][0]['dir']):
            " ORDER BY ".$this->champs[0]." ".strtoupper($_REQUEST['order'][0]['dir']);

        $requete .= " LIMIT ".$_REQUEST['start']." ,".$_REQUEST['length'];

        if (!\is_null($requete)) {
            try {
                $resultat = $this->connexion->prepare($requete);
                (count($this->value) > 0) ? $resultat->execute($this->value) : $resultat->execute();

                $total = $this->connexion->prepare($requeteCount);
                (count($this->value) > 0) ? $total->execute($this->value) : $total->execute();

                $this->__reset();

                return [$resultat->fetchAll(\PDO::FETCH_ASSOC), $total->fetchAll(\PDO::FETCH_OBJ)[0]->total];
            } catch (\PDOException $ex) {
                $this->__reset();
                Utils::setMessageError(['sql',$requete." ** ".implode("; ",$this->value)." ** ".$ex->getMessage()."<br/>".$ex->getTrace()[2]['file']." - ".$ex->getTrace()[2]['line']."<br/>".$ex->getTrace()[1]['file']." - ".$ex->getTrace()[1]['line']]);
                return $requete." ** ".implode("; ",$this->value)." ** ".$ex->getMessage()." - ".$ex->getTrace()[2]['file']." - ".$ex->getTrace()[2]['line']." - ".$ex->getTrace()[1]['file']." - ".$ex->getTrace()[1]['line'];
            }
        }
        $this->__reset();
        return false;
    }

    private function __reset()
    {
        $this->table     = null;
        $this->jointure  = [];
        $this->champs    = [];
        $this->value     = [];
        $this->condition = [];
        $this->sort      = [];
        $this->limit     = [];
        $this->group     = [];
    }

    private function __logs($param)
    {
        $param['iduser'] = $this->_USER->id;
        $this->table = "logs";
        $this->champs = $param;
        $this->__insert();
        Utils::writeFileLogs(implode(" ** ",$param));
        return $param['currentid'];
    }

    protected function __beginTransaction()
    {
        $this->connexion->beginTransaction();
    }

    protected function __commit()
    {
        $this->connexion->commit();
    }

    protected function __rollBack()
    {
        $this->connexion->rollBack();
    }

    protected function __addParam($param)
    {
        if(isset($param['table'])) $this->table = $param['table'];
        if(count($param['jointure']) > 0) $this->jointure = $param['jointure'];
        if(count($param['champs']) > 0) $this->champs = $param['champs'];
        if(count($param['condition']) > 0) $this->condition = $param['condition'];
        if(count($param['value']) > 0) $this->value = $param['value'];
        if(count($param['sort']) > 0) $this->sort = $param['sort'];
        if(count($param['limit']) > 0) $this->limit = $param['limit'];
        if(count($param['group']) > 0) $this->group = $param['group'];
    }

   /* public function __authorized($profil, $controller, $action)
    {
        $this->table = "affectation_droit ad";
        $this->champs =['d.id'];
        $this->jointure = [
            "INNER JOIN profil p ON ad.fk_profil = p.id",
            "INNER JOIN droit d ON ad.fk_droit = d.id"
        ];
        $this->condition = ["p.id ="=>$profil,"d.controller ="=>$controller,"d.action ="=>$action,"p.etat ="=>1,"d.etat ="=>1,"ad.etat ="=>1];
        return (count($this->__select()) > 0);
    }*/

    use CommonModel;
}