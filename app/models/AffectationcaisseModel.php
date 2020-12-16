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

class affectationcaisseModel extends BaseModel
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
     * Liste Caisse
     */

    public function getCaisse($param = null)
    {
        $this->params["data"] = [ "request"=> \json_encode($_REQUEST)];
        $recup_id=$this->_USER->marchand_id;
        $result = $this->apiClient::get(MS_GATEWAY."accepteur/caisse/liste-caisse?where=marchand_id|e|$recup_id", $this->params);
        return $result->data;
    }
    /**
     * Liste caissier
     */
    public function getCaissier($param = null)
    {
        $this->params["data"] = [ "request"=> \json_encode($_REQUEST)];
        $recup_id=$this->_USER->marchand_id;
        $result = $this->apiClient::get(MS_GATEWAY."administration/users/user?where=marchand_id|e|$recup_id", $this->params);
       // var_dump($result->data);die;
        return $result->data;
    }
    /**
     * Ajout Affectation
     */
    public function insertAffectationcaisse($param)
    {
        $this->table = "affectation_caisse_marchand";
        $this->champs = $param;
        return $this->__insert();
    }

    public function getAffectationcaisse($param = null)
    {
        $this->table = "affectation_caisse_marchand a";
        $this->champs = ["a.rowid as id","a.date_affect","a.heure_debut","a.heure_fin","concat(u.prenom, ' ', u.nom) as nom_user","c.numcaisse","a.fk_idcaisse","a.fk_usermarchand"];
        $this->jointure = [
            "INNER JOIN user_marchand u ON a.fk_usermarchand = u.iduser",
            "INNER JOIN caisse_marchand c ON c.rowid = a.fk_idcaisse"
        ];
        $this->__addParam($param);
        return $this->__detail();
    }
  public function verifCaisse($param = null)
    {
        //var_dump($param);exit;
        $this->table = "affectation_caisse_marchand";
        $this->champs = ["rowid","date_affect","heure_debut","heure_fin","fk_idcaisse","fk_usermarchand"];
        $this->__addParam($param);
        return $this->__detail();
    }


   /* public function getCountAffectationcaisse($param = null)
    {
        $this->table = "affectation_caisse_marchan";
        $this->champs = ["Count(rowid) as nbre","a.date_affect","a.heure_debut","a.heure_fin"];
        $this->__addParam($param);
        return $this->__detail()->nbre;
    }*/

    public function getcalendarAffectation($param = null)
    {
        $this->table = "affectation_caisse_marchand a";
        $this->champs = ["a.rowid as id","a.date_affect","a.heure_debut","a.heure_fin","u.prenom","u.nom","c.numcaisse"];
        $this->jointure = [
            "INNER JOIN user_marchand u ON a.fk_usermarchand = u.iduser",
            "INNER JOIN caisse_marchand c ON c.rowid = a.fk_idcaisse"
        ];
        $this->__addParam($param);
        return $this->__select();
    }

    /**
     * get user
     */
    public function getOneuser($param = null)
    {
        $this->params["data"] = [ "request"=> \json_encode($_REQUEST)];
        $recup_id=$this->_USER->marchand_id;
        $result = $this->apiClient::get(MS_GATEWAY."administration/users/user?where=id|e|$param", $this->params);
        return $result->data;
    }

}