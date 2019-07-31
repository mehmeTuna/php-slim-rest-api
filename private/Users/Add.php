<?php

session_start() ;

require_once __DIR__ . "/../cors.php";

require __DIR__ .'/../../database/connect.php';

include __DIR__ .'/DB_CREATE_USER.php';
include __DIR__ .'/Users.php';

use User\Create ;

$data = json_decode( file_get_contents("php://input") , true);

if ( !empty($data) ){
   
    $create = new Create();
    $create->add( $data );
   if(!$create->control()){
    echo json_encode(array("status"=>"erroneousData") , JSON_UNESCAPED_UNICODE);
    exit;
   }
     if($create->run() == false)
       echo json_encode( array("status"=>"emailfailed"), JSON_UNESCAPED_UNICODE);
     else
      echo json_encode( array("status"=>"registered"), JSON_UNESCAPED_UNICODE);
}else {
    echo "Boş veri " ;
    exit;
} 