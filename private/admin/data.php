<?php

session_start();

//require_once  __DIR__ . "/../cors.php";


if(isset( $_SESSION["admin"])){
    echo json_encode(array(
        "status"=>"true",
        "username"=>$_SESSION["admin"]
    ) , JSON_UNESCAPED_UNICODE ) ;
}else {
    echo json_encode(
        array(
            "status"=>"false",
            "stausText"=>"login değil"
        ) ,JSON_UNESCAPED_UNICODE );
}