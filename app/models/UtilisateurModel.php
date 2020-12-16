<?php
/**
 * Created by PhpStorm.
 * User: Seyni FAYE
 * Date: 27/02/2017
 * Time: 16:03
 */

namespace app\models;

use app\core\BaseModel;

class UtilisateurModel extends BaseModel
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

    /**
     * Ajout utilisateur
     */
    public function insertUtilisateur($param)
    {

        $this->table = "utilisateur";
        $this->__addParam($param);
        return $this->__insert();
    }
    /**
     * Lister Utilisateur
     */
    public function getAllUtilisateur($param = null)
    {
        $this->table = "utilisateur";
        $this->champs = ["id","prenom","nom","email","login"];
        return $this->__processing();
    }
    public function getUtilisateur($param = null)
    {
        $this->table = "utilisateur";
        $this->__addParam($param);
        return $this->__select();
    }
    public function getOneUtilisateur()
    {
        $this->table = "user_marchand u";
        $this->champs = ["u.nom", "u.prenom","u.email", "u.telephone", "u.guichet", "u.password", "p.libelle as profil", "m.nom_marchand", "m.email as mail_Marchand", "m.telephone_fixe", "m.telmobile", "m.solde"];
        $this->jointure = [
            "INNER JOIN marchand m ON m.idmarchand = u.fk_marchand",
            "INNER JOIN profil_marchand p ON p.rowid = u.fk_profil"
        ];
        $this->condition=["u.iduser ="=> $this->_USER->id];
        return $this->__detail();
    }
    /**
     * Modification Utilisateur
     */
    public function updateUtilisateur($param)
    {
        $this->table = "user_marchand";
        $this->__addParam($param);
        return $this->__update();
    }
    /**
     * Suppression Utilisateur
     */
    public function deleteUtilisateur($param)
    {
        $this->table = "utilisateur";
        $this->__addParam($param);
        return $this->__delete();
    }

    /**
     * Verification mot de passe
     * */

    public function verifPassword($password)
    {
        $this->table = "user_marchand";
        $this->condition=["iduser ="=> $this->_USER->id, "password =" => $password];
        return $this->__detail();
    }
}