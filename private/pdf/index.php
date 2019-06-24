<?php
/*
 * Mehmet Tuna pdf draft
 */
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . "/../../database/connect.php";

$orderId= isset($_GET["id"]) ? strip_tags ( trim ( $_GET["id"] ) ) : false ;
if($orderId == false){
    echo json_encode (["status"=>"geçerli değer giriniz"] , JSON_UNESCAPED_UNICODE);
    exit ;
}

use DATABASE\Database;

$db = new Database();
$db = $db->conn ;

$userId = "";
$IsOrderStatus = "";
$OrderDetay = [];


$IsHaveId = "select m_status from order_items where order_id='".$orderId."'";
$IsOrderQuery = "select user_id , order_amount,m_date,orders from order_items where order_id='".$orderId."'";

try{
    $result = $db->query ($IsHaveId);
    if($result->rowCount ()){
        foreach ($result as $val){
            $IsOrderStatus = $val["m_status"];
        }
    }else {
        echo json_encode ( ["status"=>"olmayan sipariş"], JSON_UNESCAPED_UNICODE);
        exit ;
    }

    $result = $db->query ($IsOrderQuery);
    if($result->rowCount ()){
        foreach ($result as $val){
            if( isset($val["user_id"]) )
              $userId = $val["user_id"];

            $OrderDetay["order_amount"] = $val["order_amount"];
            $OrderDetay["m_date"] = $val["m_date"];
            if(isset($val["orders"])){
                $orders = json_decode ($val["orders"] , true );
                if($orders == false ){
                    echo json_encode ( ["status"=>"sipariş hatası"], JSON_UNESCAPED_UNICODE);
                    exit;
                }
                $OrderDetay["orders"] = $orders ;
            }
        }
    }else {
        echo json_encode ( ["status"=>"olmayan sipariş"], JSON_UNESCAPED_UNICODE);
        exit ;
    }

    $result = $db->query ("select firstname , lastname,adress,phone from users where id='".$userId."'");

    if($result->rowCount ()){
        foreach ($result as $val){
            $OrderDetay["username"] = $val["firstname"] . " " . $val["lastname"];
            $OrderDetay["adress"] = $val["adress"];
            $OrderDetay["phone"] = $val["phone"];
        }
    }else {
        echo json_encode ( ["status"=>"olmayan kullanıcı"], JSON_UNESCAPED_UNICODE);
        exit ;
    }


}catch (\Exception $e){
    echo json_encode (["status"=>"parametre geçerli değil"] , JSON_UNESCAPED_UNICODE);
}

//print_r ($OrderDetay);
//exit;

$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => [150, 50],
    "default_font_size"=>10,
    "margin_top"=>13,
    "margin_left"=>3,
    "margin_right"=>3,
    "margin_bottom"=>3,
    'orientation' => 'L'
]);

$orderTable = "";
$orderDataYear = date( "d:m:Y" , $OrderDetay["m_date"]);
$orderDataday = date( "H:i" , $OrderDetay["m_date"]);
foreach ($OrderDetay["orders"] as $val){
   $orderTable .="<tr><td>{$val['name']}</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>{$val['count']}</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>{$val['price']}</td>
    </tr>";
}
ob_start ();

echo "<style>
.header{
margin-left: 10mm;
font-size:5mm;
}
.header-alt{
margin-left: 14mm;
font-size:5mm;
}
.siparis-title{
font-size: 3mm;
margin-top: 1mm;
margin-left: 8mm;
}
.siparis-line{
font-size: 1mm;
width: 45mm;
}
.user-title{
margin-top: 3mm;
font-size: 2mm;
}
.date-line{
margin-top: 1mm;
border: 1px solid #0e0e0e;
font-size: 2mm;
padding: 1mm;
}
.urun-title{
font-size: 2mm;
margin: 0mm;
padding: 0mm;
}
.urun-title-content{
font-size: 3mm;
margin: 0mm;
padding: 0mm;
}
.m-hr{
margin: 0mm;
}
.adisyon{
font-size: 2mm;
margin: 0mm;
padding: 0mm;
}
</style>

<div class='header'>ZEKİ USTA</div>
<div class='header-alt'>KEBAP</div>
<div class='siparis-title'>PAKET SİPARİŞİDİR</div>
<div class='user-title'>Sipariş No:{$orderId} {$OrderDetay['username']}</div>
<div class='date-line'>Tarih:{$orderDataYear}  Saat:{$orderDataday}  Masa No:Paket</div>
<table class='urun-title'>
  <tr>
    <th>Ürünler</th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th>Adet</th> 
    <th>Tutar</th>
  </tr>
  </table>
 <hr class='m-hr'>
  <table class='urun-title-content'>
    {$orderTable}
  </table>
<hr class='m-hr'>
   <table class='adisyon'>
     <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Adisyon Toplam:</td>
        
        <td>{$OrderDetay['order_amount']}</td>
        
     </tr>
   </table>
   
   <div style='font-size: 3mm;margin-top: 5mm;margin-bottom: 1mm;margin-left: 2mm'> <u>Ödenecek Toplam Tutar : {$OrderDetay['order_amount']} </u></div>
   <div style='margin-left:12mm;font-size: 2mm'><i>Teşekkür Ederiz</i></div>
   
   <div style='left: 3mm ; margin-top: 10mm;font-size: 3mm'> {$OrderDetay['adress']}</div>
   <div style='font-size: 3mm;left: 3mm;margin-top: 1mm'>Arayan No: {$OrderDetay['phone']}</div>
";



$html = ob_get_contents ();
ob_clean ();

$mpdf->WriteHTML($html);

$mpdf->Output();
