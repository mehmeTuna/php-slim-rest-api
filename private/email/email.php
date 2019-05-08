<?php

namespace Email ;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

//error_reporting(0);

require __DIR__ . "/../../database/connect.php";
require __DIR__ ."/../time/timestamp.php";
require __DIR__ ."/../Ip/Ip.php";

use DATABASE\Database ;
use formattimestamp\Ttime;
use Ip\ip ;

$_POST = json_decode( file_get_contents("php://input") , true );

if ( isset( $_POST["email"] ) ){

  
   
   $db = new Database();


   if(strlen( trim( $_POST["email"] ) ) > 1 && strlen( trim( $_POST["email"] ) ) < 50 && filter_var( $_POST["email"] , FILTER_VALIDATE_EMAIL)){
    $re_email =  strip_tags( trim($_POST["email"]) );
    $id = rand(100000 , 9999999);
    $add = 'insert into email_register (id ,email,ip ,m_date) values (:id,:email,:ip,:date)';
    $value = array("id"=>$id , "email" => $re_email , "date"=>Ttime::gettime() , "ip"=>ip::getIp());
                                                           
    try{
      $statetment = $db->conn->prepare($add);
      $statetment->execute($value);
      echo "ok" ;
    }catch(PDOException $e){
      echo "bu mail kullanımda";
    }


  }else{
    echo "data err" ;
  }
} 



