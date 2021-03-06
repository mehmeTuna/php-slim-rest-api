<?php

namespace Order\Add\Db ;



require __DIR__."/../../database/connect.php";
require __DIR__."/../time/timestamp.php";
require __DIR__."/../Ip/Ip.php";

use DATABASE\Database ;
use PDO;
use Ip\ip ;
use formattimestamp\Ttime ;

class Add {
    public $islogin = false ;
    private $data = array();//order_id,user_id,m_date,orders,m_status,order_status,ip
    private $dbErr = true ; //true = no err or false = err
    private $db  ;

    public function __construct()
    { 
        $this->db = new Database();
        $this->db = $this->db->conn ;  
        $this->data = [
          "ip"=>(new ip())->getIp(),
          "m_date"=>(new Ttime())->gettime(),
          "order_id"=>rand(10000,99999),
          "m_status"=>"0",
        ];
    }
    

    //data and value =orders,order_status
    public function Add($data , $value){
        $this->data[$data] = $value ;
      return $this ;
    }

    public function run(){
        $orders = 'insert into order_items (order_id,user_id,m_date,orders,m_status,order_status,ip,order_amount,icerik,adress) values (:order_id,:user_id,:m_date,:orders,:m_status,:order_status,:ip,:order_amount,:icerik,:adress)';

        try{
          $statement = $this->db->prepare($orders);
          $statement->execute($this->data);

          $_SESSION["user"]["product"] = array();
          $_SESSION["user"]["cardTotal"] = 0;
          $_SESSION["user"]["orderCount"] = 0;

          return $this->data['order_id'];

        }catch(PDOException $e){
            $this->dbErr = false;
            return false ;
        }
    }


    public function __destruct(){
        
    }

}