<?php

require_once __DIR__ .'/../../cors.php';

require_once  __DIR__ .'/DataClass.php';

use KitchenData\Data ;

$api = new Data();

if( !isset($_GET['api'])){
    echo json_encode( ['status' => 'only get method'], JSON_UNESCAPED_UNICODE) ;
    exit ;
} ;

if ( !isset( $_SESSION[ "mutfak" ] ) || $_SESSION[ 'mutfak' ][ 'authority' ] != '2' ) {
    echo json_encode (['status'=>'yetkisiz islem'] , JSON_UNESCAPED_UNICODE) ;
    exit;
}

switch ($_GET['api']){
    case 'iptal':
        echo $api->orderRed ($_GET['id']);
        break;

    case 'onay':
        echo $api->orderOnay ($_GET['id'] , $_GET['kuryeId']);
        break;

    default:
        echo 'gecersiz istek';
        break ;
}