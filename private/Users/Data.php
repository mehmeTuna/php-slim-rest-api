<?php

session_start();

//print_r($_SESSION);

if(isset( $_SESSION["user"])){
    echo json_encode($_SESSION["user"] , JSON_UNESCAPED_UNICODE ) ;
}else {
    echo json_encode(
        array(
            "status"=>"login değil"
        )
    );
};