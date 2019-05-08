<?php



namespace Admin\Product ;

require __DIR__ ."/../../../database/connect.php";
require __DIR__ .'/create.php';
require __DIR__ .'/DB_CREATE_PRODUCT.php';

use Admin\Product\Create ;


if($_SERVER['REQUEST_METHOD'] != "POST"){
    echo "access denied";
    exit;
}

if ( isset( $_POST ) ){
    $control = true ;
    $create = new Create();
    $create->add( $_POST );
    echo json_encode($create->run() , JSON_UNESCAPED_UNICODE);
    
} 

