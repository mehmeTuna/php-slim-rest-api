<?php

namespace Order\Add\Db ;

if(!isset($_SESSION))
  session_start();

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
    private $firstOrder = 0 ;
    private $dbErr = true ; //true = no err or false = err
    private $db  ;

    public function __construct()
    { 
        $this->db = new Database();
        $this->db = $this->db->conn ;  
        $this->data = array(
          "ip"=>ip::getIp(),
          "m_date"=>Ttime::gettime(),
          "order_id"=>rand(10000,99999),
          "m_status"=>"0",
          "order_status"=>"0"
        );   
        $this->data["user_id"] = "2343435";
    }
 

    public function IsLogin(){ 

        if(isset($_SESSION["user"])){
            $this->islogin = true ;
            $this->data["user_id"] =$_SESSION["user"]["username"];
        }

        return  $this->islogin  ;

    }

    //data and value =orders,order_status
    public function Add($data , $value){
    
        $this->data[$data] = $value ;
      return $this ;
    }

    public function run(){
        if(!$this->islogin)
         return false ;
        
        try{
            $query = $this->db->query( "select first_order from users  where id='".$_SESSION['user']["username"]."'" ,  PDO::FETCH_ASSOC);
           
            if($query->rowCount()){
                foreach($query as $val){

                    if($val["first_order"] == 0 ){
                         $this->firstOrder = 0 ;
                    }else{
                        $this->firstOrder = 1 ;
                    }
                }
            }else {
                echo json_encode("kullanıcı bulunamadı" , JSON_UNESCAPED_UNICODE);
            }
        }catch(PDOException $e){
             $this->dbErr =  false ; 
        }
       



       
        $orders = 'insert into order_items (order_id,user_id,m_date,orders,m_status,order_status,ip) values (:order_id,:user_id,:m_date,:orders,:m_status,:order_status,:ip)';

        try{
          $statement = $this->db->prepare($orders);
          $statement->execute($this->data);
        }catch(PDOException $e){
            $this->dbErr = false;
        }



        if(!$this->firstOrder){
         
            $add = "UPDATE users SET first_order = 1 WHERE id='" . $_SESSION["user"]["username"] ."'";

            try{
                $statement = $this->db->prepare($add);
                $statement->execute();
            }catch(PDOException $e){
                $this->dbErr = false;
            }
        }

        return true ;
    }


    public function __destruct(){
        
    }

}