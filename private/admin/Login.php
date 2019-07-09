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

    if(isset( $_POST["email"] ) && strlen( trim( $_POST["email"] ) ) > 1 && filter_var( trim($_POST["email"]), FILTER_VALIDATE_EMAIL)){
        $username = strip_tags( trim($_POST["email"]) );
    }else{
        echo json_encode("hatalı veri kullanıcı adı" , JSON_UNESCAPED_UNICODE);
        exit;
    }

    if(isset( $_POST["password"] ) && strlen( trim( $_POST["password"] ) ) > 1 ){
        $password = strip_tags( trim($_POST["password"]) );
    }else{
        echo json_encode("hatalı veri" , JSON_UNESCAPED_UNICODE);
        exit;
    }
   
    $login = new Database();
   
          try{
            $query = $login->conn->query( "select id,password from admin  where username='{$username}'" ,  PDO::FETCH_ASSOC);
           
            if($query->rowCount()){
                foreach($query as $val){
                   if( password_verify($password , $val["password"] )){
                       $_SESSION["admin"] = array(
                           "username" => $val["id"] ,
                       );
                    header("location: ../dashboard");
                    exit ;
                   }else  echo json_encode("Parola Hatalı" , JSON_UNESCAPED_UNICODE);
                }
            }else {
                echo json_encode("kullanıcı bulunamadı" , JSON_UNESCAPED_UNICODE);
            }
        }catch(PDOException $e){
            echo  $e ;
        }
}else {
    echo "only post method" ;
    exit;
} 