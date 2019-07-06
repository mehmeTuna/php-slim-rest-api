<?php

session_start();

require __DIR__ .'/../../database/connect.php';

use DATABASE\Database ;

$js_echo = "bir hata oluştu";
$username = "";
$password = "";
$name = array();
$dbPassword = "" ;
$phone = "";

//using axios js post method data convert json to php array
// $_POST = json_decode(file_get_contents('php://input') , true);

if(isset($_POST["username"]) && strlen( trim( $_POST["username"] ) ) > 1 && filter_var( trim($_POST["username"]), FILTER_VALIDATE_EMAIL))
    $username = strip_tags( trim( $_POST["username"] ) ) ;

if(isset($_POST["password"]) && strlen( trim( $_POST["password"] ) ) > 1 )
    $password = strip_tags( trim( $_POST["password"] ) ) ;


if($username == "" ||  $password == ""){
    echo json_encode(
        array(
            "status"=>"false"
        )
        , JSON_UNESCAPED_UNICODE);
    exit ;
}

$login = new Database();

try{
    $query = $login->conn->query( "select id,firstname,lastname,password,adress,phone from users  where email='{$username}'" ,  PDO::FETCH_ASSOC);

    if($query->rowCount()){
        foreach($query as $val){
            $name["id"] = $val["id"];
            $name["firstname"] = $val["firstname"];
            $name["lastname"] = $val["lastname"] ;
            $name["adress"] = $val["adress"] ;
            $db_password = $val["password"];
            $phone = $val["phone"];

        }
    }else {
        $js_echo = array(
            "status"=>"false"
        );
    }
}catch(PDOException $e){
    $js_echo =   array(
        "status"=>"false"
    );
}


if( password_verify($password , isset($db_password) ? $db_password : "" )){
    $_SESSION["user"] = array(
        "username" => $name["id"] ,
        "firstname"=>$name["firstname"],
        "lastname"=>$name["lastname"],
        "email"=>$username ,
        "adress"=>$name["adress"],
        "phone"=>$phone,
        "product"=> array(),
        "cardTotal"=>0,
        "orderCount"=>0
    );

    echo json_encode(array("firstname"=>$_SESSION["user"]["firstname"] , "lastname"=>$_SESSION["user"]["lastname"]) , JSON_UNESCAPED_UNICODE);
    exit;
}else{
    $js_echo = array(
        "status"=>"false"
    );
}


echo json_encode($js_echo , JSON_UNESCAPED_UNICODE);
exit ;