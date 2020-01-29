<?php

namespace Confirmation\detail ;

require_once __DIR__ . "/../../private/cors.php";


require __DIR__ .'/../../database/connect.php';
session_start();

require __DIR__ . "/../../private/Authority.php";

use DATABASE\Database ; 
use PDO ;
use Authority;

if(!isset($_SESSION["operator"])){
  header("location: calisan");
  exit;
}


 if($_SESSION['operator']['authority'] == Authority::disabled ){
     echo json_encode(['status'=>'Yetkisiz İşlem!']);
     exit;
 }



    $details = new Database();

    $thisDayTime = time()- 172800;
   $waiting= "SELECT count(*) from rezervasyon where m_status = '0' and time>='".$thisDayTime."'" ;
   $red = "SELECT count(*) from rezervasyon where m_status = '2' and time>='".$thisDayTime."'" ;
   $ok = "SELECT count(*) from rezervasyon where m_status = '1' and time>='".$thisDayTime."'" ;
  
   try{
    $query = $details->conn->query( $waiting ,  PDO::FETCH_ASSOC);
    
    if($query->rowCount()){
        foreach ($query as $value) {
            $waiting = $value["count(*)"] ;
        }
    }

    $query = $details->conn->query( $red ,  PDO::FETCH_ASSOC);
    
    if($query->rowCount()){
        foreach ($query as $value) {
            $red = $value["count(*)"] ;
        }
    }

    $query = $details->conn->query( $ok ,  PDO::FETCH_ASSOC);
    
    if($query->rowCount()){
        foreach ($query as $value) {
            $ok = $value["count(*)"] ;
        }
    }

    $waiting = array(
        "waiting"=>$waiting,
        "red"=>$red ,
        "ok"=>$ok
    );
    echo json_encode($waiting , JSON_UNESCAPED_UNICODE);
    exit ;
    }catch(PDOException $e){
        echo json_encode($e , JSON_UNESCAPED_UNICODE);
        exit ;
    }

