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

class MoyenController extends BaseController
{
    private $models;

    public function __construct()
    {
        parent::__construct();
        $this->models = $this->model("moyen");
        $this->views->initTemplate(["header" => "header", "footer" => "footer", "sidebar" => "sidebar_admin"]);
    }
    /**
     * @droit Lister les moyens - 6
     */
    public function liste()
    {
        $this->views->getTemplate("moyen/liste");
    }

    public function listeMoyenProcessing__()
    {
        $param = [
            "button"=> [
                "modal" => [
                    ["moyen/moyenModal","moyen/moyenModal","fa fa-edit"]
                ],
                "default" => [
                    ["champ"=>"etat","val"=>[["moyen/activate/","fa fa-toggle-off"],["moyen/deactivate/","fa fa-toggle-on"]]],
                    ["moyen/removeMoyen/", "fa fa-trash"],
                ],
                "custom" => []
            ],
            "tooltip"=> [
                "modal" => [
                    "Modifier"
                ],
                "default" => [
                    ["champ"=>"etat","val"=>["0"=>"Activer","1"=>"Desactiver"]],
                    "supprimer"
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
        $this->processing($this->models, "getListeMoyenProcess", $param);
    }

    public function moyenModal__()
    {
        if(isset($this->paramGET[2])){
            $param = [
                "table"=>"moyen_paiement_marchand",
                "champs"=>["rowid", "label"]
            ];

            $data['dist'] = $this->models->get($param)[0];
        }
        $this->views->setData($data);
        $this->modal();
    }

    /*public function gestProfilModal__()
    {
        if(isset($this->paramGET[2])){
            $param = [
                "table"=>"moyen_marchand",
                "champs"=>["rowid", "libelle"],
                "condition"=>["rowid = "=>$this->paramGET[2],"fk_marchand ="=>$this->_USER->fk_marchand]
            ];
            $data['moyen'] = $this->models->get($param)[0];
        }
        $data['module'] = $this->models->getModules();


        $this->views->setData($data);
        //var_dump($data['affectations']);die();
        $this->modal();
    }*/

    /**
     * @droit Ajouter un moyen - 6
     */
    public function addMoyen()
    {
        $dist = $this->paramPOST["dist"];
        $dist['user_creation'] = $this->_USER->id;

        //$this->models->__beginTransaction();
        $result = $this->models->set(["table"=>'moyen_paiement_marchand',"champs"=>$dist]);
        if($result !== false) {
            //$this->models->__commit();
            Utils::setMessageALert(["success",$this->lang["ationsuccess"]]);
        }
        else {
            //$this->models->__rollBack();
            Utils::setMessageALert(["danger",$this->lang["ationsechec"]]);
        }
        Utils::redirect("moyen", "liste");
    }

    /**
     * @droit Modifier un moyen - 6
     */
    public function updateMoyen()
    {
        $dist = $this->paramPOST["dist"];
        $rowid = $dist['rowid'];
        unset($dist['rowid']);

        //$this->models->__beginTransaction();
        $result = $this->models->set(["table"=>'moyen_paiement_marchand',"champs"=>$dist,"condition"=>['rowid ='=> $rowid]]);
        if($result !== false) {
            //$this->models->__commit();
            Utils::setMessageALert(["success",$this->lang["ationsuccess"]]);
        }
        else {
            //$this->models->__rollBack();
            Utils::setMessageALert(["danger",$this->lang["ationsechec"]]);
        }
        Utils::redirect("moyen", "liste");
    }

    /**
     * @droit Activer un moyen - 6
     */
    public function activate()
    {
        if(intval($this->paramGET[0]) > 0) {
            $result = $this->models->updateDist(["champs"=>["etat = "=> 1], "condition"=>["rowid ="=>$this->paramGET[0]]]);
            if($result !== false) Utils::setMessageALert(["success",$this->lang["ationsuccess"]]);
            else Utils::setMessageALert(["danger",$this->lang["ationsechec"]]);
        }
        Utils::redirect("moyen", "liste");
    }

    /**
     * @droit Désactiver un moyen - 6
     */
    public function deactivate()
    {
        //var_dump($this->paramGET); die;
        if(intval($this->paramGET[0]) > 0) {
            $result = $this->models->updateDist(["champs"=>["etat = "=> 0], "condition"=>["rowid ="=>$this->paramGET[0]]]);
            if($result !== false) Utils::setMessageALert(["success",$this->lang["ationsuccess"]]);
            else Utils::setMessageALert(["danger",$this->lang["ationsechec"]]);
        }
        Utils::redirect("moyen", "liste");
    }


    public function removeMoyen()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->models->deleteMoyen(["condition" => ["rowid = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["ationsuccess"]]);
            else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        } else Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        Utils::redirect("moyen", "liste");
    }

    /*public function affectDroitProfil(){
        unset($dist);
        unset($actions);
        $dist["fk_moyenmarchand"] = $this->paramPOST['idmoyen'];
        $a=$this->models->deleteAffectation(["condition" => ["fk_moyenmarchand ="=>$dist["fk_moyenmarchand"]]]);



        $dist["date_creation"] = $this->paramPOST['date_creation'];
        $dist["user_creation"] = $this->paramPOST['user_creation'];


        $actions = $this->paramPOST['actions'];
        //print_r($actions);die();
        foreach ($actions as $action)
        {
            $dist["fk_actionmarchand"] = $action;
            $result = $this->models->set(["table"=>'affectation_marchand',"champs"=>$dist]);
            if($result == false)
            {
                Utils::setMessageALert(["danger",$this->lang["ationsechec"]]);
                break;
            }
        }

        unset($dist);
        unset($actions);
        unset($this->paramPOST);

        Utils::redirect("moyen", "liste");
    }*/

}