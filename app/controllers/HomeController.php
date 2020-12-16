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
use app\core\TokenJWT;
use app\core\Utils;
use Defuse\Crypto\Exception\BadFormatException;
use Defuse\Crypto\Exception\EnvironmentIsBrokenException;
use Defuse\Crypto\Exception\WrongKeyOrModifiedCiphertextException;

class HomeController extends BaseController
{
    private $homeModels;
    private $params;

    public function __construct()
    {
        parent::__construct(false);
        $this->homeModels = $this->model("home");
        if(is_object($this->_USER)) $this->params['headers'] = ["token"=>$this->_USER->token];
    }

    /**
     * @authorize
     */
    public function index__()
    {
        $this->views->initTemplate(["header" => "header_login", "footer" => "footer_login"]);
        $this->views->getTemplate('home/acceuil');

    }

    /**
     * @authorize
     */
    public function menu()
    {
        $this->views->getPage('home/menu');
    }

    /**
     * @authorize
     */
    public function login()
    {
        $param = ["condition" => ["email = " => $this->paramPOST["login"], "pwd = " => $this->paramPOST["password"]]];
        $result = $this->homeModels->getOneUtilisateur($param);
       // $result = $this->apiClient::post(MS_GATEWAY."administration/auth/token", $this->params);

        if($result>0) {

            if ($result !== false) {
                Session::set_User_Connecter([$result]);
                Utils::redirect("home", "menu");

            } else {
                //var_dump(11);exit;
                Utils::setMessageALert(["danger", "Login et Password incorrect"]);
                Utils::redirect("home", "index");

            }
        } else {
            Utils::setMessageALert(["danger", $result->error->message]);
            Utils::redirect("home", "index");
        }
    }

    /**
     * @authorize
     */
    public function firstconnect__()
    {
        $this->views->initTemplate(["header" => "header_login", "footer" => "footer_login"]);
        $this->views->getTemplate('home/updatepassword');
    }

    /**
     * @authorize
     */
    public function updatepassword()
    {
        $iduser = Session::getAttribut('id');

        //parent::validateToken('home','index');
        if ($this->paramPOST["password1"] === $this->paramPOST["password2"]) {
            $param = ["condition" => ["u.fk_marchand = " => Session::getAttribut('fk_marchand'), "u.password = " => sha1($this->paramPOST["password1"])]];
            $result = $this->homeModels->getOneUtilisateur($param);
            if ($result === false) {

                if (strlen($this->paramPOST["password1"]) >= 8) {
                    if (preg_match("#[0-9]+#", $this->paramPOST["password1"]) && preg_match("#[a-zA-Z]+#", $this->paramPOST["password1"])) {
                        $data['champs'] = ["password = " => sha1($this->paramPOST["password1"]), "is_already_connect = " => 1];
                        $data['condition'] = ["iduser = " => $iduser];
                        $result = $this->homeModels->updatePasswordFirstConnect($data);
                        if ($result == 1) {
                            Session::destroySession();
                            Utils::setMessageALert(["success", "Modification du mot de passe effectué avec succès."]);
                            Utils::redirect("menu", "menu");
                        } else {
                            Utils::setMessageALert(["danger", "Vous devez utilisé un mot de passe différent du précédent."]);
                            Utils::redirect("home", "firstconnect");
                        }
                    } else {
                        Utils::setMessageALert(["danger", "Le mot de passe doit etre composer de caracteres speciaux et chiffres et lettres."]);
                        Utils::redirect("home", "firstconnect");
                    }
                } else {
                    Utils::setMessageALert(["danger", "Le mot de passe doit avoir huits caractères alphanumériques au minimum."]);
                    Utils::redirect("home", "firstconnect");
                }
            } else {
                Utils::setMessageALert(["danger", "Vous devez utilisé un mot de passe différent du précédent."]);
                Utils::redirect("home", "firstconnect");
            }
        } else {
            Utils::setMessageALert(["danger", "Les deux mots de passe ne correspondent pas."]);
            Utils::redirect("home", "firstconnect");
        }
    }

    /**
     * @authorize
     */
    public function unlogin__()
    {
        Session::destroySession();
        Utils::redirect("home", "index");
    }

}