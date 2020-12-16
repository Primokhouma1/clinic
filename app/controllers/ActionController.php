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

class ActionController extends BaseController
{

    private $actionModels;
    private $sidebar;
    private $params;

    public function __construct()
    {

        parent::__construct();
        $this->actionModels = $this->model("action");
        $this->views->initTemplate(["header" => "header", "footer" => "footer", "sidebar" => "sidebar_admin"]);
        $this->params['headers'] = ["token" => $this->_USER->token];

    }



    //******** Gestion des Actions  *************//
    //******** Gestion des Actions  *************//

    // Ajout Action //
    public function ajoutActionModal()
    {
        $data = [];
        $data['module'] = $this->actionModels->getModule();
        $this->views->setData($data);
        $this->modal();


    }

    public function ajoutAction()
    {
        //parent::validateToken("action", "listeAction");
        var_dump($this->paramPOST);die;
        $this->paramPOST["user_creation"]=$this->_USER->id;
        $this->paramPOST["fk_marchand"] = $this->_USER->fk_marchand;
        $this->paramPOST["telephone"] = str_replace("+", "00", $this->paramPOST["telephone"]);
        $this->params['data'] =array(
            "profil_id"=>1,
            "bureau_id"=>"",
            "prenom"=>$this->paramPOST["prenom"],
            "nom"=>$this->paramPOST["nom"],
            "telephone"=>$this->paramPOST["telephone"],
            "email"=>$this->paramPOST["email"],
            "login"=>$this->paramPOST["login"],
            "admin"=>$this->_USER->admin,
            "first_connect"=>$this->_USER->connect,
            "dist_point_service_id" => "",
            "marchand_id"=>$this->_USER->marchand_id
        );
        $result = $this->actionModels->insertAction(["champs" => $this->paramPOST]);
        if ($result !== false) Utils::setMessageALert(["success", $this->lang["ationsuccess"]]);
        else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        Utils::redirect("action", "listeAction");


    }

    // Modification Action //
    public function modifActionModal()

    {
        $data['action'] = $this->actionModels->getAction(["condition" => ["rowid = " => $this->paramGET[2]]])[0];
        $data['module'] = $this->actionModels->getModule();
        $this->views->setData($data);
        $this->modal();

    }

    public function updateAction()
    {
      //  parent::validateToken("action", "listeAction");
        $data['condition'] = ["rowid = " => base64_decode($this->paramPOST['id'])];
        unset($this->paramPOST['id']);
        $this->paramPOST['date_modification'] = date('Y-m-d');
        $this->paramPOST['user_modification'] = $this->_USER->id;
        $data['champs'] = $this->paramPOST;
        $result = $this->actionModels->updateAction($data);
        if ($result !== false) Utils::setMessageALert(["success",  $this->lang["ationsuccess"]]);
        else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        Utils::redirect("action", "listeAction");
    }

    // Activation action & Desactivation action//
    public function activate()
    {
        if (intval($this->paramGET[0]) > 0) {
            $recup_id=intval($this->paramGET[0]);
            $result = $this->apiClient::post(MS_GATEWAY."administration/droit/edit-etat?id=$recup_id&etat=1", $this->params);
            if ($result->code == 201) Utils::setMessageALert(["success", $this->lang["ationsuccess"]]);
            else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        } else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        Utils::redirect("action", "listeAction");
    }

    public function deactivate()
    {
        if (intval($this->paramGET[0]) > 0) {
            $recup_id=intval($this->paramGET[0]);
            $result = $this->apiClient::post(MS_GATEWAY."administration/droit/edit-etat?id=$recup_id&etat=0", $this->params);
            if ($result->code == 201) Utils::setMessageALert(["success", $this->lang["ationsuccess"]]);
            else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        } else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        Utils::redirect("action", "listeAction");
    }
    
    // Supression Action //
    public function removeAction()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->actionModels->deleteAction(["condition" => ["rowid = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["ationsuccess"]]);
            else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        } else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        Utils::redirect("action", "listeAction");
    }

    // Liste Action //
    public function listeAction()
    {
//var_dump(2);exit;
        $this->views->getTemplate('action/listeAction');

    }

    public function listeActionPro__()
    {
         $param = [
                    "button" => [
                        "modal" => [
                            ["action/modifActionModal", "action/modifActionModal", "fa fa-edit"]
                        ],
                        "default" => [
                            ["champ" => "etat", "val" => ["0" => ["action/activate/", "fa fa-toggle-off"], "1" => ["action/deactivate/", "fa fa-toggle-on"]]],
                            ["action/removeAction/", "fa fa-trash"]
                        ]
                        //"custom" => ["<span style='color: red;'>test</span>",["champ"=>"nom","val"=>["Faye"=>"<span style='color: red;'>faye</span>"]]]
                    ],
                    "tooltip"=> [
                    "modal" => [
                        "Modifier"
                    ],
                    "default" => [
                        "Activer/désactiver","Supprimer"
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
                $this->processing($this->actionModels, 'getAllAction', $param);


    }

    //******** FIN Gestion des Actions  *************//
    //******** FIN Gestion des Actions  *************//
}