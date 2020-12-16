<?php
/**
 * Created by PhpStorm.
 * User: Seyni FAYE
 * Date: 27/02/2017
 * Time: 16:03
 */

namespace app\models;

use app\core\BaseModel;
use app\core\Utils;

class encaissementModel extends BaseModel
{

    private $params;
    /**
     * HomeModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->params['headers'] = ["token"=>$this->_USER->token];
    }

    /**
     * HomeModel destruct.
     */
    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * @param $param
     * @return bool|mixed
     */

      /**
     * Ajout Encaissement
     */
    public function insertEncaissement($param)
    {
        $this->table = "caisse_marchand";
        $this->__addParam($param);
        return $this->__insert();
    }
    /**
     * Lister encaissement
     */
    public function getAllEncaissement($param = null)
    {

        $this->params["data"]["params"] = json_encode([
            "table"=>"mar_caisse",
            "champs"=>["id","codemarchand","numcaisse","etat"],
            "condition"=>["marchand_id = " =>$this->_USER->marchand_id],
            "request"=>$_REQUEST
        ]);
        $result = $this->apiClient::get(MS_GATEWAY."processing/processing", $this->params);
        $result->data = Utils::array_recursive_convert($result->data);
      //  var_dump($result->data);die;
        return $result->data;
    }

    public function getEncaissement($param = null)
    {
        $this->table = "caisse_marchand";
        $this->__addParam($param);
        return $this->__select();
    }
    public function getOneEncaissement($param = null)
    {
        $this->table = "caisse_marchand";
        $this->__addParam($param);
        return $this->__detail();
    }

    /**
     * recuperer max numcaisse encaissement
     */
    public function getMaxNumCaisse()
    {
        //$numcaiss="0001";
        $this->table = "caisse_marchand";
        $this->champs = ["numcaisse"];
        $this->condition = ["fk_marchand = " =>$this->_USER->fk_marchand];
        $this->sort=["rowid", "DESC"];
        /*if($this->__detail()->num == '') {
            return $numcaiss;
        }else{*/
            return $this->__select();
        /*}*/
    }
    /**
     * Modification Encaissement
     */
    public function updateEncaissement($param)
    {
        $this->table = "caisse_marchand";
        $this->__addParam($param);
        return $this->__update();
    }
    /**
     * Suppression caisse_marchand
     */
    public function deleteEncaissement($param)
    {
        $this->table = "caisse_marchand";
        $this->__addParam($param);
        return $this->__delete();
    }

    /************************************ Generer code marchand ***********************************/
    public function Generer_codeMarchand()
    {
        $found = 0;
        while ($found == 0) {
            $code_carte = rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9);
            $colname_rq_code_existe = $code_carte;
            $this->table = "caisse_marchand";
            $this->champs = ["rowid"];
            $this->condition=["codemarchand ="=>$colname_rq_code_existe];
            $count = count($this->__select());
            if($count == 0){
                $code_generer = $code_carte;
                $found = 1;
                return $code_generer;

            }
        }


    }


    public function getMarchandCaisse($param)
    {
        $this->table = "caisse_marchand c";
        $this->champs = ["m.nom_marchand","m.email","c.numcaisse"];
        $this->jointure = [
            "INNER JOIN marchand m ON m.idmarchand = c.fk_marchand"
        ];
        $this->condition = ["c.rowid = " =>$param];
        return $this->__detail();
    }
}