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

class ModuleController extends BaseController
{

    private $moduleModels;
    private $params;

    public function __construct()
    {

        parent::__construct();
        $this->moduleModels = $this->model("module");
        $this->views->initTemplate(["header" => "header", "footer" => "footer", "sidebar" => "sidebar_admin"]);
        $this->params['headers'] = ["token"=>$this->_USER->token];

    }

    //******** Gestion des Modules  *************//

    // Ajout Module //
    public function ajoutModuleModal()
    {
       /* $data = [];
        $data['module'] = $this->moduleModels->getModule();
        $this->views->setData($data);*/
        $this->modal();
    }

    public function ajoutModule()
    {
       // parent::validateToken("module", "listeModule");
        $this->params['data'] =array(
            "libelle"=>$this->paramPOST["label"],
            "code"=>$this->paramPOST["code"],
            "icon"=>$this->paramPOST["icon"]
        );
        $result = $this->apiClient::post(MS_GATEWAY."administration/module/module", $this->params);
        $result = $this->moduleModels->insertModule(["champs" => $this->paramPOST]);
        if ($result->code == 201) Utils::setMessageALert(["success", $this->lang["ationsuccess"]]);
        else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        Utils::redirect("module", "listeModule");
    }

    // Modification Module //
    public function modifModuleModal()
    {
        $data['module'] = $this->moduleModels->getModule(["condition" => ["rowid = " => $this->paramGET[2]]])[0];
        $this->views->setData($data);
        $this->modal();
    }

    public function updateModule()
    {
        parent::validateToken("module", "listeModule");
        $data['condition'] = ["rowid = " => base64_decode($this->paramPOST['id'])];
        unset($this->paramPOST['id']);
        $this->paramPOST['date_modification'] = date('Y-m-d');
        $this->paramPOST['user_modification'] = $this->_USER->id;
        $data['champs'] = $this->paramPOST;
        $result = $this->moduleModels->updateModule($data);
        if ($result !== false) Utils::setMessageALert(["success",  $this->lang["ationsuccess"]]);
        else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        Utils::redirect("module", "listeModule");
    }

    // Activation module & Desactivation module//
    public function activate()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->moduleModels->updateModule(["champs" => ["etat" => 1], "condition" => ["rowid = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["ationsuccess"]]);
            else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        } else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        Utils::redirect("module", "listeModule");
    }

    public function deactivate()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->moduleModels->updateModule(["champs" => ["etat" => 0], "condition" => ["rowid = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["ationsuccess"]]);
            else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        } else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        Utils::redirect("module", "listeModule");
    }
    
    // Supression Module //
    public function removeModule()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->moduleModels->deleteModule(["condition" => ["rowid = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["ationsuccess"]]);
            else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        } else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        Utils::redirect("module", "listeModule");
    }

    // Liste Module //
    public function listeModule()
    {
        $this->views->getTemplate('module/listeModule');

    }

    // Liste Sous Module //
    public function listeSousModule()
    {
        $this->views->getTemplate('module/listeSousModule');

    }

    public function listeModulePro__()
    {
            $param = [
                    "button" => [
                        "modal" => [
                            ["module/modifModuleModal", "module/modifModuleModal", "fa fa-edit"]
                        ],
                        "default" => [
                            ["champ" => "etat", "val" => ["0" => ["module/activate/", "fa fa-toggle-off"], "1" => ["module/deactivate/", "fa fa-toggle-on"]]],
                            ["module/removeModule/", "fa fa-trash"]
                        ]
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
                $this->processing($this->moduleModels, 'getAllModule', $param);
    }


    public function listeSousModulePro__()
    {
        $param = [
            "button" => [
                "modal" => [
                    ["module/modifModuleModal", "module/modifModuleModal", "fa fa-edit"]
                ],
                "default" => [
                    ["champ" => "etat", "val" => ["0" => ["module/activate/", "fa fa-toggle-off"], "1" => ["module/deactivate/", "fa fa-toggle-on"]]],
                    ["module/removeModule/", "fa fa-trash"]
                ]
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
        $this->processing($this->moduleModels, 'getAllSousModule', $param);
    }

    //******** FIN Gestion des Modules  *************//
}