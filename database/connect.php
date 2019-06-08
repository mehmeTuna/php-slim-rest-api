<?php

namespace DATABASE ;

use PDO;

class Database
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "food_sale";
    public  $conn;
    public $online = 1 ; 
    public $url = '';

    function __construct()
    {

        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->query("SET CHARACTER SET utf8");
        } catch (PDOException $e) {
            return '' ;
        }

        try{
          $query =  $this->conn->query('select site_online,site_url from site where id=1' ,  PDO::FETCH_ASSOC); 

            if($query->rowCount()){
                foreach ($query as $val) {
                   $this->online = isset($val['site_online']) ? $val['site_online'] : '' ; 
                   $this->url = isset($val['url']) ? $val['url'] : '' ; 
                }
            }
        }catch(\PDOException $e){
            echo 'err';
        }
                  
    }


    function __destruct()
    {
        $this->conn = null;
    }

}
