<?php 


namespace Api ;

require_once __DIR__ . '/DbAbout.php' ;

use Admin\Data ; 


$api = new Data();

//all user count
//echo $api->getAllUser();


//beliri=tilen tarihten gunumuze kadar olan sure kayit olan userlar
//echo $api->getThisMontUser(6);

//belirtilen tarihin ilk gununden itibaren kayit olan kullanici sayisi
//echo $api->getThisYearUser(2019);


//tum yapilan rezervasyonlar sayisni verir
//echo $api->getAllRezervasyon();

//o aydab itibaren verilen rezervasyon sayisini gosterir
//echo $api->getThisMontRezervasyon(5);

//o yildan itibaren verilen rezervasyon sayisini gosterir
//echo $api->getThisYearRezervasyon(2019);


//tum kategorileri listeler
//echo $api->getAllCategory();

/*
1 - günlük  satışlar -- admin/api/thisdayorder
2 - aylık satışlar   -- admin/api/thismonthorder
3-kredi lli ve nakit satışlar günlük -- admin/api/thisdaypayment
kredi lli ve nakit satışlar aylık --admin/api/thismonthpayment
4-kuryelerin günlük paket  teslimatlari --kurye ekleme kismi olduktan sonra
5-kueyelerin aylık paket teslimatlari  --kurye ekle kismi olduktan sonra
6 - günlük iptal olan siparis -- admin/api/iptalorder
7--aylık iptal olan siparişler --admin/api/iptalordermonth
8-en çok sipariş verilen ürunler -- bu kisim icin db guncellenecek admin panelinden sonra
9 - günlük gelir listesi  -- admin/api/thisdaymany
 aylık gelirlerin listesi --admin/api/thismonthmany
echo mktime(0, 1, 0, 6,1, 2019);
echo '<br>';
echo mktime(0,1,0 , ltrim(date('m') , 0 ) , ltrim(date('d') , 0 ) , 2019 );
*/
//echo mktime($saat, $dakika, $saniye, $ay, $gun, $yil);

//echo $api->getThisDayOrder();

if( !isset($_GET)){
    echo json_encode( ['status' => 'only get method'], JSON_UNESCAPED_UNICODE) ; 
    exit ;
} ;


switch($_GET['api']){

    //bugune ait siparis detaylari
    case 'orderthisday' :
    echo  $api->getthisDayOrder();
    break ;

    //bu aya ait siparis detayleri
    case 'thismonthorder';
    echo $api->getThisMonthOrder();
    break;

    //gunluk kredili ve nakit satislar sayisi
    case 'thisdaypayment';
    echo $api->getThisDayPayment();
    break;

    //aylik kredili ve nakit satislar sayisi
    case 'thismonthpayment';
    echo $api->getThisMonthPayment();
    break;

    //gunluk iptal olan siparisler
    case 'iptalorder';
    echo $api->thisDayiptalOrder();
    break;

    //aylik iptal olan siparisler
    case 'iptalordermonth';
    echo $api->thisMonthiptalOrder();
    break;

    //gunluk toplam satis miktari
    case 'thisdaymany';
    echo $api->thisDaymany();
    break;

    //aylik toplam satis miktari
    case 'thismonthmany';
    echo $api->thisMonthmany();
    break;
};



