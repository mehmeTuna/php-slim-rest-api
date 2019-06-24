<?php

namespace DATABASE ;

date_default_timezone_set('Europe/Istanbul');

use PDO as PDOAlias;
use PDOException;

class Database
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbName = "food_sale";
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
            $this->conn->query("SET CHARACTER SET utf8");
        } catch (PDOException $e) {
           return "";
        }
                  
    }


    function __destruct()
    {
        $this->conn = null;
    }

}
