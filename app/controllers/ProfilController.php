<?php

/**
 * Created by PhpStorm.
 * User: Seyni FAYE
 * Date: 15/02/2017
 * Time: 20:02
 */

namespace app\controllers;

use app\core\BaseController;
use app\core\Utils;

class ProfilController extends BaseController
{
    private $models;
    private $params;
    private $utilisateursModels;
    private $moduleModels;

    public function __construct()
    {
        parent::__construct();
        $this->models = $this->model("profil");
        $this->utilisateursModels = $this->model("utilisateurs");
        $this->moduleModels = $this->model("module");
        $this->views->initTemplate(["header" => "header", "footer" => "footer", "sidebar" => "sidebar_admin"]);
        $this->params['headers'] = ["token" => $this->_USER->token];
    }
    /**
     * @droit Lister les profils - 6
     */
    public function liste()
    {
        $this->views->getTemplate("profil/liste");
    }

    public function listeProfilProcessing__()
    {
        $param = [
            "button"=> [
                "modal" => [
                    /*["profil/profilModal","profil/profilModal","fa fa-edit"],*/
                    ["profil/gestProfilModal/", "profil/gestProfilModal", "fa fa-user-plus"]
                ],
                "default" => [
                    ["champ"=>"etat","val"=>[["profil/activate/","fa fa-toggle-off"],["profil/deactivate/","fa fa-toggle-on"]]],
                ],
                "custom" => []
            ],
            "tooltip"=> [
                "modal" => [
                    "Affecter droits"
                ],
                "default" => [
                    ["champ"=>"etat","val"=>["0"=>"Activer","1"=>"Desactiver"]]
                ]
            ],
            "classCss"=> [
                "modal" => [],
                "default" => ["confirm","confirm"]
            ],
            "attribut"=> [
                "modal" => [],
                "default" => []
            ],
            "args"=>null,
            "dataVal"=>[
                ["champ"=>"etat","val"=>[["<span class='text-danger'>Désactiver</span>"],["<span class='text-success'>Activer</span>"]]]
            ],
            "fonction"=>[

            ]
        ];
        $this->processing($this->models, "getListeProfilProcess", $param);
    }

    public function profilModal__()
    {
       // $data['profil'] = $this->models->getAllTypeProfils();
       // $this->views->setData($data);
        $this->modal();
    }

    public function gestProfilModal()
    {
        $data['profil_id'] = $this->paramGET[0];
        $this->params["data"]["__strict__"] = "true";
        $data['droit'] = $this->apiClient::get(MS_GATEWAY."administration/auth/getUserConnected", $this->params);
        $data['droit'] = $data['droit']->data->law;
       // print "<pre>";var_dump($data['droit']);die;
        $this->views->setData($data);
        $this->modal();
    }

    /**
     * @droit Ajouter un profil - 6
     */
    public function addProfil()
    {
        $dist = $this->paramPOST["dist"];
        $dist['user_creation'] = $this->_USER->id;
        $dist['fk_marchand'] = $this->_USER->fk_marchand;
        $this->params['data'] =array(
            "libelle"=>$dist["libelle"],
            "type_profil_id"=>1,
            "marchand_id"=>intval($this->_USER->marchand_id)
        );
        $result = $this->apiClient::post(MS_GATEWAY."administration/profil/profil", $this->params);
        if($result->code == 201) {
            Utils::setMessageALert(["success",$this->lang["ationsuccess"]]);
        }
        else {
            Utils::setMessageALert(["danger",$this->lang["ationsechec"]]);
        }
        Utils::redirect("profil", "liste");
    }

    /**
     * @droit Modifier un profil - 6
     */
    public function updateProfil()
    {
        $dist = $this->paramPOST["dist"];

        $dist['date_modification'] = date('Y-m-d');
        $dist['user_modification'] = $this->_USER->id;
        $rowid = $dist['rowid'];
        unset($dist['rowid']);

        $result = $this->models->set(["table"=>'profil_marchand',"champs"=>$dist,"condition"=>['rowid ='=> $rowid]]);
        if($result !== false) {
            Utils::setMessageALert(["success",$this->lang["ationsuccess"]]);
        }
        else {
            Utils::setMessageALert(["danger",$this->lang["ationsechec"]]);
        }
        Utils::redirect("profil", "liste");
    }

    /**
     * @droit Activer un profil - 6
     */
    public function activate()
    {
        if(intval($this->paramGET[0]) > 0) {
            $recup_id=intval($this->paramGET[0]);
            $result = $this->apiClient::get(MS_GATEWAY."administration/profil/edit-etat?id=$recup_id&etat=1", $this->params);
            if ($result->code == 201) Utils::setMessageALert(["success", $this->lang["ationsuccess"]]);
            else Utils::setMessageALert(["danger",$this->lang["ationsechec"]]);
        }
        Utils::redirect("profil", "liste");
    }

    /**
     * @droit Désactiver un profil - 6
     */
    public function deactivate()
    {
        if(intval($this->paramGET[0]) > 0) {
            $recup_id=intval($this->paramGET[0]);
            $result = $this->apiClient::get(MS_GATEWAY."administration/profil/edit-etat?id=$recup_id&etat=0", $this->params);
            if ($result->code == 201) Utils::setMessageALert(["success", $this->lang["ationsuccess"]]);
            else Utils::setMessageALert(["danger",$this->lang["ationsechec"]]);
        }
        Utils::redirect("profil", "liste");
    }


    public function removeProfil() {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->models->deleteModule(["condition" => ["rowid = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["ationsuccess"]]);
            else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        } else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        Utils::redirect("profil", "liste");
    }

    public function affectDroitProfil() {
        $this->params["data"] = $this->paramPOST;
        $result = $this->apiClient::post(MS_GATEWAY."administration/profil/affectation", $this->params);
        print json_encode($result);
    }

}