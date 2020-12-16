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

class UtilisateursModel extends BaseModel
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
     * Ajout user_marchand
     */
    public function insertUtilisateurs($param)
    {
        $this->params["data"]=$param;
        $result = $this->apiClient::post(MS_GATEWAY."administration/users/user", $this->params);
       return $result->code;
    }
    /**
     * Lister Utilisateurs
     */
    public function getAllUtilisateurs($param = null)
    {
        $this->params["data"]["params"] = json_encode([
            "table"=>"utilisateur",
            "champs"=>["id","prenom","nom","email","telephone","etat"],
            "condition"=>["marchand_id = " =>$this->_USER->marchand_id,"etat != " =>2],
            "request"=>$_REQUEST
        ]);
        $result = $this->apiClient::get(MS_GATEWAY."processing/processing", $this->params);
        $result->data = Utils::array_recursive_convert($result->data);
        return $result->data;
    }

    public function getUtilisateurs($param = null)
    {
        $this->table = "user_marchand";
        $this->__addParam($param);
        return $this->__select();
    }
    public function getOneUtilisateurs($param = null)
    {
        $this->table = "user_marchand";
        $this->__addParam($param);
        return $this->__detail();
    }
    /**
     * Modification Utilisateurs
     */
    public function updateUtilisateurs($param)
    {
        $this->table = "user_marchand";
        $this->__addParam($param);
        return $this->__update();
    }
    /**
     * Suppression Utilisateurs
     */
    public function deleteUtilisateurs($param)
    {
        $this->table = "user_marchand";
        $this->__addParam($param);
        return $this->__delete();
    }

    /**
     * Vérifier si email existe déjà
     */
    public function verifEmailModel($email)
    {
        $this->table = "user_marchand";
        $this->champs = ["iduser"];
        $this->condition=["email ="=>$email];
        $count = count($this->__select());
        if($count > 0) return 1;
        else return -1;
    }

    /**
     * Lister profil
     */
    public function getAllProfils($param = null)
    {
       $this->params["data"] = [ "request"=> \json_encode($_REQUEST)];
        $recup_id=$this->_USER->id;
        $result = $this->apiClient::get(MS_GATEWAY."administration/profil/profil", $this->params);
        return $result->data;
    }
}