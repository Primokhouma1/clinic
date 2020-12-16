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
use PhpOffice\PhpSpreadsheet\Shared\Date;

class AffectationcaisseController extends BaseController
{
    private $model;
    private $params;

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->model("affectationcaisse");
        $this->views->initTemplate(["header" => "header", "footer" => "footer", "sidebar" => "sidebar_caisse"]);
        $this->params['headers'] = ["token" => $this->_USER->token];
    }
    
    

    public function affectationcaisse__()
    {
        $data['caisse'] = $this->model->getCaisse();
        $data['caissier'] = $this->model->getCaissier();
        $this->views->setData($data);
        $this->views->getTemplate('encaissement/affectationcaisse');

    }

    public function associateCaisse__()
    {
        $idcaisse = explode("_", $this->paramPOST['caiss'])[0];
        $fk_usermarchand = explode("_", $this->paramPOST['marchand'])[0];
        $dt = $this->paramPOST['dt'];
        $heure_deb = $this->paramPOST['heure_deb'];
        $heure_fin = $this->paramPOST['heure_fin'];

        $this->params['data'] =array(
            "caisse_id"=>intval($idcaisse),
            "utilisateur_id"=>intval($fk_usermarchand),
            "date_affect"=>$dt,
            "heure_debut"=>$heure_deb,
            "heure_fin"=>$heure_fin
        );
        $result1 = $this->apiClient::get(MS_GATEWAY."accepteur/caisse/get-affectation-caisse", $this->params);
        $result2 = $this->apiClient::get(MS_GATEWAY."accepteur/caisse/get-affectation-caisse-user", $this->params);
        if($result1->code==419  && $result2->code==122 ) echo 1;
       else echo -1;

    }



    public function addAffectationCaisse()
    {
        for($i = 0 ; $i < count($this->paramPOST["nbrligne"]) ; $i++){
            $this->params['data'] =array(
                "caisse_id"=>intval($this->paramPOST["fk_idcaisse"][$i]),
                "utilisateur_id"=>intval($this->paramPOST["fk_usermarchand"][$i]),
                "date_affect"=>$this->paramPOST["date_affect"][$i],
                "heure_debut"=>$this->paramPOST["heure_debut"][$i],
                "heure_fin"=>$this->paramPOST["heure_fin"][$i],
                "heure_fin"=>$this->paramPOST["heure_fin"][$i]
            );
            //var_dump( $this->params);
            $result = $this->apiClient::post(MS_GATEWAY."accepteur/caisse/affectation-caisse", $this->params);
        }
        if ($result->code==201)
        {
            Utils::setMessageALert(["success", $this->lang["ationsuccess"]]);
        }
        else {

        }
        Utils::redirect("affectationcaisse", "affectationcaisse");

    }

    public function calendrierAffectationCaisse()
    {

        $this->views->getTemplate('encaissement/calendrierAffectationCaisse');

    }

    // -------------------- Methode calendrier Location---------------------- //
    public function loadaffectation()
    {
        $marchand_id=intval($this->_USER->id);
        $this->params['data'] =array(
            "utilisateur_id"=>$marchand_id
        );
        $affectation = $this->apiClient::get(MS_GATEWAY."accepteur/caisse/getcalendrier-affectation", $this->params);
        foreach ($affectation->data as $row)
        {
            //var_dump($row);die;
            $data[] = array(
                'id'   => $row->id,
                'title'=> 'C.N°: '.$row->numcaisse.' +-+ '.$row->prenom.' '.$row->nom,
                'start'=> $row->date_affect,
                'end'  => date('Y-m-d', strtotime($row->date_affect))
            );
        }
        echo json_encode($data);
    }

    public function detailsAffectationcaisse()
    {
       $recup_id=intval($this->paramPOST['id']);
        $this->params['data'] =array(
            "utilisateur_id"=>intval($this->_USER->id),
            "id"=>$recup_id
        );

        $result = $this->apiClient::get(MS_GATEWAY."accepteur/caisse/getcalendrier-affectation", $this->params);
        $result->data[0]->date_affect =Utils::getDateFR($result->data[0]->date_affect);
        if($result){
            echo json_encode($result->data[0]);
        }
    }


}