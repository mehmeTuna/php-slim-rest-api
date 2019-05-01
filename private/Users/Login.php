<?php
session_start();
require __DIR__ .'/../../database/connect.php';

use DATABASE\Database ;

if(!isset($_REQUEST)){
    echo "access denied";
    exit;
}

if ( isset( $_POST) ){
    $username = "";
    $password = "";

    if(strlen( trim( $_POST["username"] ) ) > 1 && filter_var( trim($_POST["username"]), FILTER_VALIDATE_EMAIL)){
        $username = strip_tags($_POST["username"]);
    }else{
        echo json_encode("hatalı veri" , JSON_UNESCAPED_UNICODE);
    }

    if(strlen( trim( $_POST["password"] ) ) > 1 ){
        $password = $_POST["password"];
    }else{
        echo json_encode("hatalı veri" , JSON_UNESCAPED_UNICODE);
    }
   
    $login = new Database();
   
          try{
            $query = $login->conn->query( "select id,password from users  where email='{$username}'" ,  PDO::FETCH_ASSOC);
           
            if($query->rowCount()){
                foreach($query as $val){
                   if( password_verify($password , $val["password"] )){
                       $_SESSION["user"] = array(
                           "username" => $val["id"] ,
                           "product"=> array()
                       );
                    echo json_encode("ok" , JSON_UNESCAPED_UNICODE);
                    exit ;
                   }
                }
            }else {
                echo json_encode("kullanıcı bulunamadı" , JSON_UNESCAPED_UNICODE);
            }
        }catch(PDOException $e){
            echo  "denied" ;
        }
}else {
    echo "only post method" ;
    exit;
} 