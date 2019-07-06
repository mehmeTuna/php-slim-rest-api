<?php

session_start();

if(isset( $_SESSION["admin"])){
    echo json_encode($_SESSION["admin"] , JSON_UNESCAPED_UNICODE ) ;
}else {
    echo json_encode(
        array(
            "status"=>"login değil"
        )
    );
}