<?php
/**
 * Created by PhpStorm.
 * User: Seyni Faye
 * Date: 02/07/2018
 * Time: 11:49
 */

namespace app\webservice;

use app\core\ApiServer;
class salut extends ApiServer
{
    private $model;
    public function __construct()
    {
        parent::__construct(__CLASS__);
        $this->model = $this->model("home");
    }

    /**
     * Gets user list
     *
     * @url GET /index
     */
    public function getUser()
    {
        $users = $this->model->getUser();
        return $users;
    }

    /**
     *
     * @url POST /addUser
     */
    public function addUser()
    {
        return $this->model->insertUser(parent::$paramPOST);
    }

    /**
     * @url POST /updateUser
     */
    public function updateUser()
    {
        return $this->model->updateUser(parent::$paramPOST);
    }

    /**
     * Gets user list
     *
     * @url GET /deleteUser
     */
    public function deleteUser()
    {
        return $this->model->deleteUser(parent::$paramPOST);
    }
}