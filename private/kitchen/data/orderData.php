<?php

session_start();

require_once __DIR__ . '/DataClass.php';

use KitchenData\Data;

$data = new Data();

if ( !isset( $_SESSION[ "mutfak" ] ) || $_SESSION[ 'mutfak' ][ 'authority' ] == '0' ) {
   echo 'yetki sahibi degilsiniz' ;
    exit;
}


//hazirlanacak siparisler
$data->Bringdata(1 , 'hazirlanacak');

//hazirlanan siparisler
$data->Bringdata(3 , 'hazirlanan');

//iptal edilen siparisler
$data->Bringdata(4 , 'iptal');

//kuryeye verilen siparisler
$data->Bringdata( 5 ,'kurye');

if($data->orderCount != array()){
    echo json_encode( $data->orderCount , JSON_UNESCAPED_UNICODE) ; 
}else {
    echo json_encode(
        array(
            'hazirlanacak'=>0,
            'hazirlan'=>0,
            'iptal'=>0,
            'kurye'=>0
        )
    );
}




?>