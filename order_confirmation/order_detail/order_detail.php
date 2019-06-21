<?php

namespace Confirmation\detail ;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");


require __DIR__ .'/../../database/connect.php';
session_start();
date_default_timezone_set('Europe/Istanbul');

use DATABASE\Database ; 
use PDO ;

if(!isset($_SESSION["operator"])){
  header("location: calisan");
  exit;
}

    $details = new Database();
   
    $thisDayTime = mktime(0,1,0 , ltrim(date('m') , 0 ) ,  ltrim(date('d') , 0)  , ltrim(date('Y') , 0 )  );
   $waiting= "SELECT count(*) from order_items where m_status = '0' and m_date>='".$thisDayTime . "'" ;
   $red = "SELECT count(*) from order_items where m_status = '2' and m_date>='".$thisDayTime . "'" ;
   $ok = "SELECT count(*) from order_items where m_status != '0' and m_status!='2'  and m_date>='".$thisDayTime . "'" ;
  
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
    if($_SESSION['operator']['authority'] == 2 || $_SESSION['operator']['authority'] == 1)
       echo json_encode($waiting , JSON_UNESCAPED_UNICODE);
    else echo json_encode(['status'=>'yetkisiz islem']);
      exit ;
    }catch(PDOException $e){
        echo json_encode($e , JSON_UNESCAPED_UNICODE);
        exit ;
    }

