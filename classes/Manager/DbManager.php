<?php
namespace Manager;

require_once 'includes/config.php';
class DbManager
{
    private $DBHOST = DB_HOST;
    private $DBNAME = DB_NAME;
    private $DBUSER = DB_USER;
    private $DBPWD = DB_PASSWORD;
    private $pdo;
    private static $_instance;

    private function __construct()
    {

        $pdo = new \PDO("mysql:host=$this->DBHOST;dbname=$this->DBNAME;charset=utf8", $this->DBUSER, $this->DBPWD);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $this->pdo = $pdo;
    }

    public static function getInstance()
    {

        if (is_null(self::$_instance)) {
            self::$_instance = new DbManager();
        }
        return self::$_instance;
    }

    public function getConnection(){
        return $this->pdo;
    }

}