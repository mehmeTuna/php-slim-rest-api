<?php

namespace DATABASE ;

//ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));

date_default_timezone_set('Europe/Istanbul');

use PDO as PDOAlias;
use PDOException;

class Database
{
    protected $servername = "localhost:3306";
    protected $username = "root";
    protected $password = "";
    protected $dbName = "food_sale";
    public  $conn;

    /**
     * Database constructor.
     */
    function __construct()
    {

        try {
            $this->conn = new PDOAlias("mysql:host=$this->servername;dbname=$this->dbName", $this->username, $this->password);
            // set the PDO error mode to exception
            $this->conn->setAttribute( PDOAlias::ATTR_ERRMODE, PDOAlias::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch (PDOException $e) {
           echo  $e->getMessage();
           exit;

        }
                  
    }

    protected function startConnect() {
        try {
            $this->conn = new PDOAlias("mysql:host=$this->servername;dbname=$this->dbName", $this->username, $this->password);
            // set the PDO error mode to exception
            $this->conn->setAttribute( PDOAlias::ATTR_ERRMODE, PDOAlias::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch (PDOException $e) {
           echo  $e->getMessage();
           exit;

        }
    }

    protected function connect(){
        return $this->conn;
    }
    
    protected function disconnect() {
        $this->conn= null ;
        return true ;
    }


    function __destruct()
    {
        $this->conn = null;
    }

}
