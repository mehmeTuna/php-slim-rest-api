<?php

namespace Api;
session_start ();


if ( !isset( $_SESSION[ "admin" ] ) ) {
    echo json_encode ( array (
        "status" => "login değil"
    ) , JSON_UNESCAPED_UNICODE );
    exit;
}

require_once __DIR__ . '/DbAbout.php';

use Admin\Data;

$api = new Data();

$getData = json_decode ( file_get_contents ( "php://input" ) , true );


if(isset($_GET["api"])){
    switch ( $_GET[ 'api' ] ) {

        //bugune ait siparis detaylari
        case 'orderthisday' :
            echo $api->getthisDayOrder ();
            break;

        //bu aya ait siparis detayleri
        case 'thismonthorder':
            echo $api->getThisMonthOrder ();
            break;

        //gunluk kredili ve nakit satislar sayisi
        case 'thisdaypayment':
            echo $api->getThisDayPayment ();
            break;

        //aylik kredili ve nakit satislar sayisi
        case 'thismonthpayment':
            echo $api->getThisMonthPayment ();
            break;

        //gunluk iptal olan siparisler
        case 'iptalorder':
            echo $api->thisDayiptalOrder ();
            break;

        //aylik iptal olan siparisler
        case 'iptalordermonth':
            echo $api->thisMonthiptalOrder ();
            break;

        //gunluk toplam satis miktari
        case 'thisdaymany':
            echo $api->thisDaymany ();
            break;

        //aylik toplam satis miktari
        case 'thismonthmany':
            echo $api->thisMonthmany ();
            break;

        //
        case 'allProduct':
            echo $api->thisAllProduct ();
            break;

        //tum kategorileri listeleme
        case 'allCateogry' :
            echo $api->getAllCategory ();
            break;

        //yeni urun ekleme
        case 'newProduct' :
            echo $api->newProduct ( $getData );
            break;

        //tum kuryeleri listeleme
        case 'allKurye':
            echo $api->allKurye ();
            break;

        //yeni kurye ekleme
        case 'newKurye' :
            echo $api->newKurye ( $getData );
            break;

        //kurye silme
        case 'delkurye':
            echo $api->delkurye ( $_GET[ 'email' ] );
            break;

        //urun silme
        case 'delproduct':
            echo $api->delproduct ( $_GET[ 'id' ] );
            break;

        //sistemde kakyitli kullanici sayisi
        case 'alluser':
            echo $api->getAllUser ();
            break;

        case 'allrezervasyon':
            echo $api->getAllRezervasyon ();
            break;

        case 'rezervasyonthisday':
            echo $api->rezervasyonThisDay ();
            break;

        case 'rezervasyonthismonth':
            echo $api->rezervasyonThisMonth ();
            break;

        case 'rezervasyonthisyear':
            echo $api->rezervasyonThisYear ();
            break;

        case 'userthismonth' :
            echo $api->getThisMontUser ( ltrim ( date ( 'm' ) , 0 ) );
            break;

        case 'userthisyear':
            echo $api->getThisYearUser ( date ( 'Y' ) );
            break;

        case 'monthproduct':
            echo $api->getmonthorder ( $_GET[ 'date' ] );
            break;

        case 'fullorder':
            echo '';
            break;


        case "newcategory":
            echo $api->newCategory ( $getData );
            break;

        case "delcategory":
            echo $api->deleteCategory ( $_GET[ "id" ] );
            break;


        case "newcalisan":
            echo $api->newCalisan ( $getData );
            break;

        case "updatecalisan":
            echo $api->updateCalisan ( $getData );
            break;

        case "delcalisan":
            echo $api->delCalisan ( $_GET[ "id" ] );
            break;

        case "orderdetayyear":
            echo $api->bringGetOrderDetay ( "year" );
            break;

        case "orderdetaymonth":
            echo $api->bringGetOrderDetay ( "month" );
            break;

        case "orderdetayweek":
            echo $api->bringGetOrderDetay ( "week" );
            break;

        case "orderdetayday":
            echo $api->bringGetOrderDetay ( "day" );
            break;

        case "getworker":
            echo $api->getWorker ();
            break;


        default :
            echo json_encode ( [ 'status' => 'tanimlanmayan parametre' ] , JSON_UNESCAPED_UNICODE );
            break;
    };
}
