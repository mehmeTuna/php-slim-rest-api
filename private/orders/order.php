<?php

require __DIR__ . "/NewOrder.php";

use NewOrder\CreateOrder ;



if(!isset($_REQUEST)){
    echo "access denied";
    exit;
}

if ( isset( $_POST ) ){
   //TODO : alınan veri json olacak kontrol edilecek belli bir düzende olup olmadığı
    $create = new CreateOrder();
    $response = $create->item( $_POST ) ;
    echo json_encode( $response , JSON_UNESCAPED_UNICODE);
    
} 
