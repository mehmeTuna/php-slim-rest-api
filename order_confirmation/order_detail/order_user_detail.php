<?php

namespace Confirmation\Order\detail ;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");


require __DIR__ .'/../../database/connect.php';
session_start();

use DATABASE\Database ; 
use PDO ;
use PDOException;


if(!isset($_SESSION["operator"])){
  header("location: calisan");
  exit;
}

 if($_SESSION['operator']['authority'] == 0){
     echo json_encode(['status'=>'yetkisiz islem']);
     exit;
 }



    $details = new Database();

    if(isset( $_GET['search']) && $_GET['search'] == 'ok'){
        
            if(isset($_GET["order"])  ){
            
            $tip = strip_tags($_GET['order']) ;

                $thisDayTime = mktime(0,1,0 , ltrim(date('m') , 0 ) ,  ltrim(date('d') , 0)  , ltrim(date('Y') , 0 )  );

                $waiting= "SELECT order_id,user_id,order_amount,m_date,orders,order_status from order_items where order_id = '{$tip}' and m_date>='{$thisDayTime}' ORDER BY m_date ASC" ;
                $order_wait = array();
            
                try{
                $query = $details->conn->query( $waiting ,  PDO::FETCH_ASSOC);
                
                if($query->rowCount()){
                    foreach ($query as $value) {
                        
                        $waiting= "SELECT email,firstname,lastname,phone,adress from users where id = '{$value["user_id"]}'" ;
                        try{
                        $query = $details->conn->query( $waiting ,  PDO::FETCH_ASSOC);
                        
                        if($query->rowCount()){
                            foreach ($query as $user) {
                                array_push($order_wait , array(
                                    "order_id"=>$value["order_id"],
                                    "username"=>$user["firstname"] . " " .$user["lastname"],
                                    "tutar"=>$value["order_amount"],
                                    "date"=>date('H:i', $value["m_date"]),
                                    "orders"=>$value["orders"],
                                    "adres"=>$user["adress"],
                                    "phone"=>$user["phone"]
                                ));
                            }
                        }

                    }catch(PDOException $e){
                        echo json_encode("denied" , JSON_UNESCAPED_UNICODE);
                        exit ;
                    }
                }
            
                echo json_encode($order_wait , JSON_UNESCAPED_UNICODE);
                exit ;
                }
                }catch(PDOException $e){
                    echo json_encode("denied" , JSON_UNESCAPED_UNICODE);
                    exit ;
                }
            }else {
                echo "only get method";
            }
            exit ; 
        
    }





if(isset($_GET["order"])  ){
    $thisDayTime = mktime(0,1,0 , ltrim(date('m') , 0 ) ,  ltrim(date('d') , 0)  , ltrim(date('Y') , 0 )  );

    if($_GET["order"] == "gelen" )
        $waiting= "SELECT order_id,user_id,order_amount,m_date,orders,order_status from order_items where m_status = '0' and m_date>='{$thisDayTime}' ORDER BY m_date ASC" ;

    else if($_GET["order"] == "onay" ){
        $waiting= "SELECT order_id,user_id,order_amount,m_date,orders,order_status from order_items where m_status != '0' and m_status!='2' and m_date>='{$thisDayTime}' ORDER BY m_date ASC" ;
    }
    else if($_GET["order"] == "iptal" )
        $waiting= "SELECT order_id,user_id,order_amount,m_date,orders,order_status from order_items where m_status='2' and m_date>='{$thisDayTime}' ORDER BY m_date ASC" ;



    $order_wait = array();
   
    try{
     $query = $details->conn->query( $waiting ,  PDO::FETCH_ASSOC);
     
     if($query->rowCount()){
         foreach ($query as $value) {
            
            $waiting= "SELECT email,firstname,lastname,phone,adress from users where id = '{$value["user_id"]}'" ;
            try{
             $query = $details->conn->query( $waiting ,  PDO::FETCH_ASSOC);
             
             if($query->rowCount()){
                 foreach ($query as $user) {
                    array_push($order_wait , array(
                        "order_id"=>$value["order_id"],
                        "username"=>$user["firstname"] . " " .$user["lastname"],
                        "tutar"=>$value["order_amount"],
                        "date"=>date('H:i', $value["m_date"]),
                        "orders"=>$value["orders"],
                        "adres"=>$user["adress"],
                        "phone"=>$user["phone"]
                    ));
                 }
             }

         }catch(PDOException $e){
            echo json_encode("denied" , JSON_UNESCAPED_UNICODE);
            exit ;
        }
     }
 
     echo json_encode($order_wait , JSON_UNESCAPED_UNICODE);
     exit ;
    }
     }catch(PDOException $e){
         echo json_encode("denied" , JSON_UNESCAPED_UNICODE);
         exit ;
     }
}else {
    echo "only get method";
}