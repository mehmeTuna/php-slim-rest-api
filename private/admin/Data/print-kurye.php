<?php


require_once __DIR__ . "/index.php";
require_once __DIR__ . '/../../../vendor/autoload.php';

use Admin\Data;

$api = new Data();



$dataActive = $api->bringGetKuryeDetay (1);
$dataNotActive = $api->bringGetKuryeDetay (0);
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

$dayCount= 0;
$weekCount= 0;
$monthCount= 0;
$yearCount= 0 ;


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

<div class='header'>ZEKİ USTA KEBAP Kurye İstatistikleri</div>
    <div class="m-date">
        <div class="this-date"><?=$thisTime?></div>
    </div>


<!-- <div class='order-title'>Ürünler</div> -->
<div style="border:1px solid #0a0c0d; width: 198mm ;">
    <div style="width: 115mm; display: inline;text-align: center; float: left">Aktif Olan Kuryeler</div>
    <div style="width: 20mm; display: inline; float: left">Günlük</div>
    <div style="width: 20mm; display: inline; float: left">Haftalık</div>
    <div style="width: 20mm; display: inline; float: left">Aylık</div>
    <div style="width: 20mm; display: inline; float: left">Yıllık</div>
</div>
<?php foreach ( $dataActive as $value){ 
    if(isset($value['day'])) $dayCount+= $value['day'] ;
    if(isset($value['week'])) $weekCount+= $value['week'] ;
    if(isset($value['month'])) $monthCount+= $value['month'] ;
    if(isset($value['year'])) $yearCount+= $value['year'] ;

    ?>
    <div style="border:1px solid #0a0c0d; width: 198mm">
        <div style="width: 110mm; display: inline; float: left; padding-left: 5mm"><?php echo $value["name"]  ?> </div>
        <div style="width: 14mm; display: inline; float: left; padding-left: 5mm"><?php echo $value["day"]  ;?></div>
        <div style="width: 14mm; display: inline; float: left; padding-left: 5mm"><?php echo $value["week"] ;?></div>
        <div style="width: 14mm; display: inline; float: left; padding-left: 5mm"><?php echo $value["month"] ;?></div>
        <div style="width: 14mm; display: inline; float: left; padding-left: 5mm"><?php echo $value["year"] ;?></div>
    </div>
<?php } ?>

    <div style="border:1px solid #0a0c0d; width: 198mm ;">
        <div style="width: 20mm; display: inline;text-align: center; float: left; padding-left: 100mm">Toplam:</div>
        <div style="width: 19mm; display: inline; float: left"><?php echo $dayCount ; ?></div>
        <div style="width: 19mm; display: inline; float: left"><?php echo $weekCount ; ?></div>
        <div style="width: 18mm; display: inline; float: left"><?php echo $monthCount ;  ?>  </div>
         <div style="width: 18mm; display: inline; float: left"><?php echo $yearCount ;  ?>  adet</div>
    </div>


    <div style="border:1px solid #0a0c0d; width: 198mm ; margin-top:10mm;">
    <div style="width: 115mm; display: inline;text-align: center; float: left">Silinen Kuryeler</div>
    <div style="width: 20mm; display: inline; float: left">Günlük</div>
    <div style="width: 20mm; display: inline; float: left">Haftalık</div>
    <div style="width: 20mm; display: inline; float: left">Aylık</div>
    <div style="width: 20mm; display: inline; float: left">Yıllık</div>
</div>




<?php

$dayCount= 0;
$weekCount= 0;
$monthCount= 0;
$yearCount= 0 ;

foreach ( $dataNotActive as $value){ 
    if(isset($value['day'])) $dayCount+= $value['day'] ;
    if(isset($value['week'])) $weekCount+= $value['week'] ;
    if(isset($value['month'])) $monthCount+= $value['month'] ;
    if(isset($value['year'])) $yearCount+= $value['year'] ;

    ?>
    <div style="border:1px solid #0a0c0d; width: 198mm">
        <div style="width: 110mm; display: inline; float: left; padding-left: 5mm"><?php echo $value["name"]  ?> </div>
        <div style="width: 14mm; display: inline; float: left; padding-left: 5mm"><?php echo $value["day"]  ;?></div>
        <div style="width: 14mm; display: inline; float: left; padding-left: 5mm"><?php echo $value["week"] ;?></div>
        <div style="width: 14mm; display: inline; float: left; padding-left: 5mm"><?php echo $value["month"] ;?></div>
        <div style="width: 14mm; display: inline; float: left; padding-left: 5mm"><?php echo $value["year"] ;?></div>
    </div>
<?php } ?>

    <div style="border:1px solid #0a0c0d; width: 198mm ;">
        <div style="width: 20mm; display: inline;text-align: center; float: left; padding-left: 100mm">Toplam:</div>
        <div style="width: 19mm; display: inline; float: left"><?php echo $dayCount ; ?></div>
        <div style="width: 19mm; display: inline; float: left"><?php echo $weekCount ; ?></div>
        <div style="width: 18mm; display: inline; float: left"><?php echo $monthCount ;  ?>  </div>
         <div style="width: 18mm; display: inline; float: left"><?php echo $yearCount ;  ?>  adet</div>
    </div>

<?php

$html = ob_get_contents ();
ob_clean ();
$mpdf->setFooter('{PAGENO}');

$mpdf->WriteHTML($html);

$mpdf->Output();

?>