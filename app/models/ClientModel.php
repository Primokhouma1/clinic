<?php
/**
 * Created by PhpStorm.
 * User: Seyni FAYE
 * Date: 27/02/2017
 * Time: 16:03
 */

namespace app\models;

use app\core\BaseModel;
use http\Params;
use app\core\Utils;

class ClientModel extends BaseModel
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
        //var_dump($param);exit;
        if ($param[0]!="00" & $param[1]!="00" & $param[2]!="00"  ){
            $cond = ["date_transaction LIKE "=>$param[0]."-".str_pad($param[1],2,"0",STR_PAD_LEFT)."-".str_pad($param[2],2,"0",STR_PAD_LEFT)."%", "status_transaction ="=> 1];
        }elseif ($param[0]!="00" & $param[1]!="00" & $param[2]=="00"  ){
            $cond = ["date_transaction LIKE "=>$param[0]."-".str_pad($param[1],2,"0",STR_PAD_LEFT)."%", "status_transaction ="=> 1];

        }elseif ($param[0]!="00" & $param[1]=="00" & $param[2]=="00"  ){
            $cond=["date_transaction LIKE "=>$param[0]."%", "status_transaction ="=> 1];
        }

        // var_dump($cond);exit;
        $this->table = "transaction_api";
        $this->champs = ["idtransaction as id","num_transaction","date_transaction","montant_transation","email_acheteur","num_transac_marchand", "status_transaction"];
        $this->condition=$cond;
        return $this->__processing();
    }


    public function getTransactiond($param = null)
    {
        $this->table = "transaction_api";
        $this->__addParam($param);
        return $this->__select();
    }
    public function getOneTransaction($param = null)
    {
        $this->table = "transaction_api";
        $this->__addParam($param);
        return $this->__detail();
    }
    public function getAllTransactiond($param = null)
    {
        $this->table = "transaction_api";
        $this->champs = ["idtransaction as id","num_transaction","date_transaction","montant_transation","email_acheteur","num_transac_marchand", "status_transaction"];
        $this->condition=["date_transaction >= "=>$param[0],"date_transaction <"=>$param[1], "status_transaction ="=> 1];
        return $this->__processing();
    }
    /**
     * Ajout releve_compte_marchand
     */
    public function insertReleve($param)
    {
        $this->table = "releve_compte_marchand";
        $this->__addParam($param);
        return $this->__insert();
    }
    /**
     * Ajout Transaction_Compte
     */
    public function insertTransactionCompte($param)
    {
        $this->table = "transaction_compte_marchand";
        $this->__addParam($param);
        return $this->__insert();
    }
    /**
     * Modification Client Api
     */
    public function insertMarchandDemande($param)
    {
        $this->table = "appels_fond_marchand";
        $this->__addParam($param);
        return $this->__insert();
    }

    public function generateNumTransaction(){
        $num = -1;

        try{
            while(1){
                $num = mt_rand(1000000000000, 99999999999999);
                $this->table = "transaction_compte_marchand";
                $this->champs = ["rowid as id"];
                $this->condition=["num_transaction = "=>$num];
                if(count($this->__select()) === 0)
                    break;
            }
        }
        catch(PDOException $e){
            return -2;
        }
        return $num;
    }

    function getMarchandInfo($param)
    {
        $this->table = "marchand";
        $this->champs = ["idmarchand as id", "nom_marchand", "solde"];
        $this->condition=["idmarchand = "=>$param];
        return $this->__detail();
    }

    function consulterSoldeMarchand($param){
        $this->table = "marchand";
        $this->champs = ["solde"];
        $this->condition=["idmarchand ="=> $param];
        return $this->__detail()->solde;
    }

    function getMailMarchand($param){
        $this->table = "marchand";
        $this->champs = ["email"];
        $this->condition=["idmarchand ="=> $param];
        return $this->__detail()->email;
    }

    function getAllAppels(){
        $this->params["data"]["params"] = json_encode([
            "table"=>"mar_appels_fond a",
            "champs"=>["a.id", "a.date", "a.montant","m.nom as nom", "a.statut"],
            "jointure" => ["INNER JOIN utilisateur m ON a.user_marchand_id = m.id"],
            "condition"=>["a.marchand_id = " =>$this->_USER->marchand_id],
            "request"=>$_REQUEST
        ]);
        $result = $this->apiClient::get(MS_GATEWAY."processing/processing", $this->params);
        $result->data = Utils::array_recursive_convert($result->data);
        return $result->data;
    }


    function getAppel($param = null){
        $this->table = "appels_fond_marchand a";
        $this->champs = ["a.rowid as id ", "a.montant", "u.nom", "u.prenom", "m.nom_marchand as marchand"];
        $this->jointure =
            [
                "INNER JOIN user_marchand u ON u.iduser = a.fk_user_marchand",
                "INNER JOIN marchand m ON m.idmarchand = a.fk_marchand"
            ];
        $this->__addParam($param);
        return $this->__select();
    }


    function getReleve($param = null){
        if($param[0]!='' && $param[1]!=''){
            //var_dump("non vide");die;
            $this->params["data"]["params"] = json_encode([
                "table"=>"mar_releve_compte a",
                "champs"=>["a.id", "a.date_transaction", "a.num_transac", "a.solde_avant", "a.montant", "a.solde_apres"],
                "jointure" => ["INNER JOIN utilisateur m ON a.marchand_id = m.marchand_id"],
               "condition"=>["a.marchand_id ="=> $this->_USER->marchand_id,"Date(date_transaction) >=" => $param[0],
                   "Date(date_transaction) <=" => $param[1]],
                "request"=>$_REQUEST,
                "group"=>["a.id"]
            ]);
          //  var_dump($this->params["data"]["params"] );
        } else {
           // var_dump("vide");die;
            $this->params["data"]["params"] = json_encode([
                "table"=>"mar_releve_compte a",
                "champs"=>["a.id", "a.date_transaction", "a.num_transac", "a.solde_avant", "a.montant", "a.solde_apres"],
                "jointure" => ["INNER JOIN utilisateur m ON a.marchand_id = m.marchand_id"],
                "condition"=>["a.marchand_id ="=> $this->_USER->marchand_id],
                "request"=>$_REQUEST,
                "group"=>["a.id"]
            ]);
          }
        $result = $this->apiClient::get(MS_GATEWAY."processing/processing", $this->params);
        $result->data = Utils::array_recursive_convert($result->data);
        return $result->data;
    }

    function getRelevePdf($param = null){
        $this->table = "mar_releve_compte";
        $this->champs = ["id", "date_transaction", "num_transac", "solde_avant", "montant", "solde_apres"];
        $this->__addParam($param);
        return $this->__select();
    }

    function validateAppel($param){
        $this->table = "appels_fond_marchand";
        $this->__addParam($param);
        return $this->__update();
    }

    function updateSoldeMarchand($param){
        $this->table = "marchand";
        $this->__addParam($param);
        return $this->__update();
    }

    function getMail(){
        $this->table = "mail_virement";
        $this->champs = ["rowid", "message", "destinataire", "prenom", "nom"];
        $this->condition=["type ="=> 3];
        return $this->__select();
    }
}