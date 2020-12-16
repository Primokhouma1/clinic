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

class ReportingController extends BaseController
{
    private $model;
    private $reportingModels;
    private $params;

    public function __construct()
    {

        parent::__construct();
        $this->reportingModels = $this->model("reporting");
        $this->views->initTemplate(["header" => "header", "footer" => "footer", "sidebar" => "sidebar_reporting"]);
        $this->params['headers'] = ["token"=>$this->_USER->token];
        $this->model = $this->model("affectationcaisse");
    }

    //******** Gestion des reporting  *************//
    public function transaction_du_jour()
    {
        $this->views->getTemplate('reporting/listeTransactionJour');
    }

    public function listeTransactionPro__()
    {
        $dtjr=date('Y-m-d');
        //$dtjr=datetime();

        $param = [
            "button" => [
                "modal" => [
                ],
                "default" => [
                  //  ["reporting/detailTransaction/", "fa fa-search"]
                ]
                //"custom" => ["<span style='color: red;'>test</span>",["champ"=>"nom","val"=>["Faye"=>"<span style='color: red;'>faye</span>"]]]
            ],
            "tooltip" => [],
            "classCss" => [
                "modal" => [],
                "default" => ["confirm"]
            ],
            "attribut" => [],
            "args" => $dtjr,
            "dataVal" => [
                ["champ" => "status_transaction", "val" => ["0" => ["<span style='color: #f00;'>Echec</span>"], "1" => ["<span style='color: green;'>Succès</span>"]]]
            ],
            "fonction" => [
                'montant' => 'getFormatMoney',
                'date_transaction' => 'getDateFR',
            ]
        ];
        $this->processing($this->reportingModels, 'getAllTransaction', $param);
    }

    public function listeTransactionP()
    {
            $param['datedebut'] = $this->paramPOST['datedebut'];
            $param['datefin'] = $this->paramPOST['datefin'];
            $param['fk_caisse'] = $this->paramPOST['fk_caisse'];
        $param['caisse'] = $this->model->getCaisse();
      //  echo "<pre>"; var_dump($param['caisse']);exit;
        $this->views->setData($param);
        $this->views->getTemplate('reporting/listeTransactionP');
    }

    public function listeTransactionPPro__()
    {
       // var_dump(1111);exit;
        $param = [
            "button" => [
                "modal" => [
                ],
                "default" => [
                   // ["reporting/detailTransaction/", "fa fa-search"]
                ]
            ],
            "tooltip" => [],
            "classCss" => [
                "modal" => [],
                "default" => ["confirm"]
            ],
            "attribut" => [],
            "args" => ["datedebut"=>$this->paramGET[0],"datefin"=>$this->paramGET[1],"fk_caisse"=>$this->paramGET[2]],
            "dataVal" => [
                ["champ" => "status_transaction", "val" => ["0" => ["<span style='color: #f00;'>Echec</span>"], "1" => ["<span style='color: green;'>Succès</span>"]]]
            ],
            "fonction" => [
                'montant' => 'getFormatMoney',
                'date_transaction' => 'getDateFR',
            ]
        ];
        //var_dump($param);
        $this->processing($this->reportingModels, 'getAllTransactionP', $param);
    }



    public function export()
    {
        if(isset($this->paramGET) && $this->paramGET !=null){
            $this->params['data'] =array(
                "d_date_transaction"=>$this->paramGET[0],
                "f_date_transaction"=>$this->paramGET[1],
                /*"caisse_id"=>intval($this->paramGET[2]),*/
                "marchand_id"=>intval($this->_USER->marchand_id)
            );
        }else {
            $this->params['data'] =array(
                "marchand_id"=>intval($this->_USER->marchand_id)
            );
        }

        if(isset($this->paramGET[0])) $this->params['data']["d_date_transaction"] = $this->paramGET[0];
        if(isset($this->paramGET[1])) $this->params['data']["f_date_transaction"] = $this->paramGET[1];
        $this->params['data']["marchand_id"] = intval($this->_USER->marchand_id);
        $data['transact'] = $this->apiClient::get(MS_GATEWAY."accepteur/caisse/transaction-marchand", $this->params);
        $data['transact']=$data['transact']->data;
        $this->views->setData($data);
        $this->views->exportToPdf('reporting/printTransaction');
    }
    public function exportJ()
    {
            $this->params['data'] =array(
                "marchand_id"=>intval($this->_USER->marchand_id),
                "date_jour"=>date("yy-m-d"));
        $data['transact'] = $this->apiClient::get(MS_GATEWAY."accepteur/caisse/transaction-marchand", $this->params);
        $data['transact']=$data['transact']->data;
        $this->views->setData($data);
        $this->views->exportToPdf('reporting/printTransaction');
    }

    public function exportp()
    {
         if ($this->paramGET[0]!='' && $this->paramGET[1]!='' && $this->paramGET[2]!='')
         {
             if($this->_USER->typeprofil == 2)
             {
                 $data['transact'] = $this->reportingModels->getAllTransactiond(
                     ["condition"=>["DATE(t.date_transaction) >=" => $this->paramGET[0],
                                    "DATE(t.date_transaction) <=" => $this->paramGET[1],
                                    "t.fk_caisse_marchand = " =>$this->paramGET[2],
                                    "t.fk_marchand = " => $this->_USER->fk_marchand,
                                    "t.fk_service = " => ID_SERVICE_PAIEMENT_MARCHAND,
                                    "t.fk_user_marchand = " => $this->_USER->id
                                    ]
                     ]);
             }
             else{
                 $data['transact'] = $this->reportingModels->getAllTransactiond(
                     ["condition"=>["DATE(t.date_transaction) >=" => $this->paramGET[0],
                                    "DATE(t.date_transaction) <=" => $this->paramGET[1],
                                    "t.fk_caisse_marchand = " =>$this->paramGET[2],
                                    "t.fk_marchand = " => $this->_USER->fk_marchand,
                                    "t.fk_service = " => ID_SERVICE_PAIEMENT_MARCHAND
                                    ]
                     ]);
             }
         }
         elseif ($this->paramGET[0]!='' && $this->paramGET[1]!='')
         {
             if($this->_USER->typeprofil == 2)
             {
                 $data['transact'] = $this->reportingModels->getAllTransactiond(
                     ["condition"=>["DATE(t.date_transaction) >=" => $this->paramGET[0],
                                    "DATE(t.date_transaction) <=" => $this->paramGET[1],
                                    "t.fk_marchand = " => $this->_USER->fk_marchand,
                                    "t.fk_service = " => ID_SERVICE_PAIEMENT_MARCHAND,
                                    "t.fk_user_marchand = " => $this->_USER->id
                                    ]
                     ]);
             }
             else{
                 $data['transact'] = $this->reportingModels->getAllTransactiond(
                     ["condition"=>["DATE(t.date_transaction) >=" => $this->paramGET[0],
                                    "DATE(t.date_transaction) <=" => $this->paramGET[1],
                                    "t.fk_marchand = " => $this->_USER->fk_marchand,
                                    "t.fk_service = " => ID_SERVICE_PAIEMENT_MARCHAND
                                    ]
                     ]);
             }
         }
         elseif ($this->paramGET[0]!='')
         {
             if($this->_USER->typeprofil == 2)
             {
                 $data['transact'] = $this->reportingModels->getAllTransactiond(
                     ["condition"=>["t.fk_caisse_marchand = " =>$this->paramGET[0],
                                    "t.fk_marchand = " => $this->_USER->fk_marchand,
                                    "t.fk_service = " => ID_SERVICE_PAIEMENT_MARCHAND,
                                    "t.fk_user_marchand = " => $this->_USER->id
                                    ]
                     ]);
             }
             else{
                 $data['transact'] = $this->reportingModels->getAllTransactiond(
                     ["condition"=>["t.fk_caisse_marchand = " =>$this->paramGET[0],
                                    "t.fk_marchand = " => $this->_USER->fk_marchand,
                                    "t.fk_service = " => ID_SERVICE_PAIEMENT_MARCHAND
                                    ]
                     ]);
             }
         }else{
             if($this->_USER->typeprofil == 2)
             {
                 $data['transact'] = $this->reportingModels->getAllTransactiond(
                     ["condition"=>["t.fk_marchand = " => $this->_USER->fk_marchand,
                                    "t.fk_service = " => ID_SERVICE_PAIEMENT_MARCHAND,
                                    "t.fk_user_marchand = " => $this->_USER->id
                                    ]
                     ]);
             }
             else{
                 $data['transact'] = $this->reportingModels->getAllTransactiond([
                     "condition"=>["t.fk_marchand = " => $this->_USER->fk_marchand,
                                    "t.fk_service = " => ID_SERVICE_PAIEMENT_MARCHAND
                                    ]
                    ]);
             }
         }
         $this->views->setData($data);
         $this->views->exportToPdf('reporting/printTransactionP');
    }

    //******** FIN Gestion des reporting  *************//

}