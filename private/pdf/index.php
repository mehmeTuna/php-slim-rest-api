<?php
/*
 * Mehmet Tuna pdf draft
 */
require_once __DIR__ . '/../../vendor/autoload.php';



$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => [100, 50],
    "default_font_size"=>10,
    "margin_top"=>13,
    "margin_left"=>3,
    "margin_right"=>3,
    "margin_bottom"=>3,
    'orientation' => 'L'
]);

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
}
</style>

<div class='header'>ZEKİ USTA</div>
<div class='header-alt'>KEBAP</div>
<div class='siparis-title'>PAKET SİPARİŞİDİR</div>
<div class='user-title'>Sipariş No:32525 Mehmet Tuna</div>
<div class='date-line'>Tarih:21.06.2019  Saat:18:41  Masa No:Paket</div>
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
    <th>Adet</th> 
    <th>Tutar</th>
  </tr>
  <tr>
    <td>Jill</td>
    <td>Smith</td> 
    <td>50</td>
  </tr>
  <tr>
    <td>Eve</td>
    <td>Jackson</td> 
    <td>94</td>
  </tr>
</table>
";



$html = ob_get_contents ();
ob_clean ();

$mpdf->WriteHTML($html);

$mpdf->Output();
