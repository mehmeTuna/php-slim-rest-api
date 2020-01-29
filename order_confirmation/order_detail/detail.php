<?php

namespace Confirmation\detail ;

require_once __DIR__ . "/../../private/cors.php";


require __DIR__ .'/../../database/connect.php';

use DATABASE\Database ; 
use PDO ;

    $details = new Database();


    $thisDayTime = time()- 172800;
   
    
   $waiting= "SELECT count(*) as toplam from order_items where m_status = '0' and m_date>='".$thisDayTime . "'" ;
   $red = "SELECT count(*) as toplam from order_items where m_status = '2' and m_date>='".$thisDayTime . "'" ;
   $ok = "SELECT count(*) as toplam from order_items where m_status = '1' and m_date>='".$thisDayTime . "'" ;
  
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

