<?php


require_once __DIR__ . "/index.php";
require_once __DIR__ . '/../../../vendor/autoload.php';

use Admin\Data;

$api = new Data();

$dataAllOrder = [];

$dataday = $api->bringGetOrderDetay ( "day" );
$dataweek = $api->bringGetOrderDetay ( "week" );
$dataMonth = $api->bringGetOrderDetay ( "month" );
$dataYear = $api->bringGetOrderDetay ( "year" );

$dataday = json_decode ($dataday , true);
$dataweek = json_decode ($dataweek , true);
$dataMonth = json_decode ($dataMonth , true);
$dataYear = json_decode ($dataYear , true);

$dataCount = ["year"=>0,"month"=>0,"week"=>0, "day"=>0];
$dataAllOrder = array_map (function ( $val ) use ( $dataday, $dataweek , $dataMonth , $dataCount){
    $resultData = array("name"=>$val["name"],"year"=>$val["count"]);


    foreach ($dataday as $key => $dayvalue){
        if($resultData["name"] == $dayvalue["name"] ){
            $resultData["day"] = $dayvalue["count"];
            break;
        }else{
            $resultData["day"] = "-";
        }
    }

    foreach ($dataweek as $key => $weekvalue){
        if($resultData["name"] == $weekvalue["name"] ){
            $resultData["week"] = $weekvalue["count"];
            break;
        }else{
            $resultData["week"] = "-";
        }
    }

    foreach ($dataMonth as $key => $monthvalue){
        if($resultData["name"] == $monthvalue["name"] ){
            $resultData["month"] = $monthvalue["count"];
            break;
        }else{
            $resultData["month"] = "-";
        }
    }
           return  $resultData ;

},$dataYear);


foreach ($dataAllOrder as $key => $value){
    if( isset( $value["year"] ) ){
        $dataCount["year"] += (int) $value["year"];
    }
    if ( isset( $value["week"] ) ){
        $dataCount["week"] += (int) $value["week"];
    }
    if( isset( $value["month"] ) ){
        $dataCount["month"] += (int) $value["month"];
    }
    if( isset( $value["day"] ) ){
        $dataCount["day"] += (int) $value["day"];
    }
}

$year = [
    "first"=>date("Y-m-d" , mktime ( 0 , 0 , 0 , 1, 1 , date ( 'Y' ) ) ),
    "last"=>date("Y-m-d ")
    ];
$month = [
    "first"=>date("Y-m-d " , mktime ( 0 , 0 , 0 , date('m') , 1 , date ( 'Y' ) )),
    "last"=>date("Y-m-d ")
];
$week = [
    "first"=>date("Y-m-d " , mktime ( 0 , 0 , 0 , date ( 'n' )  , date ( 'd' ,strtotime("-".date('N')." days") ))),
    "last"=>date("Y-m-d ")
];

$thisTime = "Tarih: ".date("Y-m-d") . "<br>Saat: ".date("G.i") ;

$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    "default_font_size"=>10,
    "format"=>"A4",
    "margin_top"=>5,
    "margin_left"=>5,
    "margin_right"=>5,
    "margin_bottom"=>15,
]);


ob_start ();
?>
<style>
.header{
    text-align: center;
    font-size: 5mm;
}
.m-date{
    margin-top: 5mm;
    margin-left:170mm;
    margin-bottom: 10mm;
}
.this-date{
    font-size:3mm ;
    margin-bottom: 1mm;
}


</style>

<div class='header'>ZEKİ USTA KEBAP Satış İstatistikleri</div>
    <div class="m-date">
        <div class="this-date"><?=$thisTime?></div>
    </div>


<!-- <div class='order-title'>Ürünler</div> -->
<div style="border:1px solid #0a0c0d; width: 198mm ;">
    <div style="width: 110mm; display: inline;text-align: center; float: left">Ürünler</div>
    <div style="width: 20mm; display: inline; float: left">Günlük</div>
    <div style="width: 20mm; display: inline; float: left">Haftalık</div>
    <div style="width: 20mm; display: inline; float: left">Aylık</div>
    <div style="width: 20mm; display: inline; float: left">Yıllık</div>
</div>
<?php foreach ( $dataAllOrder as $key => $value){ ?>
    <div style="border:1px solid #0a0c0d; width: 198mm ">
        <div style="width: 110mm; display: inline; float: left; padding-left: 5mm"><?php  echo isset($value["name"]) ? $value["name"] : "-" ; ?> </div>
        <div style="width: 14mm; display: inline; float: left; padding-left: 5mm"><?php  echo isset($value["day"]) ? $value["day"] : "-" ;?></div>
        <div style="width: 14mm; display: inline; float: left; padding-left: 5mm"><?php  echo isset($value["week"]) ? $value["week"] : "-" ;?></div>
        <div style="width: 14mm; display: inline; float: left; padding-left: 5mm"><?php  echo isset($value["month"]) ? $value["month"] : "-" ;?></div>
        <div style="width: 14mm; display: inline; float: left; padding-left: 5mm"><?php  echo isset($value["year"]) ? $value["year"] : "-" ;?></div>
    </div>
<?php } ?>

    <div style="border:1px solid #0a0c0d; width: 198mm ;">
        <div style="width: 20mm; display: inline;text-align: center; float: left; padding-left: 100mm">Toplam:</div>
        <div style="width: 19mm; display: inline; float: left"><?php echo $dataCount["day"] ; ?></div>
        <div style="width: 19mm; display: inline; float: left"><?php echo $dataCount["week"] ; ?></div>
        <div style="width: 18mm; display: inline; float: left"><?php echo $dataCount["month"] ; ?></div>
        <div style="width: 18mm; display: inline; float: left"><?php echo $dataCount["year"] ; ?>  adet</div>
    </div>

<?php

$html = ob_get_contents ();
ob_clean ();
$mpdf->setFooter('{PAGENO}');

$mpdf->WriteHTML($html);

$mpdf->Output();

?>