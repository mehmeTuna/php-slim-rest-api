<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");


require __DIR__ .'/../../database/connect.php';
include __DIR__ .'/DB_CREATE_USER.php';
include __DIR__ .'/Users.php';

use User\Create ;


if ( isset( $_POST) ){
   
    $create = new Create();
    $create->add( $_POST );

   if(!$create->control()){
    echo json_encode("hatalı veri" , JSON_UNESCAPED_UNICODE);
    exit;
   }
     
    echo json_encode($create->run() , JSON_UNESCAPED_UNICODE);
    
}else {
    echo "only post method" ;
    exit;
} 