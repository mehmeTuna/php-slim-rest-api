<?php

require __DIR__ . "/NewOrder.php";

use NewOrder\CreateOrder ;

$data = json_encode(file_get_contents("php://input") , true) ;
$data = $data == null ? "" : $data ;


   //TODO : alınan veri json olacak kontrol edilecek belli bir düzende olup olmadığı
    $create = new CreateOrder();

    $response = $create->item( $data["content"] ) ;
    echo json_encode( $response , JSON_UNESCAPED_UNICODE);
    

