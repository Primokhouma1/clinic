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

class AdministrationController extends BaseController
{
    private $utilisateurModels;
    private $profilModels;        
    //private $droitModels;
   // private $typeprofilModels;
    private $moduleModels;
    private $sidebar;
    private $params;

    public function __construct()
    {

        parent::__construct();
        $this->utilisateurModels = $this->model("utilisateur");
        $this->params['headers'] = ["token" => $this->_USER->token];
        $this->views->initTemplate(["header" => "header", "footer" => "footer", "sidebar" => "sidebar_admin"]);

    }

    public function index__()
    {
        $this->views->getTemplate('administration/admin');

    }


    //******** Gestion des utilisateurs  *************//
    //******** Gestion des utilisateurs  *************//

    // Modification utilisateur
    public function modifUtilisateurModal()

    {
        $data['utilisateur'] = $this->utilisateurModels->getUtilisateur(["condition" => ["id = " => $this->paramGET[2]]])[0];
        $this->views->setData($data);
        $this->modal();

    }

    public function updateUtilisateur()
    {
      //  parent::validateToken("administration", "listeUtilisateur");
        //var_dump("test");exit;
        if (Utils::validateMail($this->paramPOST["email"])) {
            $data['condition'] = ["id = " => base64_decode($this->paramPOST['id'])];
            unset($this->paramPOST['id']);
            $data['champs'] = $this->paramPOST;
            $result = $this->utilisateurModels->updateUtilisateur($data);
            if ($result !== false) Utils::setMessageALert(["success", "Utilisateur modifié avec succes"]);
            else Utils::setMessageALert(["danger", "Echec de la modification du Utilisateur"]);
        } else Utils::setMessageALert(["warning", "email invalide"]);
        Utils::redirect("administration", "listeUtilisateur");
    }

    // Ajout utilisateur//
    public function ajoutUtilisateurModal()
    {
        $this->modal();

    }

    public function ajoutUtilisateur()
    {
       // parent::validateToken("administration", "listeUtilisateur");

        $this->paramPOST["password"] = sha1($this->paramPOST["password"]);
        if (Utils::validateMail($this->paramPOST["email"])) {
            //var_dump($this->utilisateurModels->VerifEmail(['utilisateur', 'email'], $this->paramPOST["email"]));die;
            if (!$this->utilisateurModels->VerifEmail(['utilisateur', 'email'], $this->paramPOST["email"])) {
                $result = $this->utilisateurModels->insertUtilisateur(["champs" => $this->paramPOST]);
                if ($result !== false) Utils::setMessageALert(["success", "Utilisateur ajouté avec succes"]);
                else Utils::setMessageALert(["danger", "Echec de l'ajout du Utilisateur"]);
            } else Utils::setMessageALert(["danger", $this->lang["email_existe"]]);


        } else Utils::setMessageALert(["warning", "email invalide"]);
        Utils::redirect("administration", "listeUtilisateur");

    }
    // Mon Profil //
    public function profilUser()
    {
        $fk_marchand = $this->_USER->marchand_id;
        $recup= $this->_USER->id;
        $data["utilisateur"] = $this->apiClient::get(MS_GATEWAY."administration/users/user?id=$recup&child=profil", $this->params);
        $data["utilisateur"] =$data["utilisateur"] ->data;
        $this->params['data'] =array(
            "id"=>intval($fk_marchand)
        );
        $data['soldeavant']->data->solde = $this->apiClient::get(MS_GATEWAY."accepteur/caisse/getinfos-marchand",
            $this->params);
        $data['soldeavant']= $data['soldeavant']->data->solde ;
        $data['soldeavant']= $data['soldeavant']->data->solde ;
        $this->views->setData($data);
        $this->views->getTemplate('administration/profilUser');

    }

    public function modifpwdUtilisateurModal()
    {
        $this->modal();
    }
    public function updatepwdUtilisateur()
    {
      // parent::validateToken("administration", "profilUser");
        $data['user'] = $this->utilisateurModels->getOneUtilisateur();
        //$this->views->setData($data);
        if (sha1($this->paramPOST["password"])== $data['user']->password)
        {
            if ($this->paramPOST["npassword"]== $this->paramPOST["cpassword"])
            {
                $result = $this->utilisateurModels->updateUtilisateur(["champs" => ["password" => sha1($this->paramPOST["cpassword"])], "condition" => ["iduser = " => base64_decode($this->paramPOST['id'])]]);
                if ($result !== false)
                {
                    Utils::setMessageALert(["success", "Mot de passe modifié avec succes"]);
                    Session::destroySession();
                    Utils::redirect("home", "index");
                }
                else Utils::setMessageALert(["danger", "Echec de la modification du mot de passe"]);
            } else Utils::setMessageALert(["danger", "Echec de confirmation du mot de passe"]);

            }else Utils::setMessageALert(["danger", "Echec mot passe incorect"]);

         //$this->views->getTemplate('administration/profilUser');
    }


    //  Supression utilisateur //
    public function remove()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->utilisateurModels->deleteUtilisateur(["condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", "Utilisateur supprimé avec succes"]);
            else Utils::setMessageALert(["danger", "Echec de la suppression du Utilisateur"]);
        } else Utils::setMessageALert(["danger", "Echec de la suppression de l'utilisateur"]);
        Utils::redirect("administration", "listeUtilisateur");
    }

    // Liste utilisateur //
    public function listeUtilisateur()
    {

        $this->views->getTemplate('administration/listeUtilisateur');

    }

    public function listeUtilisateurPro__()
    {
        if ($this->_USER) {
            if ($this->_USER->admin == 1 || \app\core\Utils::getModel('utilsateur')->__authorized($this->_USER->idprofil, 'administration', 'modifUtilisateurModal') > 0) {
                $param = [
                    "button" => [
                        "modal" => [
                            ["administration/modifUtilisateurModal", "administration/modifUtilisateurModal", "fa fa-edit"]
                        ],
                        "default" => [
                            ["administration/remove/", "fa fa-trash"]
                        ]
                        //"custom" => ["<span style='color: red;'>test</span>",["champ"=>"nom","val"=>["Faye"=>"<span style='color: red;'>faye</span>"]]]
                    ],
                    "tooltip" => [],
                    "classCss" => [
                        "modal" => [],
                        "default" => ["confirm"]
                    ],
                    "attribut" => [],
                    "args" => null,
                    "dataVal" => [],
                    "fonction" => []
                ];
                $this->processing($this->utilisateurModels, 'getAllUtilisateur', $param);

            } else {
                $param = [
                    "button" => [
                        "modal" => [],
                        "default" => []
                        //"custom" => ["<span style='color: red;'>test</span>",["champ"=>"nom","val"=>["Faye"=>"<span style='color: red;'>faye</span>"]]]
                    ],
                    "tooltip" => [],
                    "classCss" => [
                        "modal" => [],
                        "default" => ["confirm"]
                    ],
                    "attribut" => [],
                    "args" => null,
                    "dataVal" => [],
                    "fonction" => []
                ];
                $this->processing($this->utilisateurModels, 'getAllUtilisateur', $param);

            }

        }
    }

    //******** FIN Gestion des utilisateurs  *************//
    //******** FIN Gestion des utilisateurs  *************//


    //********  Gestion des Droits  *************//
    //********  Gestion des Droits  *************//


    // Ajout Droit //

    public function ajoutDroitModal()
    {
        $data['module'] = $this->moduleModels->getModule($param);
        $this->views->setData($data);
        $this->modal();


    }

    public function ajoutDroit()
    {

      //  parent::validateToken("administration", "listeDroit");

        $result = $this->droitModels->insertDroit(["champs" => $this->paramPOST]);
        if ($result !== false) Utils::setMessageALert(["success", "Droit ajouté avec succes"]);
        else Utils::setMessageALert(["danger", "Echec de l'ajout du droit"]);
        Utils::redirect("administration", "listeDroit");

    }


    //  Modification Droit //
    public function modifDroitModal()

    {
        $data['droit'] = $this->droitModels->getDroit(["condition" => ["id = " => $this->paramGET[2]]])[0];
        $data['module'] = $this->moduleModels->getModule();
        $this->views->setData($data);
        $this->modal();

    }

    public function updateDroit()
    {
     //   parent::validateToken("administration", "listeDroit");

        $data['condition'] = ["id = " => base64_decode($this->paramPOST['id'])];
        unset($this->paramPOST['id']);
        $data['champs'] = $this->paramPOST;
        $result = $this->droitModels->updateDroit($data);
        if ($result !== false) Utils::setMessageALert(["success", "Droit modifié avec succes"]);
        else Utils::setMessageALert(["danger", "Echec de la modification du droit"]);
        Utils::redirect("administration", "listeDroit");
    }


    // Supression droit //
    public function removeDroit()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->droitModels->deleteDroit(["condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", "droit supprimé avec succes"]);
            else Utils::setMessageALert(["danger", "Echec de la suppression du droit"]);
        } else Utils::setMessageALert(["danger", "Echec de la suppression du droit"]);
        Utils::redirect("administration", "listeDroit");
    }

    //  Liste droit //
    public function listeDroit__()

    {

        $this->views->getTemplate("administration/listeDroit");

    }

    public function listeDroitPro()
    {
        if ($this->_USER) {
            if ($this->_USER->admin == 1 || \app\core\Utils::getModel('administration')->__authorized($this->_USER->idprofil, 'administration', 'modifDroitModal') > 0) {
                $param = [
                    "button" => [
                        "modal" => [
                            ["administration/modifDroitModal", "administration/modifDroitModal", "fa fa-edit"]
                        ],
                        "default" => [
                            ["administration/removeDroit/", "fa fa-trash"]
                        ]
                        //"custom" => ["<span style='color: red;'>test</span>",["champ"=>"nom","val"=>["Faye"=>"<span style='color: red;'>faye</span>"]]]
                    ],
                    "tooltip" => [],
                    "classCss" => [
                        "modal" => [],
                        "default" => ["confirm"]
                    ],
                    "attribut" => [],
                    "args" => null,
                    "dataVal" => [],
                    "fonction" => []
                ];
                $this->processing($this->droitModels, 'getAllDroit', $param);


            } else {
                $param = [
                    "button" => [
                        "modal" => [],
                        "default" => []
                        //"custom" => ["<span style='color: red;'>test</span>",["champ"=>"nom","val"=>["Faye"=>"<span style='color: red;'>faye</span>"]]]
                    ],
                    "tooltip" => [],
                    "classCss" => [
                        "modal" => [],
                        "default" => ["confirm"]
                    ],
                    "attribut" => [],
                    "args" => null,
                    "dataVal" => [],
                    "fonction" => []
                ];
                $this->processing($this->droitModels, 'getAllDroit', $param);


            }

        }
    }


    //********  FIN Gestion des Droits  *************//
    //********  FIN Gestion des Droits  *************//


    //********  Gestion des Profil *************//
    //********  Gestion des Profil *************//

    // Affectation droit
    public function affectation__()
    {
        $data['idProfil'] = $this->paramGET[0];

        $data['droit'] = $this->droitModels->getDroit($param);
        $data['droitprofil'] = $this->profilModels->getDroitprofil($data['idProfil']);

        $droitprofil = array();
        foreach ($data['droitprofil'] as $dp) {
            array_push($droitprofil, $dp->fk_droit);
        }

        //array_search(40489, array_column($userdb, 'uid'));

        foreach ($data['droit'] as $droit) {

            if (in_array($droit->id, $droitprofil)) {
                $droit->exite = 1;

            } else {
                $droit->exite = 0;

            }
        }

        //echo '<pre>'; var_dump($data['droit']);exit;
        $this->views->setData($data);
        $this->views->getTemplate("administration/affectation");

    }

    public function ajoutaffectation()
    {
        //parent::validateToken("profil", "affectation");
        $profil = $this->paramPOST['idProfil'];
        $droit1 = $this->paramPOST['add'];
        $this->profilModels->deleteAffectDroit($profil);
        foreach ($droit1 as $item) {
            $this->profilModels->insertAffectDroit(["champs" => ['fk_profil' => $profil, 'fk_droit' => $item]]);

        }

        Utils::redirect("administration", "affectation", [$profil]);

    }


    // Ajout Profil //
    public function ajoutProfilModal()
    {
        $data['typep'] = $this->typeprofilModels->getTypeprofil($param);
        $this->views->setData($data);
        $this->modal();

    }

    public function ajoutProfil()
    {
       // parent::validateToken("administration", "listeProfil");

        $result = $this->profilModels->insertProfil(["champs" => $this->paramPOST]);
        if ($result !== false) Utils::setMessageALert(["success", "Profil ajouté avec succes"]);
        else Utils::setMessageALert(["danger", "Echec de l'ajout du profil"]);
        Utils::redirect("administration", "listeProfil");


    }


    //Modification Profil
    public function modifProfilModal()

    {
        $data['profil'] = $this->profilModels->getProfil(["condition" => ["id = " => $this->paramGET[2]]])[0];
        $data['typep'] = $this->typeprofilModels->getTypeprofil();
        $this->views->setData($data);

        $this->modal();

    }

    public function updateProfil()
    {
      //  parent::validateToken("administration", "listeProfil");


        $data['condition'] = ["id = " => base64_decode($this->paramPOST['id'])];
        unset($this->paramPOST['id']);
        $data['champs'] = $this->paramPOST;
        $result = $this->profilModels->updateProfil($data);
        if ($result !== false) Utils::setMessageALert(["success", "Profil modifié avec succes"]);
        else Utils::setMessageALert(["danger", "Echec de la modification du profil"]);
        Utils::redirect("administration", "listeProfil");
    }


    // Supression profil //
    public function removeProfil()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->profilModels->deleteProfil(["condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", "profil supprimé avec succes"]);
            else Utils::setMessageALert(["danger", "Echec de la suppression du profil"]);
        } else Utils::setMessageALert(["danger", "Echec de la suppression du profil"]);
        Utils::redirect("administration", "listeProfil");
    }


    // Liste profil //
    public function listeProfilPro__()
    {

        $param = [
            "button" => [
                "modal" => [
                    ["administration/modifProfilModal", "administration/modifProfilModal", "fa fa-edit"]
                ],
                "default" => [
                    ["champ" => "etat", "val" => ["0" => ["administration/activate/", "fa fa-toggle-off"], "1" => ["administration/deactivate/", "fa fa-toggle-on"]]],
                    ["administration/removeProfil/", "fa fa-trash"],
                    ["administration/affectation/", "fa fa-ellipsis-h"]
                ]
                //"custom" => ["<span style='color: red;'>test</span>",["champ"=>"nom","val"=>["Faye"=>"<span style='color: red;'>faye</span>"]]]
            ],
            "tooltip" => [],
            "classCss" => [
                "modal" => [],
                "default" => ["confirm"]
            ],
            "attribut" => [],
            "args" => null,
            "dataVal" => [
                ["champ" => "etat", "val" => ["0" => ["<i class='text-danger'>Desactiver</i>"], "1" => ["<i class='text-success'>Activer</i>"]]]
            ],
            "fonction" => []
        ];
        $this->processing($this->profilModels, 'getAllProfil', $param);

    }

    public function listeProfil__()
    {
        $this->views->getTemplate("administration/listeProfil");

    }

    // Activation profil & Desactivation profil//
    public function activate()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->profilModels->updateProfil(["champs" => ["etat" => 1], "condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", "Profil activé avec succes"]);
            else Utils::setMessageALert(["danger", "Echec de l'activation du Profil"]);
        } else Utils::setMessageALert(["danger", "Echec de l'activation du profil"]);
        Utils::redirect("administration", "listeProfil");
    }

    public function deactivate()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->profilModels->updateProfil(["champs" => ["etat" => 0], "condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", "Profil desactivé avec succes"]);
            else Utils::setMessageALert(["danger", "Echec de la desactivation du profil"]);
        } else Utils::setMessageALert(["danger", "Echec de la desactivation du profil"]);
        Utils::redirect("administration", "listeProfil");
    }


    //********  FIN Gestion des Profil  *************//
    //********  FIN Gestion des Profil  *************//


    //********  Gestion des types de Profil ou groupes  *************//
    //********  Gestion des types de Profil ou groupes  *************//


    // Ajout type de profil //
    public function ajoutGroupeModal()
    {
        $this->modal();

    }


    public function ajoutGroupe()
    {
     //   parent::validateToken("administration", "listeGroupe");
        //  var_dump("tets");exit;
        $result = $this->typeprofilModels->insertTypeprofil(["champs" => $this->paramPOST]);
        if ($result !== false) Utils::setMessageALert(["success", "Type Profil ajouté avec succes"]);
        else Utils::setMessageALert(["danger", "Echec de l'ajout du Type Profil"]);
        Utils::redirect("administration", "listeGroupe");


    }

    // Modification type de profil //
    public function modifGroupeModal()

    {
        $data['groupe'] = $this->typeprofilModels->getTypeprofil(["condition" => ["id = " => $this->paramGET[2]]])[0];
        $this->views->setData($data);
        $this->modal();

    }


    public function updateGroupe()
    {
     //   parent::validateToken("administration", "listeGroupe");


        $data['condition'] = ["id = " => base64_decode($this->paramPOST['id'])];
        unset($this->paramPOST['id']);
        $data['champs'] = $this->paramPOST;
        $result = $this->typeprofilModels->updateTypeprofil($data);
        if ($result !== false) Utils::setMessageALert(["success", "Type de Profil modifié avec succes"]);
        else Utils::setMessageALert(["danger", "Echec de la modification du type profil"]);
        Utils::redirect("administration", "listeGroupe");
    }

    // Supression type de profil //

    public function removeGroupe()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->typeprofilModels->deleteTypeprofil(["condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", "le type profil supprimé avec succes"]);
            else Utils::setMessageALert(["danger", "Echec de la suppression du type profil"]);
        } else Utils::setMessageALert(["danger", "Echec de la suppression du type de profil"]);
        Utils::redirect("administration", "listeGroupe");
    }

    // Liste type de profil //
    public function listeGroupe__()
    {
        $this->views->getTemplate("administration/listeGroupe");

    }

    public function listeGroupePro()
    {


        if ($this->_USER) {
            if ($this->_USER->admin == 1 || \app\core\Utils::getModel('administration')->__authorized($this->_USER->idprofil, 'administration', 'modifGroupeModal') > 0) {
                $param = [
                    "button" => [
                        "modal" => [
                            ["administration/modifGroupeModal", "administration/modifGroupeModal", "fa fa-edit"]
                        ],
                        "default" => [
                            ["administration/removeGroupe/", "fa fa-trash"]
                        ]
                        //"custom" => ["<span style='color: red;'>test</span>",["champ"=>"nom","val"=>["Faye"=>"<span style='color: red;'>faye</span>"]]]
                    ],
                    "tooltip" => [],
                    "classCss" => [
                        "modal" => [],
                        "default" => ["confirm"]
                    ],
                    "attribut" => [],
                    "args" => null,
                    "dataVal" => [],
                    "fonction" => []
                ];
                $this->processing($this->typeprofilModels, 'getAllTypeprofil', $param);


            } else {
                $param = [
                    "button" => [
                        "modal" => [],
                        "default" => []
                        //"custom" => ["<span style='color: red;'>test</span>",["champ"=>"nom","val"=>["Faye"=>"<span style='color: red;'>faye</span>"]]]
                    ],
                    "tooltip" => [],
                    "classCss" => [
                        "modal" => [],
                        "default" => ["confirm"]
                    ],
                    "attribut" => [],
                    "args" => null,
                    "dataVal" => [],
                    "fonction" => []
                ];
                $this->processing($this->typeprofilModels, 'getAllTypeprofil', $param);


            }
        }
    }




    //********  FIN Gestion des types de  Profil ou groupes  *************//
    //********  FIN Gestion des types de Profil ou groupes   *************//


    //******** Gestion des Modules  *************//
    //******** Gestion des Modules  *************//

    // Ajout Module //
    public function ajoutModuleModal()
    {
        $this->modal();

    }

    public function ajoutModule()
    {
     //   parent::validateToken("administration", "listeModule");
        //  var_dump("tets");exit;
        $result = $this->moduleModels->insertModule(["champs" => $this->paramPOST]);
        if ($result !== false) Utils::setMessageALert(["success", "Module ajouté avec succes"]);
        else Utils::setMessageALert(["danger", "Echec de l'ajout du Module"]);
        Utils::redirect("administration", "listeModule");


    }

    // Modification Module //
    public function modifModuleModal()

    {
        $data['module'] = $this->moduleModels->getModule(["condition" => ["id = " => $this->paramGET[2]]])[0];
        $this->views->setData($data);
        $this->modal();

    }

    public function updateModule()
    {
      //  parent::validateToken("administration", "listeModule");
        $data['condition'] = ["id = " => base64_decode($this->paramPOST['id'])];
        unset($this->paramPOST['id']);
        $data['champs'] = $this->paramPOST;
        $result = $this->moduleModels->updateModule($data);
        if ($result !== false) Utils::setMessageALert(["success", "Module modifié avec succes"]);
        else Utils::setMessageALert(["danger", "Echec de la modification du Module"]);
        Utils::redirect("administration", "listeModule");
    }

    // Supression Module //
    public function removeModule()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->moduleModels->deleteModule(["condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", "Module supprimé avec succes"]);
            else Utils::setMessageALert(["danger", "Echec de la suppression du Module"]);
        } else Utils::setMessageALert(["danger", "Echec de la suppression du Module"]);
        Utils::redirect("administration", "listeModule");
    }

    // Liste Module //
    public function listeModule()
    {

        $this->views->getTemplate('administration/listeModule');

    }

    public function listeModulePro__()
    {
        if ($this->_USER) {
            if ($this->_USER->admin == 1 || \app\core\Utils::getModel('utilsateur')->__authorized($this->_USER->idprofil, 'administration', 'modifModuleModal') > 0) {
                $param = [
                    "button" => [
                        "modal" => [
                            ["administration/modifModuleModal", "administration/modifModuleModal", "fa fa-edit"]
                        ],
                        "default" => [
                            ["administration/removeModule/", "fa fa-trash"]
                        ]
                        //"custom" => ["<span style='color: red;'>test</span>",["champ"=>"nom","val"=>["Faye"=>"<span style='color: red;'>faye</span>"]]]
                    ],
                    "tooltip" => [],
                    "classCss" => [
                        "modal" => [],
                        "default" => ["confirm"]
                    ],
                    "attribut" => [],
                    "args" => null,
                    "dataVal" => [],
                    "fonction" => []
                ];
                $this->processing($this->moduleModels, 'getAllModule', $param);

            } else {
                $param = [
                    "button" => [
                        "modal" => [],
                        "default" => []
                        //"custom" => ["<span style='color: red;'>test</span>",["champ"=>"nom","val"=>["Faye"=>"<span style='color: red;'>faye</span>"]]]
                    ],
                    "tooltip" => [],
                    "classCss" => [
                        "modal" => [],
                        "default" => ["confirm"]
                    ],
                    "attribut" => [],
                    "args" => null,
                    "dataVal" => [],
                    "fonction" => []
                ];
                $this->processing($this->moduleModels, 'getAllModule', $param);

            }

        }
    }


    public function verifAncienpassword ()
    {
        //var_dump($this->paramPOST["password"]);die();
        $verif = $this->utilisateurModels->verifPassword(sha1($this->paramPOST["password"]));
        if($verif > 0) echo 1;
        else echo -1;
    }

    //******** FIN Gestion des Modules  *************//
    //******** FIN Gestion des Modules  *************//
}
