<?php

require_once __DIR__ . "/../cors.php";

require __DIR__ .'/../../database/connect.php';
include __DIR__ .'/DB_CREATE_REZERVASYON.php';
include __DIR__ .'/rezervasyon.php';


use Rezervasyon\Create ;


    $create = new Create();

    $data = json_decode( file_get_contents("php://input") , true );

    $create->add( $data );

   if(!$create->control()){
    echo json_encode("hatalı veri" , JSON_UNESCAPED_UNICODE);
    exit;
   }

    echo json_encode($create->run() , JSON_UNESCAPED_UNICODE);
    