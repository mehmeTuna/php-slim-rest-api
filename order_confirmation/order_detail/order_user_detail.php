<?php

namespace Confirmation\Order\detail ;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");


require __DIR__ .'/../../database/connect.php';

use DATABASE\Database ; 
use PDO ;

    $details = new Database();
   

if(isset($_GET["order"])  ){
    if($_GET["order"] == "gelen" )
    $tip = "0";
    else if($_GET["order"] == "onay" )
    $tip = "1";
    else if($_GET["order"] == "iptal" )
     $tip = "2";


    $waiting= "SELECT order_id,user_id,order_amount,m_date,orders,order_status from order_items where m_status = '{$tip}' ORDER BY m_date ASC" ;
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