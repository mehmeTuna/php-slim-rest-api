<?php

namespace Confirmation\Order\detail ;

session_start();

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

if($_SESSION['operator']['authority'] == Authority::disabled){
    echo json_encode(['status'=>'yetkisiz islem']);
    exit;
}



$details = new Database();



if(isset( $_GET['search']) && $_GET['search'] == 'ok'){

    if(isset($_GET["order"])  ){

        $tip= strip_tags($_GET['order']) ;

        $thisDayTime= mktime(0,0,0 , date('n') , date('j')  , date('Y'));

        $waiting= "SELECT * from order_items where order_id = '{$tip}' and m_date>='{$thisDayTime}' ORDER BY m_date ASC" ;
        $kuryeData= "select firstname ,lastname  from kurye where id=(select kurye_id from kurye_takip where order_id='{$tip}')";
        $order_wait= array();

        try{
            $kuryeName = $details->conn->query( $kuryeData ,  PDO::FETCH_ASSOC);

            if($kuryeName->rowCount()){
                foreach ($kuryeName as $val )
                    $kuryeName = $val["firstname"] . " " . $val["lastname"] ;
            }else $kuryeName = "Kuryeye Verilmedi";
        }catch (PDOException $e){
            $kuryeName = "Kuryeye Verilmedi" ;
        }

        try{
            $orderQuery = $details->conn->query( $waiting ,  PDO::FETCH_ASSOC);


            if($orderQuery->rowCount()){
                foreach ($orderQuery as $value) {

                    $waiting= "SELECT * from users where id = '".$value["user_id"] . "'" ;
                    try{
                        $UserQuery = $details->conn->query( $waiting ,  PDO::FETCH_ASSOC);

                        if($UserQuery->rowCount()){
                            foreach ($UserQuery as $user) {
                                array_push($order_wait , array(
                                    "orderType"=>$value["order_status"],
                                    "order_id"=>$value["order_id"],
                                    "username"=>$user["firstname"] . " " .$user["lastname"],
                                    "tutar"=>$value["order_amount"],
                                    "date"=>date('H:i', $value["m_date"]),
                                    "orders"=>$value["orders"],
                                    "adres"=>($value["adress"] == "adress") ? $user["adress"] : $user["adress_2"] ,
                                    "phone"=>$user["phone"],
                                    "first_order"=>$user["first_order"],
                                    "kurye"=>$kuryeName
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
    $thisDayTime = mktime(0,0,0 , date('n') , date('j')  , date('Y'));

    if($_GET["order"] == "gelen" )
        $waiting= "SELECT * from order_items where m_status = '0' and m_date>='{$thisDayTime}' ORDER BY m_date ASC" ;

    else if($_GET["order"] == "onay" ){
        $waiting= "SELECT * from order_items where m_status != '0' and m_status!='2' and m_date>='{$thisDayTime}' ORDER BY m_date ASC" ;
    }
    else if($_GET["order"] == "iptal" )
        $waiting= "SELECT * from order_items where m_status='2' and m_date>='{$thisDayTime}' ORDER BY m_date ASC" ;





    $order_wait = array();

    try{
        $query = $details->conn->query( $waiting ,  PDO::FETCH_ASSOC);

        if($query->rowCount()) {
            foreach ($query as $value) {
                $kuryeData = "select firstname ,lastname  from kurye where id=(select kurye_id from kurye_takip where order_id='{$value["order_id"]}')";
                try{

                    $kuryeName = $details->conn->query( $kuryeData ,  PDO::FETCH_ASSOC);

                    if($kuryeName->rowCount()){
                        foreach ($kuryeName as $val )
                            $kuryeName = $val["firstname"] . " " . $val["lastname"] ;
                    }else $kuryeName = "Kuryeye verilmedi";
                }catch (PDOException $e){
                    $kuryeName = "Kuryeye verilmedi" ;
                };
            }
        }
    }catch (PDOException $e) {
        $kuryeName = "Kuryeye verilmedi";
    };



    try{
        $query = $details->conn->query( $waiting ,  PDO::FETCH_ASSOC);

        if($query->rowCount()){
            foreach ($query as $value) {

                $waiting= "SELECT * from users where id = '" . $value["user_id"] . "'" ;
                try{
                    $query = $details->conn->query( $waiting ,  PDO::FETCH_ASSOC);

                    if($query->rowCount()){
                        foreach ($query as $user) {
                            array_push($order_wait , array(
                                "orderType"=>$value["order_status"],
                                "order_id"=>$value["order_id"],
                                "username"=>$user["firstname"] . " " .$user["lastname"],
                                "tutar"=>$value["order_amount"],
                                "date"=>date('H:i', $value["m_date"]),
                                "orders"=>$value["orders"],
                                "adres"=>($value["adress"] == "adress") ? $user["adress"] : $user["adress_2"] ,
                                "phone"=>$user["phone"],
                                "first_order"=>$user["first_order"],
                                "kurye"=>$kuryeName
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