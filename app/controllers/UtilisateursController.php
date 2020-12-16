<?php

/**
 * Created by PhpStorm.
 * User: Seyni FAYE
 * Date: 15/02/2017
 * Time: 21:11
 */

namespace app\controllers;

use app\core\BaseController;
use app\core\Utils;

class UtilisateursController extends BaseController
{
    private $utilisateursModels;
    private $sidebar;
    private $params;
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->utilisateursModels = $this->model("utilisateurs");
        $this->model = $this->model("affectationcaisse");
        $this->views->initTemplate(["header" => "header", "footer" => "footer", "sidebar" => "sidebar_admin"]);
        $this->params['headers'] = ["token" => $this->_USER->token];
    }

    // Ajout Utilisateurs //
    public function ajoutUtilisateurModal()
    {
        $data = [];
        $data['profil'] = $this->utilisateursModels->getAllProfils();
        $this->views->setData($data);
        $this->modal();
    }

    public function ajoutUtilisateurs()
    {
           // $this->paramPOST["login"] = $this->paramPOST["email"];
            $this->paramPOST["fk_marchand"] = $this->_USER->fk_marchand;
            $this->paramPOST["telephone"] = str_replace("+", "00", $this->paramPOST["telephone"]);

            $this->params['data'] =array(
                "profil_id"=>intval($this->paramPOST["fk_profil"]),
                "bureau_id"=>"",
                "prenom"=>$this->paramPOST["prenom"],
                "nom"=>$this->paramPOST["nom"],
                "telephone"=>$this->paramPOST["telephone"],
                "email"=>$this->paramPOST["email"],
                "login"=>$this->paramPOST["login"],
                "admin"=>$this->_USER->admin,
                "first_connect"=>intval($this->_USER->connect),
                "dist_point_service_id" => "",
                "marchand_id"=>intval($this->_USER->marchand_id)
            );
            //$result = $this->apiClient::post(MS_GATEWAY."administration/users/user", $this->params);
             $result = $this->utilisateursModels->insertUtilisateurs($this->params['data']);
            if ($result ==201) {

                Utils::setMessageALert(["success", $this->lang["ationsuccess"]]);

            } else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);

        Utils::redirect("utilisateurs", "listeUtilisateurs");
    }

    // Modification Utilisateurs //
    public function modifUtilisateursModal()
    {
       $recup= $this->paramGET[0];
       $marchand_id=$this->_USER->marchand_id;
        $data["utilisateur"] = $this->apiClient::get(MS_GATEWAY."administration/users/user?id=$recup", $this->params);
        $data["profil"] = $this->apiClient::get(MS_GATEWAY."administration/profil/profil?where=marchand_id|e|$marchand_id",
            $this->params);
        // $data['profil'] = $this->utilisateursModels->getAllProfils();
        $this->views->setData($data);
        $this->modal();
    }

    public function updateUtilisateurs()
    {
        //parent::validateToken("utilisateurs", "listeUtilisateurs");
        $data['condition'] = ["iduser = " => base64_decode($this->paramPOST['id'])];
        $this->paramPOST['id']=base64_decode($this->paramPOST['id']);
        $this->params['data'] =array(
            "id"=>intval($this->paramPOST['id']),
            "prenom"=>$this->paramPOST["prenom"],
            "nom"=>$this->paramPOST["nom"],
            "telephone"=>$this->paramPOST["telephone"],
            "email"=>$this->paramPOST["email"],
            "profil_id"=>intval($this->paramPOST["fk_profil"])
        );
        $result = $this->apiClient::put(MS_GATEWAY."administration/users/user", $this->params);
        //var_dump($result);die;
        $result = $this->utilisateursModels->updateUtilisateurs($data);
        if ($result !== false) Utils::seQtMessageALert(["success", $this->lang["ationsuccess"]]);
        else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        Utils::redirect("utilisateurs", "listeUtilisateurs");
    }

    // Activation utilisateurs & Desactivation utilisateurs//
    public function activate()
    {

        if (intval($this->paramGET[0]) > 0) {
            $recup_id=intval($this->paramGET[0]);
            $result = $this->apiClient::get(MS_GATEWAY."administration/users/edit-etat?id=$recup_id&etat=1", $this->params);
            if ($result->code == 201) Utils::setMessageALert(["success", $this->lang["ationsuccess"]]);
            else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        } else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        Utils::redirect("utilisateurs", "listeUtilisateurs");
    }

    public function deactivate()
    {

        if (intval($this->paramGET[0]) > 0) {
            $recup_id=intval($this->paramGET[0]);
            $result = $this->apiClient::get(MS_GATEWAY."administration/users/edit-etat?id=$recup_id&etat=0", $this->params);
            if ($result->code == 201) Utils::setMessageALert(["success", $this->lang["ationsuccess"]]);
            else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        } else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        Utils::redirect("utilisateurs", "listeUtilisateurs");
    }

    // Supression Utilisateurs //
    public function removeUtilisateurs()
    {
        if (intval($this->paramGET[0]) > 0) {
            $recup_id=intval($this->paramGET[0]);
            $result = $this->apiClient::delete(MS_GATEWAY."administration/users/user?id=$recup_id", $this->params);
            if ($result->code == 204) Utils::setMessageALert(["success", $this->lang["ationsuccess"]]);
            else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        } else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        Utils::redirect("utilisateurs", "listeUtilisateurs");
    }

    // Vérifier si email existe déjà
    public function verifExistenceEmail__()
    {
       $this->params["data"] = ["where" => "email|e|" . $this->paramPOST["email"] ,"marchand_id|e|" . $this->_USER->marchand_id];
        $result = $this->apiClient::get(MS_GATEWAY . "administration/users/user", $this->params);
        if ($result->data) echo -1;
        else echo 1;
    }

    // Liste Utilisateurs //
    public function listeUtilisateurs()
    {
        $this->views->getTemplate('utilisateurs/listeUtilisateurs');
    }

    public function listeUtilisateursPro__()
    {
        $param = [
            "button" => [
                "modal" => [
                    ["utilisateurs/modifUtilisateursModal", "utilisateurs/modifUtilisateursModal", "fa fa-edit"],
                    ["utilisateurs/RegenerPwdModal", "utilisateurs/RegenerPwdModal", "mdi mdi-refresh"]
                ],
                "default" => [
                    ["champ"=>"etat","val"=>[["utilisateurs/activate/","fa fa-toggle-off"],["utilisateurs/deactivate/","fa fa-toggle-on"]]],
                    ["utilisateurs/removeUtilisateurs/", "fa fa-trash"]
                ],
                //"custom" => ["<span style='color: red;'>test</span>",["champ"=>"nom","val"=>["Faye"=>"<span style='color: red;'>faye</span>"]]]
                "custom" => []
            ],
            "tooltip" => [
                "modal" => [
                    "Modifier", "Regenerer mot de passe"
                ],
                "default" => [
                    "Activer/désactiver"
                ]
            ],
            "classCss" => [
                "modal" => [],
                "default" => ["confirm", "confirm"]
            ],
            "attribut" => [],
            "args" => null,
            "dataVal" => [
                ["champ" => "etat", "val" => ["0" => ["<i class='text-danger'>Desactiver</i>"], "1" => ["<i class='text-success'>Activer</i>"]]]
            ],
            "fonction" => []
        ];

        $this->processing($this->utilisateursModels, 'getAllUtilisateurs', $param);
    }

    public function RegenerPwdModal()
    {
        $data['user'] = $this->model->getOneuser($this->paramGET[0]);
        if ($this->paramGET[0]) {
            $data['user'] = $this->model->getOneuser($this->paramGET[0])[0];
        }
        $this->views->setData($data);
        $this->modal();
    }

    public function regerenerepwd()
    {
        if (intval($this->paramPOST["id"]) > 0) {
            $this->params['data'] =array(
                "email"=>$this->paramPOST['email']
            );
            $result = $this->apiClient::put(MS_GATEWAY."administration/users/edit-pwd", $this->params);
            if ($result->code==201) {
                //$url="https://numherit-preprod.com/postecashv3/partenaire";
                Utils::setMessageALert(["success", $this->lang["ationsuccess"]]);

            } else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);

        }
        Utils::redirect("utilisateurs", "listeUtilisateurs");
    }

    //******** FIN Gestion des Utilisateurss  *************//
}