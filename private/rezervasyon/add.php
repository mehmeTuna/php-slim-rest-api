<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");


require __DIR__ .'/../../database/connect.php';
include __DIR__ .'/DB_CREATE_REZERVASYON.php';
include __DIR__ .'/rezervasyon.php';


use Rezervasyon\Create ;

if ( isset( $_POST) ){
   
    $create = new Create();

    $_POST = json_decode( file_get_contents("php://input") , true );
    
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