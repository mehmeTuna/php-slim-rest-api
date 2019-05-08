<?php

namespace Confirmation\detail ;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");


require __DIR__ .'/../../database/connect.php';

use DATABASE\Database ; 
use PDO ;

    $details = new Database();
   
    
   $waiting= "SELECT count(*) from order_items where m_status = '0'" ;
   $red = "SELECT count(*) from order_items where m_status = '2'" ;
   $ok = "SELECT count(*) from order_items where m_status = '1'" ;
  
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

