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

class actionModel extends BaseModel
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
     * Ajout Action
     */
    public function insertAction($param)
    {
        $this->table = "action_marchand";
        $this->__addParam($param);
        return $this->__insert();
    }
    /**
     * Lister action
     */
    public function getAllAction($param = null)
    {
        $this->params["data"]["params"] = json_encode([
            "table"=>"droit a",
            "champs"=>["a.id","a.libelle","a.controller","m.libelle as lib","a.etat"],
            "jointure" => [
                "INNER JOIN sous_module m ON a.sous_module_id = m.id"
            ],
            //"condition"=>["marchand_id = " =>$this->_USER->id],
            "request"=>$_REQUEST
        ]);
        $result = $this->apiClient::get(MS_GATEWAY."processing/processing", $this->params);
        $result->data = Utils::array_recursive_convert($result->data);
        //var_dump($result->data);
        return $result->data;
    }

    public function getAction($param = null)
    {
        $this->table = "action_marchand";
        $this->__addParam($param);
        return $this->__select();
    }
    public function getOneAction($param = null)
    {
        $this->table = "action_marchand";
        $this->__addParam($param);
        return $this->__detail();
    }
    /**
     * Modification Action
     */
    public function updateAction($param)
    {
        $this->table = "action_marchand";
        $this->__addParam($param);
        return $this->__update();
    }
    /**
     * Suppression action_marchand
     */
    public function deleteAction($param)
    {
        $this->table = "action_marchand";
        $this->__addParam($param);
        return $this->__delete();
    }
    // Liste module
    public function getModule($param = null)
    {
        $this->params["data"] = [ "request"=> \json_encode($_REQUEST)];
        $recup_id=$this->_USER->id;
        $result = $this->apiClient::get(MS_GATEWAY."administration/module/module", $this->params);
     //  var_dump($result->data);die;
        return $result->data;
    }

}