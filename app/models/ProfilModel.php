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

class ProfilModel extends BaseModel
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

    function getListeProfilProcess() {

        $this->params["data"]["params"] = json_encode([
            "table"=>"profil",
            "champs"=>["id","libelle","etat"],
            "condition"=>["marchand_id = " =>$this->_USER->marchand_id],
            "request"=>$_REQUEST
        ]);
        $result = $this->apiClient::get(MS_GATEWAY."processing/processing", $this->params);
        $result->data = Utils::array_recursive_convert($result->data);
        //var_dump($result->data);
        return $result->data;
    }

    function updateDist($param) {
        $this->table = "profil_marchand";
        $this->__addParam($param);
        return $this->__update();
    }


    public function getModules()
    {
        $this->table = "module_marchand";
        $this->champs = ["rowid", "label", "etat"];
        $this->condition = ["etat ="=>1];
        return $this->__select();
    }

    public function getActions($module)
    {
        $this->params["data"] = [ "request"=> \json_encode($_REQUEST)];
        $recup_id=$this->_USER->id;
        $result = $this->apiClient::get(MS_GATEWAY."administration/droit/droit?", $this->params);
        // var_dump($result);die;
        return $result->data;
    }

    public function getAffectations($profil, $action)
    {
        $this->table = "affectation_droit ad";
        $this->champs = ["ad.id", "ad.etat"];
        $this->jointure = ["INNER JOIN profil p ON ad.profil_id = p.id"];
        $this->condition = ["profil_id ="=>$profil, "droit_id ="=>$action, "p.marchand_id ="=>$this->_USER->marchand_id];
        return $this->__select();
    }


    public function updateDroitProfil($param)
    {
        $this->table = "affectation_marchand";
        $this->__addParam($param);
        return $this->__update();
    }

    /**
     * Suppression profil_marchand
     */
    public function deleteModule($param)
    {
        $this->table = "profil_marchand";
        $this->__addParam($param);
        return $this->__delete();
    }

    public function deleteAffectation($param)
    {
        $this->table = "affectation_marchand";
        $this->__addParam($param);
        return $this->__delete();
    }


    public function getAllTypeProfils()
    {
        $this->params["data"] = [ "request"=> \json_encode($_REQUEST)];
        $recup_id=$this->_USER->id;
        $result = $this->apiClient::get(MS_GATEWAY."administration/type_profil/type_profil", $this->params);
       // var_dump($result);die;
        return $result->data;
    }

}