<?php
/**
 * Created by PhpStorm.
 * User: Seyni FAYE
 * Date: 31/01/2018
 * Time: 12:52
 */

namespace app\common;

use app\core\Utils;

trait CommonModel
{
    /**
     * Créer ici des méthodes appelable par toutes les classes models.
     */

    /**
     * Verificationde lexistance emal user des Droit
     */
    /*public function VerifEmail($param)
    {
        $this->table = $param[0];
        $this->condition=["".$param[1]."="=> $param[2] ];
        return $this->__detail();
    }*/
    /**
     * Verification de l'existance email user des Droits
     */
   /*public function VerifEmail($param,$vmail)
    {
        $this->table = $param[0];
        $this->condition=["".$param[1]."="=> $vmail];
        return $this->__detail();


    }*/

    public function consulterSoldeMarchand($idmarchant)
    {
        $this->table = "marchand";
        $this->champs = ["solde"];
        $this->condition=["idmarchand ="=> $idmarchant];
        return $this->__detail()->solde;


    }
    /* public function generateNumTransactionWoocommerceM()

    {
        while(1){
            $num = Utils::generateNumTransactionWoocommerce();
            $this->table = "transaction_compte";
            $this->champs = ["idtransaction"];
            $this->condition=["num_transaction ="=> $num];
            if (count($this->__select()) == 0){
                return $num;
            }

        }

    }*/


    public function nombreDeTransaction($idmarchand)
    {
        $this->table = "transaction";
        $this->champs = ["count(num_transac) as nombre"];
        $this->condition=["fk_marchand ="=> $idmarchand, "statut ="=> 1, "fk_service = " => 9, "YEAR(date_transaction)="=>date('Y')];
        // var_dump($this->__detail()->nombre);exit;
        return $this->__detail()->nombre;


    }
   public function montantGTransaction($idmarchand)
    {
        $this->table = "transaction";
        $this->champs = ["sum(montant) as total"] ;
        $this->condition=["fk_marchand ="=> $idmarchand, "statut ="=> 1, "fk_service = " => 9,"YEAR(date_transaction)="=>date('Y')];
        return $this->__detail()->total;


    }

    /**
     * @param $param
     * @return mixed
     */
    public function get($param)
    {
        $this->__addParam($param);
        return $this->__select();
    }

    /**
     * @param $param
     * @return mixed
     */
    public function set($param)
    {
        $this->__addParam($param);
        return (isset($param['champs']) && isset($param['condition'])) ? $this->__update() : ((!isset($param['champs']) && isset($param['condition'])) ? $this->__delete() : $this->__insert());
    }

}