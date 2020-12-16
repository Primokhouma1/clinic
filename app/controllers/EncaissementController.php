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

class EncaissementController extends BaseController
{

    private $encaissementModels;
    private $sidebar;
    private $params;
    public function __construct()
    {

        parent::__construct();
        $this->encaissementModels = $this->model("encaissement");
        $this->views->initTemplate(["header" => "header", "footer" => "footer", "sidebar" => "sidebar_caisse"]);
        $this->params['headers'] = ["token"=>$this->_USER->token];

    }


    //******** Gestion des Encaissements  *************//
    //******** Gestion des Encaissements  *************//

    // Ajout Encaissement //
    public function ajoutEncaissementModal()
    {
        $this->params['data'] =array(
            "marchand_id"=>$this->_USER->marchand_id,
        );
        $result = $this->apiClient::get(MS_GATEWAY."accepteur/caisse/num-caisse", $this->params);
        $data['numenc'] = $result->data->numcaisse;
       // var_dump($data['numenc']);die;
        $this->views->setData($data);
        $this->modal();


    }

    public function ajoutEncaissement()
    {
      //  parent::validateToken("encaissement", "listeEncaissement");
        $this->params['data'] =array(
            "numcaisse"=>$this->paramPOST["numcaisse"],
                 );
        $result = $this->apiClient::post(MS_GATEWAY."accepteur/caisse/add-caisse", $this->params);
        if ($result->code==201) Utils::setMessageALert(["success", $this->lang["ationsuccess"]]);
        else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        Utils::redirect("encaissement", "listeEncaissement");


    }

    // Modification Encaissement //
    public function modifEncaissementModal()

    {
        $data['encaissement'] = $this->encaissementModels->getEncaissement(["condition" => ["rowid = " => $this->paramGET[2]]])[0];
        $this->views->setData($data);
        $this->modal();

    }

    public function updateEncaissement()
    {
        parent::validateToken("encaissement", "listeEncaissement");
        $data['condition'] = ["rowid = " => base64_decode($this->paramPOST['id'])];
        unset($this->paramPOST['id']);
        $this->paramPOST['date_modification'] = date('Y-m-d');
        $this->paramPOST['user_modification'] = $this->_USER->id;
        $data['champs'] = $this->paramPOST;
        $result = $this->encaissementModels->updateEncaissement($data);
        if ($result !== false) Utils::setMessageALert(["success",  $this->lang["ationsuccess"]]);
        else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        Utils::redirect("encaissement", "listeEncaissement");
    }

    // Activation encaissement & Desactivation encaissement//
    public function activate()
    {
        if (intval($this->paramGET[0]) > 0) {
            $recup_id=intval($this->paramGET[0]);
            $result = $this->apiClient::get(MS_GATEWAY."administration/users/edit-etat?id=$recup_id&etat=1", $this->params);
            if ($result->code == 201) Utils::setMessageALert(["success", $this->lang["ationsuccess"]]);            if ($result !== false) Utils::setMessageALert(["success", $this->lang["ationsuccess"]]);
            else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        } else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        Utils::redirect("encaissement", "listeEncaissement");
    }

    public function deactivate()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->encaissementModels->updateEncaissement(["champs" => ["etat" => 0], "condition" => ["rowid = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["ationsuccess"]]);
            else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        } else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        Utils::redirect("encaissement", "listeEncaissement");
    }
    
    // Supression Encaissement //
    public function removeEncaissement()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->encaissementModels->deleteEncaissement(["condition" => ["rowid = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["ationsuccess"]]);
            else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        } else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        Utils::redirect("encaissement", "listeEncaissement");
    }

    // Liste Encaissement //
    public function listeEncaissement()
    {
//var_dump(2);exit;
        $this->views->getTemplate('encaissement/listeEncaissement');

    }

    public function listeEncaissementPro__()
    {
         $param = [
                    "button" => [
                        "modal" => [

                            /*["encaissement/RegenerEncModal","encaissement/RegenerEncModal","mdi mdi-refresh"]*/
                        ],
                        "default" => [
                            ["champ" => "etat", "val" => ["0" => ["encaissement/activate/", "fa fa-toggle-off"], "1" => ["encaissement/deactivate/", "fa fa-toggle-on"]]],

                        ]
                        //"custom" => ["<span style='color: red;'>test</span>",["champ"=>"nom","val"=>["Faye"=>"<span style='color: red;'>faye</span>"]]]
                    ],
                    "tooltip"=> [
                    "modal" => [
                        "Regenerer code marchand"
                    ],
                    "default" => [
                        "Activer/désactiver"
                    ]
                ],
                    "classCss" => [
                        "modal" => [],
                        "default" => ["confirm","confirm"]
                    ],
                    "attribut" => [],
                    "args" => null,
                    "dataVal" => [
                        ["champ" => "etat", "val" => ["0" => ["<i class='text-danger'>Desactiver</i>"], "1" => ["<i class='text-success'>Activer</i>"]]]
                    ],
                    "fonction" => []
                ];
                $this->processing($this->encaissementModels, 'getAllEncaissement', $param);


    }

    public function RegenerEncModal()
    {
        //var_dump($this->paramGET[2])
        if($this->paramGET[2]) {
            $data['enc'] = $this->encaissementModels->getEncaissement(["condition"=>["rowid = "=>$this->paramGET[2]]])[0];
        }

        $this->views->setData($data);
        $this->modal();
    }

    public function regerenereCodeMarchand()
    {
        if(intval($this->paramPOST["id"]) > 0) {
            $this->params['data'] =array(
                "id"=>$this->paramPOST["id"],
            );
         //   $result = $this->apiClient::post(MS_GATEWAY."accepteur/caisse/add-caisse", $this->params);
            if($result !== false) {

            }
            else Utils::setMessageALert(["danger",$this->lang["ationsechec"]]);

        }
        Utils::redirect("encaissement", "listeEncaissement");
    }

    //******** FIN Gestion des Encaissements  *************//
    //******** FIN Gestion des Encaissements  *************//
}