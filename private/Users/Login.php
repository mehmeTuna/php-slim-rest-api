<?php
session_start();
require __DIR__ .'/../../database/connect.php';

use DATABASE\Database ;

/*
if(!isset($_REQUEST)){
    echo "access denied";
    exit;
}
*/
if ( isset( $_POST) ){
    //usin axios js post method data convert json to php array
    $_POST = json_decode(file_get_contents('php://input') , true);
    if(!isset($_POST["username"]) && !isset($_POST["password"])){
        echo "username and password " ;
        exit;
    }
    
    $username = "";
    $password = "";

    if(strlen( trim( $_POST["username"] ) ) > 1 && filter_var( trim($_POST["username"]), FILTER_VALIDATE_EMAIL)){
        $username = strip_tags($_POST["username"]);
    }else{
        echo json_encode("hatalı veri" , JSON_UNESCAPED_UNICODE);
        exit;
    }

    if(strlen( trim( $_POST["password"] ) ) > 1 ){
        $password = $_POST["password"];
    }else{
        echo json_encode("hatalı veri" , JSON_UNESCAPED_UNICODE);
        exit;
    }
   
    $login = new Database();
   
          try{
            $query = $login->conn->query( "select id,firstname,lastname,password from users  where email='{$username}'" ,  PDO::FETCH_ASSOC);
           $name = array();
            if($query->rowCount()){
                foreach($query as $val){
                    $name["firstname"] = $val["firstname"];
                    $name["lastname"] = $val["lastname"] ;
                   if( password_verify($password , $val["password"] )){
                       $_SESSION["user"] = array(
                           "username" => $val["id"] ,
                           "product"=> array()
                       );
                    echo json_encode($name , JSON_UNESCAPED_UNICODE);
                    exit ;
                   }else{
                    echo json_encode("kullanıcı adı veya parola hatalı" , JSON_UNESCAPED_UNICODE);
                    exit;
                   }
                }
            }else {
                echo json_encode("kullanıcı bulunamadı" , JSON_UNESCAPED_UNICODE);
                exit;
            }
        }catch(PDOException $e){
            echo  "denied" ;
            exit;
        }
}else {
    echo "only post method" ;
    exit;
} 