<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

session_start();

if(isset( $_SESSION["user"])){
    echo json_encode($_SESSION["user"] , JSON_UNESCAPED_UNICODE ) ;
}else {
    echo json_encode(
        array(
            "status"=>"login değil"
        )
    );
}