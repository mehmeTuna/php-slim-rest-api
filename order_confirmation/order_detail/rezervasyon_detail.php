<?php

namespace Confirmation\Rezervasyon\detail ;

session_start();

require_once __DIR__ . "/../../private/cors.php";


require __DIR__ .'/../../database/connect.php';
require __DIR__ . "/../../private/Authority.php";


use DATABASE\Database ; 
use PDO ;
use PDOException;
use Authority;


if(!isset($_SESSION["operator"])){
  header("location: calisan");
  exit;
}


 if($_SESSION['operator']['authority'] == Authority::disabled ){
     echo json_encode(['status'=>'yetkisiz islem']);
     exit;
 }

    $details = new Database();
  
    
    if(isset($_GET['search']) && $_GET['search'] == 'ok'){
        if(isset($_GET["ord"])  ){

            $tip = strip_tags($_GET['ord']);
            $waiting= "SELECT id,time,name,e_mail,phone,kisi_sayisi,rez_date,message from rezervasyon where phone = '{$tip}' ORDER BY time ASC" ;
            $order_wait = array();
        
            try{
            $query = $details->conn->query( $waiting ,  PDO::FETCH_ASSOC);
            
            if($query->rowCount()){
                foreach ($query as $value) {
                    
                array_push($order_wait , 
                    array(
                        "id"=>$value["id"],
                        "time"=>$value["time"],
                        "name"=>$value["name"],
                        "e_mail"=>$value["e_mail"],
                        "kisi"=>$value["kisi_sayisi"],
                        "date"=>$value["rez_date"],
                        "phone"=>$value["phone"],
                        "message"=>$value["message"]
                    )
                ) ;
                }
            }
        
            echo json_encode($order_wait , JSON_UNESCAPED_UNICODE);
            exit ;
            }catch(PDOException $e){
                echo json_encode( array('status' => 'denied') , JSON_UNESCAPED_UNICODE);
                exit ;
            }
            }else {
                echo json_encode( array('status' => 'denied') , JSON_UNESCAPED_UNICODE);
            }
    }

if(isset($_GET["ord"])  ){
    if($_GET["ord"] == "gelen" )
    $tip = "0";
    else if($_GET["ord"] == "onay" )
    $tip = "1";
    else if($_GET["ord"] == "iptal" )
     $tip = "2";

    $thisDayTime = mktime(0,1,0 , ltrim(date('m') , 0 ) ,  ltrim(date('d') , 0)  , ltrim(date('Y') , 0 )  );

    $waiting= "SELECT id,time,name,e_mail,phone,kisi_sayisi,rez_date , message from rezervasyon where m_status = '{$tip}' and time>='{$thisDayTime}' ORDER BY time ASC" ;
    $order_wait = array();
   
    try{
     $query = $details->conn->query( $waiting ,  PDO::FETCH_ASSOC);
     
     if($query->rowCount()){
         foreach ($query as $value) {
            
           array_push($order_wait , 
            array(
                "id"=>$value["id"],
                "time"=>$value["time"],
                "name"=>$value["name"],
                "e_mail"=>$value["e_mail"],
                "kisi"=>$value["kisi_sayisi"],
                "date"=>$value["rez_date"],
                "phone"=>$value["phone"],
                "message"=>$value["message"]
            )
           ) ;
        }
     }
 
     echo json_encode($order_wait , JSON_UNESCAPED_UNICODE);
     exit ;
    }catch(PDOException $e){
         echo json_encode("denied" , JSON_UNESCAPED_UNICODE);
         exit ;
     }
}else {
    echo "only get method";
}