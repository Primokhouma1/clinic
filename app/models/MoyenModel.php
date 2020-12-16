<?php
/**
 * Created by PhpStorm.
 * User: Seyni FAYE
 * Date: 27/02/2017
 * Time: 16:03
 */

namespace app\models;

use app\core\BaseModel;

class MoyenModel extends BaseModel
{
    /**
     * HomeModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * HomeModel destruct.
     */
    public function __destruct()
    {
        parent::__destruct();
    }

    function getListeMoyenProcess() {
        $this->table = "moyen_paiement_marchand";
        $this->champs = ["rowid", "label", "etat"];
        return $this->__processing();
    }

    function updateDist($param) {
        $this->table = "moyen_paiement_marchand";
        $this->__addParam($param);
        return $this->__update();
    }


    /*public function getModules()
    {
        $this->table = "module_marchand";
        $this->champs = ["rowid", "label", "etat"];
        $this->condition = ["etat ="=>1];
        return $this->__select();
    }

    public function getActions($module)
    {
        $this->table = "action_marchand";
        $this->champs = ["rowid", "label", "etat"];
        $this->condition = ["etat ="=>1, "fk_modulemarchand ="=>$module];
        return $this->__select();
    }

    public function getAffectations($profil, $action)
    {
        $this->table = "affectation_marchand";
        $this->champs = ["fk_profilmarchand", "fk_actionmarchand"];
        $this->condition = ["etat ="=>1, "fk_profilmarchand ="=>$profil, "fk_actionmarchand ="=>$action ];
        return $this->__detail();
    }


    public function updateDroitProfil($param)
    {
        $this->table = "affectation_marchand";
        $this->__addParam($param);
        return $this->__update();
    }*/

    /**
     * Suppression profil_marchand
     */
    /*public function deleteModule($param)
    {
        $this->table = "profil_marchand";
        $this->__addParam($param);
        return $this->__delete();
    }*/

    public function deleteMoyen($param)
    {
        $this->table = "moyen_paiement_marchand";
        $this->__addParam($param);
        return $this->__delete();
    }
}