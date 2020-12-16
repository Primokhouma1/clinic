<?php

/**
 * Created by PhpStorm.
 * User: Seyni FAYE
 * Date: 15/02/2017
 * Time: 21:11
 */

namespace app\controllers;

use app\core\BaseController;
use app\core\Session;
use app\core\Utils;

class MenuController extends BaseController
{
    private $menuModels;
    private $params;

    public function __construct()
    {
        parent::__construct();
        $this->menuModels = $this->model("home");
        // $this->views->initTemplate(["header"=>"header","footer"=>"footer"]);
        $this->params['headers'] = ["token" => $this->_USER->token];
    }


    /**
     * @authorize
     */
    public function index()
    {
        $this->views->getPage('home/menu');

    }

    /**
     * @authorize
     */
   public function menu()
   {
       $this->params['data'] =array(
           "id"=>intval($this->_USER->marchand_id)
       );

     $data['soldeavant']->data->solde = $this->apiClient::get(MS_GATEWAY."accepteur/caisse/getinfos-marchand", $this->params);

       $solde=$data['soldeavant']->data->solde;
       $data["soldeavant"]=$solde->data->solde;

        $idmarchand = $this->_USER->fk_marchand;
        $data["soldeT"] =  Utils::getFormatMoney($this->menuModels->consulterSoldeMarchand($idmarchand));
        $data["nombreT"] = $this->menuModels->nombreDeTransaction($idmarchand);
        $data["montantT"] = Utils::getFormatMoney($this->menuModels->montantGTransaction($idmarchand));
        $this->views->setData($data);
       $this->views->getPage('home/menu');

    }



}