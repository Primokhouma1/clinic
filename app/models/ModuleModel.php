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

class moduleModel extends BaseModel
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
     * Ajout Module
     */
    public function insertModule($param)
    {
        $this->table = "module_marchand";
        $this->__addParam($param);
        return $this->__insert();
    }
    /**
     * Lister module
     */
    public function getAllModule($param = null)
    {
        $this->params["data"]["params"] = json_encode([
            "table"=>"module",
            "champs"=>["id","libelle","etat"],
            "condition"=>["marchand_id = " =>$this->_USER->id],
            "request"=>$_REQUEST
        ]);
        $result = $this->apiClient::get(MS_GATEWAY."processing/processing", $this->params);
       // var_dump($result);die;
        $result->data = Utils::array_recursive_convert($result->data);
        return $result->data;
    }

    /**
     * Lister module
     */
    public function getAllSousModule($param = null)
    {

        $this->params["data"]["params"] = json_encode([
            "table"=>"sous_module",
            "champs"=>["id","libelle","etat"],
            //"condition"=>["marchand_id = " =>$this->_USER->id],
            "request"=>$_REQUEST
        ]);
        $result = $this->apiClient::get(MS_GATEWAY."processing/processing", $this->params);
       // var_dump($result);die;
        $result->data = Utils::array_recursive_convert($result->data);
        return $result->data;
    }
    public function getModule($param = null)
    {
        $this->table = "module_marchand";
        $this->__addParam($param);
        return $this->__select();
    }
    public function getOneModule($param = null)
    {
        $this->table = "module_marchand";
        $this->__addParam($param);
        return $this->__detail();
    }
    /**
     * Modification Module
     */
    public function updateModule($param)
    {
        $this->table = "module_marchand";
        $this->__addParam($param);
        return $this->__update();
    }
    /**
     * Suppression module_marchand
     */
    public function deleteModule($param)
    {
        $this->table = "module_marchand";
        $this->__addParam($param);
        return $this->__delete();
    }
    /**
     * Lister module
     */
    public function getAllModules($param = null)
    {
        $this->params["data"] = [ "request"=> \json_encode($_REQUEST)];
        $recup_id=$this->_USER->id;
        $result = $this->apiClient::get(MS_GATEWAY."administration/module/module", $this->params);
        return $result->data;
    }

}