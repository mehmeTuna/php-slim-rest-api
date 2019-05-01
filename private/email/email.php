<?php


namespace Email ;

error_reporting(0);

require __DIR__ . "/../../database/connect.php";
require __DIR__ ."/../time/timestamp.php";

use DATABASE\Database ;
use formattimestamp\Ttime;


if(!isset($_REQUEST)){
    echo "access denied";
    exit;
}

if ( isset( $_POST["email"] ) ){
   
   $db = new Database();


   if(strlen( trim( $_POST["email"] ) ) > 1 && strlen( trim( $_POST["email"] ) ) < 50 && filter_var( $_POST["email"] , FILTER_VALIDATE_EMAIL)){
    $re_email =  strip_tags( trim($_POST["email"]) );
    $id = rand(100000 , 9999999);
    $add = 'insert into email (id , name,date) values (:id,:email,:date)';
    $value = array("id"=>$id , "email" => $re_email , "date"=>Ttime::gettime());
                                                           
    try{
      $statetment = $db->conn->prepare($add);
      $statetment->execute($value);
      echo "ok" ;
    }catch(PDOException $e){
      print("bu mail kullanımda");
    }


  }else{
    echo "data err" ;
  }
} 



