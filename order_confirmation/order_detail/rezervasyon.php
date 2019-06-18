<?php

namespace Confirmation\detail ;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");


require __DIR__ .'/../../database/connect.php';
session_start();


use DATABASE\Database ; 
use PDO ;

if(!isset($_SESSION["operator"])){
  header("location: calisan");
  exit;
}


 if($_SESSION['operator']['authority'] == 0 ){
     echo json_encode(['status'=>'yetkisiz islem']);
     exit;
 }



    $details = new Database();

$thisDayTime = mktime(0,1,0 , ltrim(date('m') , 0 ) ,  ltrim(date('d') , 0)  , ltrim(date('Y') , 0 )  );
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

