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

class AppelController extends BaseController
{
    private $clientModels;
    private $params;
    public function __construct()
    {

        parent::__construct();
        $this->clientModels = $this->model("client");
        $this->views->initTemplate(["header" => "header", "footer" => "footer", "sidebar" => "sidebar_client"]);
        $this->params['headers'] = ["token"=>$this->_USER->token];

    }
     /* appel de fond */
    public function appelDeFond()
    {
        $fk_marchand = $this->_USER->marchand_id;
        $this->params['data'] =array(
            "id"=>intval($fk_marchand)
        );
        $data['soldeavant'] = $this->apiClient::get(MS_GATEWAY."accepteur/caisse/getinfos-marchand", $this->params);
       $this->views->setData($data);
        $this->views->getTemplate('client/appelDeFond');
    }



    public function listeReleve()
    {
        if(isset($this->paramPOST["datedebut"]) & isset($this->paramPOST["datefin"])) {
            $param['datedebut'] = $this->paramPOST['datedebut'];
            $param['datefin'] = $this->paramPOST['datefin'];
            $this->views->setData($param);
        }
        $this->views->getTemplate('client/listeReleve');
    }

    public function listeRelevePro__()
    {
        $param = [
            "button" => [
                "modal" => [
                ],
                "default" => [
                ]
                //"custom" => ["<span style='color: red;'>test</span>",["champ"=>"nom","val"=>["Faye"=>"<span style='color: red;'>faye</span>"]]]
            ],
            "tooltip" => [],
            "classCss" => [
                "modal" => [],
                "default" => []
            ],
            "attribut" => [],
            "args" => $this->paramGET,
            "dataVal" => [
            ],
            "fonction" => [
                'date_transaction' => 'getDateFR',
                'solde_avant' => 'getFormatMoney',
                'montant' => 'getFormatMoney',
                'solde_apres' => 'getFormatMoney'
            ]
        ];
        $this->processing($this->clientModels, 'getReleve', $param);

    }

    public function ajoutappelDeFond()
    {

        $fk_marchand = $this->_USER->marchand_id;
        //var_dump($fk_marchand);exit;
        $id_marchand = $this->_USER->id;

        $mnt = $this->paramPOST["montant_"];

        $mnt = intval($mnt);

        //var_dump($mnt);die();

        $this->params['data'] =array(
            "id"=>intval($fk_marchand)
        );
        $data['soldeavant']->data->solde = $this->apiClient::get(MS_GATEWAY."accepteur/caisse/getinfos-marchand",
            $this->params);
        $soldeavant=intval($data['soldeavant']->data->solde->data->solde);
        if ($mnt < $soldeavant) {

            $this->params['data'] =array(
                "montant"=>$mnt,
                "marchand_id"=>intval($id_marchand),
                "user_marchand_id"=>intval($fk_marchand)
            );
            $result = $this->apiClient::post(MS_GATEWAY."accepteur/caisse/addappel-fond", $this->params);

            if ($result->code==201){

                Utils::setMessageALert(["success", "Votre appel de fond est en attente de validation"]);

                $infos = $this->clientModels->getMail();



                //var_dump($infos);die();

                //if(Utils::validateMail($this->paramPOST["email"])) {
                $subjet = "Demande d'appel de fonds ";
                $email = $infos[0]->destinataire;
                //$nom_marchand = $this->clientModels->getMarchandInfo($fk_marchand);

                $contenue = $infos[0]->message;
                Utils::sendMailAlert($email, $contenue, $subjet, "Admin");
                Utils::setMessageALert(["success", $this->lang["actionsuccess"]]);

                Utils::setMessageALert(["success",$this->lang["ationsuccess"]]);
                //
            }
            else{
                Utils::setMessageALert(["danger", "Une erreur est survenue. Merci de contacter le fournisseur de l'api"]);
            }

        } else {
//            $status_transaction = 0;
//            @$this->clientModels->insertTransactionCompte(["champs" => ["num_transaction" => $numtrans, "date_transaction" => $date, "montant_transation" => $mnt, "status_transaction" => $status_transaction, "marchand_idmarchand" => $id_marchand, "commentaire" => "Solde insuffisant"]]);
            Utils::setMessageALert(["danger", "Le solde de votre compte est insuffisant pour effectué l'opération."]);

        }
        Utils::redirect("appel", "listeAppelsFond");
    }


    //******** FIN Appel de Fond  *************//
    //******** FIN Appel de Fond  *************//


    //******** Gestion des client  *************//
    //******** Gestion des client  *************//
    // Liste transaction //
    public function transaction_du_jour()
    {
        // var_dump($this->paramGET);exit;
        $param["anne"] = gmdate("Y");
        $param["mois"] = gmdate("m");
        $param["jour"] = gmdate("d");
        $this->views->setData($param);
        $this->views->getTemplate('client/T_jour');

    }

    public function transaction_du_mois()
    {
        // var_dump($this->paramGET);exit;
        $param["anne"] = gmdate("Y");
        $param["mois"] = gmdate("m");
        $param["jour"] = "00";
        $this->views->setData($param);
        $this->views->getTemplate('client/T_mois');

    }

    public function transaction_de_annee()
    {
        // var_dump($this->paramGET);exit;
        $param["anne"] = gmdate("Y");
        $param["mois"] = "00";
        $param["jour"] = "00";
        $this->views->setData($param);
        $this->views->getTemplate('client/T_annee');

    }

    public function listeTransactionPro__()
    {
        $param = [
            "button" => [
                "modal" => [
                ],
                "default" => [
                    ["client/detailTransaction/", "fa fa-search"]
                ]
                //"custom" => ["<span style='color: red;'>test</span>",["champ"=>"nom","val"=>["Faye"=>"<span style='color: red;'>faye</span>"]]]
            ],
            "tooltip" => [],
            "classCss" => [
                "modal" => [],
                "default" => ["confirm"]
            ],
            "attribut" => [],
            "args" => $this->paramGET,
            "dataVal" => [
                ["champ" => "status_transaction", "val" => ["0" => ["<span style='color: #f00;'>Echec</span>"], "1" => ["<span style='color: green;'>Succès</span>"]]]
            ],
            "fonction" => [
                'montant_transation' => 'getFormatMoney'
            ]
        ];
        $this->processing($this->clientModels, 'getAllTransaction', $param);

    }


    public function listeTransactiond()
    {
        if (isset($this->paramPOST["datedebut"]) & isset($this->paramPOST["datefin"])) {
            $param['datedebut'] = $this->paramPOST['datedebut'];
            $param['datefin'] = $this->paramPOST['datefin'];

        }
        $this->views->setData($param);
        $this->views->getTemplate('client/listeTransactiond');
    }

    public function listeTransactiondPro__()
    {
        $param = [
            "button" => [
                "modal" => [
                ],
                "default" => [
                    ["client/detailTransaction/", "fa fa-search"]
                ]
            ],
            "tooltip" => [],
            "classCss" => [
                "modal" => [],
                "default" => ["confirm"]
            ],
            "attribut" => [],
            "args" => $this->paramGET,
            "dataVal" => [
                ["champ" => "status_transaction", "val" => ["0" => ["<span style='color: #f00;'>Echec</span>"], "1" => ["<span style='color: green;'>Succès</span>"]]]
            ],
            "fonction" => [
                'montant_transation' => 'getFormatMoney'
            ]
        ];
        $this->processing($this->clientModels, 'getAllTransactiond', $param);

    }

    public function detailTransaction()
    {

        $data['transact'] = $this->clientModels->getOneTransaction(["condition" => ["idtransaction = " => $this->paramGET[0]]]);
        $this->views->setData($data);
        $this->views->getTemplate("client/detailTransaction");

    }

    public function export()
    {
        if(isset($this->paramGET[0])) $this->params['data']["d_date_transaction"] = $this->paramGET[0];
        if(isset($this->paramGET[1])) $this->params['data']["f_date_transaction"] = $this->paramGET[1];
        $this->params['data']["marchand_id"] =intval($this->_USER->marchand_id);
        $data['transact'] = $this->apiClient::get(MS_GATEWAY."accepteur/caisse/getreleve-marchand", $this->params);
        $data['transact']=$data['transact']->data;
        //var_dump($data['transact']);die;
        $data['nom'] = $this->clientModels->getMarchandInfo($this->params);
        $this->views->setData($data);
        $this->views->exportToPdf('client/printTransaction');
    }


    public function getMarchandInfo(){
        $data['infos'] = $this->clientModels->getMarchandInfo($this->paramPOST["id"]);
        print_r(json_encode($data['infos']));
    }

    public function listeAppelsFond() {
        $this->views->getTemplate('client/listeAppelA');
    }

    public function listeAppelsFondsPro__(){
        $param = [
            "button" => [
                "modal" => [
                    //["champ" => "etat", "val" => ["0" => ["client/modifAppelModal", "client/modifAppelModal", "fa fa-check"]]]
                ],
                "default" => [
                ]
                //"custom" => ["<span style='color: red;'>test</span>",["champ"=>"nom","val"=>["Faye"=>"<span style='color: red;'>faye</span>"]]]
            ],
            "tooltip"=> [
                "modal" => [
                    "Valider"
                ],
                "default" => [
                ]
            ],
            "classCss" => [
                "modal" => [],
                "default" => []
            ],
            "attribut" => [],
            "args" => null,
            "dataVal" => [
                ["champ" => "statut", "val" => ["0" => ["<i class='text-danger'>En attente</i>"], "2" => ["<i class='text-success'>Validé</i>"], "1" => ["<i class='text-success'>Autorisé</i>"]]]
            ],
            "fonction" => [
                'date' => 'getDateFR',
                'montant' => 'getFormatMoney'
            ]
        ];
        $this->processing($this->clientModels, 'getAllAppels', $param);

    }



    public function modifAppelModal(){
        $data['appel'] = $this->clientModels->getAppel(["condition" => ["a.rowid = " => $this->paramGET[2], "a.fk_marchand="=>$this->_USER->fk_marchand]])[0];
        $this->views->setData($data);
        $this->modal();
    }

    public function validateAppel(){
        //var_dump($this->paramPOST);die();
        $id_marchand = $this->_USER->fk_marchand;

        $id_user_marchand = $this->_USER->id;

        $montant = intval($this->paramPOST['montant']);

        $soldeavant = intval($this->clientModels->consulterSoldeMarchand($id_marchand));

        $new_solde = $soldeavant - $montant;

        $numtrans = $this->clientModels->generateNumTransaction();

        $this->clientModels->__beginTransaction();

        $result = $this->clientModels->updateSoldeMarchand(["champs" => ["solde" => $new_solde], "condition" => ["idmarchand = " => $id_marchand]]);



        if ($result !== false){
            $soldeapres = intval($this->clientModels->consulterSoldeMarchand($id_marchand));
            $date = date('Y-m-d H:i:s');
            $status_transaction = 1;
            $result1 = $this->clientModels->insertReleve(["champs" => ["num_transac" => $numtrans, "solde_avant" => $soldeavant, "solde_apres" => $soldeapres, "montant" => $montant, "date_transaction" => $date, "fk_user_marchand" => $id_user_marchand, "marchand" => $id_marchand]]);

            $result2 = $this->clientModels->insertTransactionCompte(["champs" => ["num_transaction" => $numtrans, "date_transaction" => $date, "montant" => $montant, "statut" => $status_transaction, "fk_marchand" => $id_marchand, "commentaire" => "Appel de fonds succes"]]);


            if($result1 > 0 && $result2 > 0){
                /*
             *  Mise a jour table appel de fond
             * */
                $data['condition'] = ["rowid = " => intval($this->paramPOST['id'])];
                $this->paramPOST['fk_date_validation'] = date('Y-m-d H:i:s');
                $this->paramPOST['etat'] = 1;
                $this->paramPOST['fk_user_validation'] = $id_user_marchand;
                unset($this->paramPOST['id']);
                $data['champs'] = $this->paramPOST;
                $result3 = $this->clientModels->validateAppel($data);
                if($result3 !== false) {
                    $this->clientModels->__commit();
                    Utils::setMessageALert(["success", "Appel de fonds effectué avec succès."]);

                    //$email = $this->clientModels->getMailMarchand($id_marchand);

                    $subjet = "Information sur votre appel de fonds ";
                    //$email = $this->paramPOST["email"];
                    $email = "ibrahima.fall@numherit.com";
                    $nom_marchand = $this->clientModels->getMarchandInfo($id_marchand);

                    $contenue = "Votre appel de fonds du montant de : ".$montant." Ar a étè validé. Votre nouveau solde est de ".$nom_marchand->solde." Ar";


                    Utils::sendMailAlert($email, $contenue, $subjet, $nom_marchand->nom_marchand);

                }else {
                    $this->clientModels->__rollBack();
                    Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
                }
            } else {
                $this->clientModels->__rollBack();
                Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
            }
        }
        else{
            $this->clientModels->__rollBack();
            Utils::setMessageALert(["danger", $this->lang["ationsechec"]]);
        }


        Utils::redirect("client", "listeAppelsFond");
    }

    //******** FIN Gestion des client  *************//
    //******** FIN Gestion des client  *************//


}