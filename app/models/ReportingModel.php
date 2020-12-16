<?php
/**
 * Created by PhpStorm.
 * User: Seyni FAYE
 * Date: 27/02/2017
 * Time: 16:03
 */

namespace app\models;

use app\core\BaseModel;
use app\core\Utils;

class ReportingModel extends BaseModel
{

    private $params;
    /**
     * HomeModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->params['headers'] = ["token"=>$this->_USER->token];
    }

    /**
     * HomeModel destruct.
     */
    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * Lister Transaction
     */
    public function getAllTransaction($param = null)
    {
        $datej= date("Y-m-d");
     //   var_dump($this->_USER->marchand_id);die();
        $this->params["data"]["params"] = json_encode([
            "table"=>"mar_transaction t",
            "champs"=>["t.id", "t.date_transaction", "t.num_transaction", "t.montant"],
           //"jointure"=>["INNER JOIN mar_caisse c ON t.marchand_id = c.marchand_id"],
            "condition"=>["DATE(t.date_transaction) = " =>$datej],
            "request"=>$_REQUEST,
            "group"=>["t.id"]
        ]);
        $result = $this->apiClient::get(MS_GATEWAY."processing/processing", $this->params);
        $result->data = Utils::array_recursive_convert($result->data);
        //var_dump($result);die;
        return $result->data;

    }

    public function getAllCaisse($param = null)
    {
        $this->table = "caisse_marchand";
        $this->champs = ["rowid","numcaisse"];
        $this->condition=["fk_marchand = " =>$this->_USER->fk_marchand,"etat = "=>1];
        return $this->__select();
    }

    public function getAllTransactionJ($param = null)
    {

        $this->table = "transaction t";
        $this->champs = ["t.rowid as id", "t.date_transaction", "t.num_transac", "t.montant", "m.numcaisse"];
        $this->jointure = [
            "LEFT JOIN caisse_marchand m ON t.fk_caisse_marchand = m.rowid"
            //   "INNER JOIN user_marchand u ON t.fk_user_marchand = u.iduser"
        ];

      // $this->condition=["DATE(t.date_transaction) = "=>$param];
        if($this->_USER->typeprofil == 2)
        {
            $this->condition=["DATE(t.date_transaction) = "=>$param,
                              "t.fk_marchand = " =>$this->_USER->fk_marchand,
                              "t.fk_service = "=>ID_SERVICE_PAIEMENT_MARCHAND,
                              "t.fk_user_marchand = "=>$this->_USER->id];
        }
        else{
            $this->condition=["DATE(t.date_transaction) = "=>$param,
                              "t.fk_marchand = " =>$this->_USER->fk_marchand,
                              "t.fk_service = "=>ID_SERVICE_PAIEMENT_MARCHAND];
        }

        return $this->__select();
    }

    /*public function getAllTransactionP($param = null)
    {

        if($param[0] != 0 && $param[1] != 0 && $param[2] != 0)
        {
            if($this->_USER->typeprofil == 2)
            {
                $cond = ["DATE(t.date_transaction) >=" => $param[0],
                    "DATE(t.date_transaction) <=" => $param[1],
                    "t.fk_caisse_marchand = " =>$param[2],
                    "t.fk_marchand = " => $this->_USER->fk_marchand,
                    "t.fk_service = " => ID_SERVICE_PAIEMENT_MARCHAND,
                    "t.fk_user_marchand = " => $this->_USER->id
                ];
            }
            else{
                $cond = ["DATE(t.date_transaction) >=" => $param[0],
                    "DATE(t.date_transaction) <=" => $param[1],
                    "t.fk_caisse_marchand = " =>$param[2],
                    "t.fk_marchand = " => $this->_USER->fk_marchand,
                    "t.fk_service = " => ID_SERVICE_PAIEMENT_MARCHAND
                ];
            }
        }
        elseif($param[0]!=0 && $param[1] != 0)
        {
            if($this->_USER->typeprofil == 2)
            {
                $cond = ["DATE(t.date_transaction) >=" => $param[0],
                    "DATE(t.date_transaction) <=" => $param[1],
                    "t.fk_marchand = " => $this->_USER->fk_marchand,
                    "t.fk_service = " => ID_SERVICE_PAIEMENT_MARCHAND,
                    "t.fk_user_marchand = " => $this->_USER->id
                ];
            }
            else{
                $cond = ["DATE(t.date_transaction) >=" => $param[0],
                    "DATE(t.date_transaction) <=" => $param[1],
                    "t.fk_marchand = " => $this->_USER->fk_marchand,
                    "t.fk_service = " => ID_SERVICE_PAIEMENT_MARCHAND
                ];
            }
        }
        elseif($param[0] > 0)
        {
            if($this->_USER->typeprofil == 2)
            {
                $cond = ["t.fk_caisse_marchand = " =>$param[0],
                    "t.fk_marchand = " => $this->_USER->fk_marchand,
                    "t.fk_service = " => ID_SERVICE_PAIEMENT_MARCHAND,
                    "t.fk_user_marchand = " => $this->_USER->id
                ];
            }
            else{
                $cond = ["t.fk_caisse_marchand = " =>$param[0],
                    "t.fk_marchand = " => $this->_USER->fk_marchand,
                    "t.fk_service = " => ID_SERVICE_PAIEMENT_MARCHAND
                ];
            }
        }
        else{
            if($this->_USER->typeprofil == 2)
            {
                $cond = ["t.fk_marchand = " => $this->_USER->fk_marchand,
                         "t.fk_service = " => ID_SERVICE_PAIEMENT_MARCHAND,
                         "t.fk_user_marchand = " => $this->_USER->id];
            }
            else{
                $cond = ["t.fk_marchand = " => $this->_USER->fk_marchand,
                         "t.fk_service = " => ID_SERVICE_PAIEMENT_MARCHAND];
            }
        }
        $this->table = "transaction t";
        $this->champs = ["t.rowid as id", "t.date_transaction", "t.num_transac", "t.montant", "m.numcaisse"];
        $this->jointure = [
            "LEFT JOIN caisse_marchand m ON t.fk_caisse_marchand = m.rowid"
         //   "INNER JOIN user_marchand u ON t.fk_user_marchand = u.iduser"
        ];
        var_dump($cond);exit;
        $this->condition=$cond;
        return $this->__processing();
    }*/

    public function getAllTransactionP($param = null)
    {
        $cond = [];
        if($param['datedebut'] != 0 )
        {
            $cond = array_merge($cond, ["DATE(t.date_transaction) >=" => $param['datedebut']]);
        }

        if($param['datefin'] != 0 )
        {
            $cond = array_merge($cond, ["DATE(t.date_transaction) <=" => $param['datefin']]);
        }

        if($param['fk_caisse'] != 0 )
        {
            $cond = array_merge($cond, ["t.caisse_id = " =>intval($param['fk_caisse'])]);
        }

        $this->params["data"]["params"] = json_encode([
            "table"=>"mar_transaction t",
            "champs"=>["t.id", "t.date_transaction", "t.num_transaction", "t.montant", "c.numcaisse"],
            "jointure"=>["INNER JOIN mar_caisse c ON t.caisse_id = c.id"],
            "condition"=>$cond,
            "request"=>$_REQUEST,
            "group"=>["t.id"]
        ]);

        $result = $this->apiClient::get(MS_GATEWAY."processing/processing", $this->params);
        $result->data = Utils::array_recursive_convert($result->data);
        return $result->data;
    }

    public function getAllTransactiond($param = null)
    {

        $this->table = "transaction t";
        $this->champs = ["t.rowid as id","t.date_transaction","t.num_transac","t.montant","m.numcaisse"];
        $this->jointure = [
            "INNER JOIN caisse_marchand m ON t.fk_caisse_marchand = m.rowid"
        ];
        $this->__addParam($param);
        return $this->__select();
    }


}