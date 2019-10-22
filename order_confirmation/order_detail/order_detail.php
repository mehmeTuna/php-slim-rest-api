<?php

namespace Confirmation\detail ;

session_start();

require_once __DIR__ . "/../../private/cors.php";


require __DIR__ .'/../../database/connect.php';
require __DIR__ . "/../../private/Authority.php";



use DATABASE\Database ; 
use PDO ;
use Authority;

if(!isset($_SESSION["operator"])){
  header("location: calisan");
  exit;
}

    $details = new Database();
   
    $thisDayTime = mktime(0,0,0 , date('n') , date('j')  , date('Y'));
   $waiting= "SELECT count(*) as toplam from order_items where m_status = '0' and m_date>='".$thisDayTime . "'" ;
   $red = "SELECT count(*) as toplam from order_items where m_status = '2' and m_date>='".$thisDayTime . "'" ;
   $ok = "SELECT count(*) as toplam from order_items where m_status != '0' and m_status!='2'  and m_date>='".$thisDayTime . "'" ;
  
   try{
    $query = $details->conn->query( $waiting ,  PDO::FETCH_ASSOC);
    
    if($query->rowCount()){
        foreach ($query as $value) {
            $waiting = $value["toplam"] ;
        }
    }

    $query = $details->conn->query( $red ,  PDO::FETCH_ASSOC);
    
    if($query->rowCount()){
        foreach ($query as $value) {
            $red = $value["toplam"] ;
        }
    }

    $query = $details->conn->query( $ok ,  PDO::FETCH_ASSOC);
    
    if($query->rowCount()){
        foreach ($query as $value) {
            $ok = $value["toplam"] ;
        }
    }


    $result = array(
        "waiting"=>$waiting,
        "red"=>$red ,
        "ok"=>$ok
    );

    if($_SESSION['operator']['authority'] == Authority::write || $_SESSION['operator']['authority'] == Authority::read)
       echo json_encode($result , JSON_UNESCAPED_UNICODE);
    else echo json_encode(['status'=>'Yetkisiz İşlem!']);
      exit ;
      
    }catch(PDOException $e){
        echo json_encode($e , JSON_UNESCAPED_UNICODE);
        exit ;
    }

