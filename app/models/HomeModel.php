<?php
/**
 * Created by PhpStorm.
 * User: Seyni FAYE
 * Date: 27/02/2017
 * Time: 16:03
 */

namespace app\models;

use app\core\BaseModel;

class HomeModel extends BaseModel
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

    public function getUtilisateur($param = null)
    {
        $this->table = "client_api";
        $this->__addParam($param);
        return $this->__select();
    }

   /* public function getOneUtilisateur($param = null)
    {
        $this->table = "user_marchand u";
        $this->champs =["u.iduser as id",
                        "u.prenom",
                        "u.nom",
                        "u.email",
                        "u.telephone",
                        "u.login",
                        "u.password",
                        "u.fk_profil",
                        "u.fk_marchand",
                        "u.admin",
                        "u.statut",
                        "u.is_already_connect",
                        "m.nom_marchand",
                        "m.type",
                        "p.typeprofil"];
        $this->jointure = [
            "INNER JOIN marchand m ON u.fk_marchand = m.idmarchand",
            "INNER JOIN profil_marchand p ON u.fk_profil = p.rowid"
            ];
        $this->__addParam($param);
        return $this->__detail();
    }*/

    public function getOneUtilisateur($param = null)
    {
        $this->table = "j_utilisateur";
        $this->__addParam($param);
        return $this->__detail();
    }

    public function updatePasswordFirstConnect($param = null){
        $this->table = "user_marchand";
        $this->__addParam($param);
        return $this->__update();
    }


}