<?php
/**
 * Created by PhpStorm.
 * User: Seyni FAYE
 * Date: 17/08/2017
 * Time: 11:01
 */

namespace app\core;
use \Jacwright\RestServer\RestException;

class Database
{
    private $connexion = null;
    private static $appConfig = null;
    private static $dbConfig = null;
    private static $instance = null;
    private static $param = [];
    private static $cache = [];

    /**
     * Database constructor.
     * @param int $db_active
     * @param bool $with_db
     */
    public function __construct($db_active = 1, $with_db = true)
    {
        self::$appConfig = (object)\parse_ini_file(ROOT . 'config/app.config.ini');
        self::$dbConfig = array_map(function ($item){ return trim($item);}, \parse_ini_file(ROOT . 'config/db.config.ini'));
        $db_active = intval($db_active) == 1 ? '' : $db_active;

        if($with_db) {
            $dsn = (self::$dbConfig['DB'.$db_active.'_TYPE'] == 'sqlite')
                ? 'sqlite:'.ROOT . 'config/'.self::$dbConfig['DB'.$db_active.'_NAME'].'.db'
                : self::$dbConfig['DB'.$db_active.'_TYPE'] . ':dbname=' . self::$dbConfig['DB'.$db_active.'_NAME'] . ';host=' . self::$dbConfig['DB'.$db_active.'_HOST'];
        }elseif(self::$dbConfig['DB'.$db_active.'_TYPE'] == 'mysql') $dsn = self::$dbConfig['DB'.$db_active.'_TYPE'] . ':host=' . self::$dbConfig['DB'.$db_active.'_HOST'];

        try {
            if ($this->connexion === null && isset($dsn)) {
                $this->connexion = (self::$dbConfig['DB'.$db_active.'_TYPE'] == 'sqlite')
                    ? new \PDO($dsn)
                    : new \PDO($dsn, self::$dbConfig['DB'.$db_active.'_USER'], self::$dbConfig['DB'.$db_active.'_PASSWORD'], [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
                $this->connexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $key = $dsn;
                self::$param = [$dsn];
                if(isset(self::$dbConfig['DB'.$db_active.'_USER'])) {
                    array_push(self::$param, self::$dbConfig['DB'.$db_active.'_USER']);
                    $key .= self::$dbConfig['DB'.$db_active.'_USER'];
                }
                $key = "key:" . sha1($key);
                self::$cache[$key] = $this->connexion;
            }else throw new \PDOException('DNS not define !', 500);
        } catch (\PDOException $ex) {
            if(apiCall === true) throw $ex;
            else {
                Utils::setMessageError(['500',$ex->getMessage()]);
                Utils::redirect("error","error", [], "default");
                throw $ex;
            }
        }
    }

    /**
     * @param int $db_active
     * @param bool $with_db
     * @return null|\PDO
     * @throws RestException
     */
    public static function getConnexion($db_active = 1, $with_db = true)
    {
        self::$dbConfig = array_map(function ($item){ return trim($item);}, \parse_ini_file(ROOT . 'config/db.config.ini'));
        $db_active = intval($db_active) == 1 ? '' : $db_active;

        try{
            if(count(self::$param) === 0) self::$instance = new Database($db_active, $with_db);
            else {
                $dsn = ($with_db)
                    ? self::$dbConfig['DB'.$db_active.'_TYPE'] . ':dbname=' . self::$dbConfig['DB'.$db_active.'_NAME'] . ';host=' . self::$dbConfig['DB'.$db_active.'_HOST']
                    : self::$dbConfig['DB'.$db_active.'_TYPE'] . ':host=' . self::$dbConfig['DB'.$db_active.'_HOST'];
                $key = $dsn;
                if($dsn !== self::$param[0]){
                    if(isset(self::$dbConfig['DB'.$db_active.'_USER']))
                        $key .= self::$dbConfig['DB'.$db_active.'_USER'];
                    $key = "key:" . sha1($key);
                    self::$instance = (in_array($key, self::$cache)) ? self::$cache[$key] : new Database($db_active, $with_db);
                }
                elseif((isset(self::$param[1]) && isset(self::$dbConfig['DB'.$db_active.'_USER'])) && (self::$param[1] !== self::$dbConfig['DB'.$db_active.'_USER'])){
                    $key .= self::$dbConfig['DB'.$db_active.'_USER'];
                    $key = "key:" . sha1($key);
                    self::$instance = (in_array($key, self::$cache)) ? self::$cache[$key] : new Database($db_active, $with_db);
                }
            }
        }catch(\PDOException $ex) {
            throw $ex;
        }
        return self::$instance->connexion;
    }

    /**
     * @param $db_name
     * @param int $db_active
     * @return bool
     * @throws RestException
     */
    public static function create($db_name, $db_active = 1)
    {
        try {
            $connexion = self::getConnexion($db_active, false);
            return $connexion->prepare("CREATE DATABASE IF NOT EXISTS `".$db_name."` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci")->execute();
        }catch(\PDOException $ex) {
            throw $ex;
        }
    }

    /**
     * @param int $db_active
     * @param string $db_prefix
     * @return bool|int
     * @throws RestException
     */
    public static function generateTable($db_prefix = '', $db_active = 1)
    {
        $connexion = self::getConnexion($db_active);
        $result = false;
        $db_active = intval($db_active) == 1 ? '' : $db_active;
        if(file_exists(ROOT.'config/DB.'.self::getDbConfig()['DB'.$db_active.'_TYPE'].'.sql')) {
            $sql = file_get_contents(ROOT.'config/DB.'.self::getDbConfig()['DB'.$db_active.'_TYPE'].'.sql');
            if(strlen($db_prefix) > 0) {
                if(!Utils::endsWith($db_prefix, '_')) $db_prefix .= "_";
                $data = (strtolower(self::getDbConfig()['DB'.$db_active.'_TYPE']) === 'mysql') ? explode("Structure de la table ", $sql) : explode("TABLE IF NOT EXISTS ", $sql);
                $table = [];
                foreach ($data as $item) {
                    if($item[0] == "`") {
                        $temp = '';
                        for($i = 1 ; $i < strlen($item) ; $i++){
                            if($item[$i] != "`") $temp .= $item[$i];
                            else break;

                        }
                        array_push($table, $temp);
                    }
                }
                foreach ($table as $item) $sql = str_replace("`$item`", "`$db_prefix$item`", $sql);
            }
            try{
                $result = $connexion->exec($sql);
                rename(ROOT.'config/DB.'.self::getDbConfig()['DB'.$db_active.'_TYPE'].'.sql', ROOT.'config/DB.used.'.self::getDbConfig()['DB'.$db_active.'_TYPE'].'.sql');
            }catch(\PDOException $ex){
                throw $ex;
            }
        }
        return $result;
    }

    /**
     * @return null|object
     */
    public static function getAppConfig()
    {
        return self::$appConfig;
    }

    /**
     * @return array|bool|null
     */
    public static function getDbConfig()
    {
        return self::$dbConfig;
    }
}