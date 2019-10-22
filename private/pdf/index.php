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
$orderAdress = "";


$IsHaveId = "select m_status from order_items where order_id='".$orderId."'";
$IsOrderQuery = "select * from order_items where order_id='".$orderId."'";

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
            $orderAdress = $val["adress"];
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

    $result = $db->query ("select * from users where id='".$userId."'");

    if($result->rowCount ()){
        foreach ($result as $val){
            $OrderDetay["username"] = $val["firstname"] . " " . $val["lastname"];
            $OrderDetay["adress"] =isset($val[$orderAdress]) ? json_decode($val[$orderAdress], true) : json_decode($val["adress"], true) ;
            $OrderDetay["adress"]= $OrderDetay["adress"]["content"] ;
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
    'format' => [1200, 75],
    "default_font_size"=>10,
    "margin_top"=>1,
    "margin_left"=>1,
    "margin_right"=>4,
    "margin_bottom"=>3,
    'orientation' => 'L'
]);

$orderTable = "";
$orderDataYear = date( "d:m:Y" , $OrderDetay["m_date"]);
$orderDataday = date( "H:i" , $OrderDetay["m_date"]);
foreach ($OrderDetay["orders"] as $value){
    $productId= $value["id"];//ürün idsi
    $orderCount = $value["count"];//ürün adeti
    $orderName = $value["name"];//ürün adı
    $orderPrice= $value["price"];

    $orderFeatures= isset($value["features"]) ? $value["features"] : "";//[count=> , items[0=> , 1=> ]]//ürün detayları
    $getDataysql = 'select * from feature where id=(select features from products where id="'.$productId.'")';
                   
    try{
        $query = $db->prepare( $getDataysql);
        $query->execute();
        $resultFeaturesDetay= $query->fetchAll();
        $itemFeatures= json_decode ($resultFeaturesDetay[0]["content"], true);
        if($itemFeatures == false){
            $orderTable .="<tr><td class='table-order-name'>{$orderName}</td>";
            $orderTable.= "<td style='padding-right:1mm'>{$value["count"]}</td>
            <td>{$value['price']}tl</td>
            </tr>";
            continue;
        };
    }catch (PDOException $e){   }



    foreach($orderFeatures as $resultvalue){
        $resultOrderName.= $orderName;
        $itemsCounter= false;
        $itemOption= "";
        foreach($resultvalue["items"] as $items){
            foreach($itemFeatures as $itemResult){
                if($itemResult["id"] == $items){
                    $itemsCounter= true;
                    $itemOption.= $itemResult["content"]." ,";
                }
            }
        }
        if($itemsCounter==true){
            $itemOption[Strlen($itemOption)-1]= " ";
           $resultOrderName.=" ( ".$itemOption."  ) ";
        }
        $value['price']= ($itemsCounter) ? round($value['price']/$resultvalue["count"], 2) : $orderPrice ;
        $orderTable .="<tr><td class='table-order-name'>{$resultOrderName}</td>";
        $orderTable.= "<td style='padding-right:1mm'>{$resultvalue["count"]}</td>
        <td>{$value['price']}tl</td>
        </tr>";

        $resultOrderName="";
    };

};

ob_start ();

echo "<style>
.header{
margin-left: 25mm;
font-size:5mm;
}
.header-alt{
margin-left: 29mm;
font-size:5mm;
}
.siparis-title{
font-size: 3mm;
margin-top: 1mm;
margin-left: 22mm;
}
.siparis-line{
font-size: 1mm;
width: 45mm;
}
.user-title{
margin-top: 3mm;
margin-left:4mm;
font-size: 3mm;
}
.date-line{
margin-top: 1mm;
border: 1px solid #0e0e0e;
margin-left:2mm;
margin-bottom:1mm;
font-size: 3mm;
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
font-size: 4mm;
margin: 0mm;
padding: 0mm;
}
.table-ürün-title{
padding-right:45mm;
}
.table-order-name{
    padding-right:20mm;
}

</style>

<div class='header'>ZEKİ USTA</div>
<div class='header-alt'>KEBAP</div>
<div class='siparis-title'>PAKET SİPARİŞİDİR</div>
<div class='user-title'>Sipariş No:{$orderId} {$OrderDetay['username']}</div>
<div class='date-line'>Tarih:{$orderDataYear}  Saat:{$orderDataday}  Masa No:Paket</div>
<table class='urun-title'>
  <tr>
    <th class='table-ürün-title' >Ürünler</th>
    <th style='padding-right:2mm'>Adet</th> 
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

        <td>Adisyon Toplam:</td>
        
        <td>{$OrderDetay['order_amount']} TL</td>
        
     </tr>
   </table>
   
   <div style='font-size: 4mm;margin-top: 5mm;margin-bottom: 1mm;margin-left: 8mm'> <u>Ödenecek Toplam Tutar : {$OrderDetay['order_amount']} TL </u></div>
   <div style='margin-left:25mm;font-size: 3mm'><i>Teşekkür Ederiz</i></div>
   
   <div style='left: 3mm ; margin-top: 10mm;font-size: 4mm'> {$OrderDetay['adress']}</div>
   <div style='font-size: 4mm;left: 3mm;margin-top: 1mm'>Arayan No: {$OrderDetay['phone']}</div>
";



$html = ob_get_contents ();
ob_clean ();

$mpdf->WriteHTML($html);

$mpdf->Output();
