<?php

require_once __DIR__ . '/DataClass.php';

use KitchenData\Data ;


$data = new Data();

$res =   $data->BringAllKurye();

$orderContent = '';
$sira = 1 ;
foreach ($res as $key){
    $orderContent .="<tr onclick=\"addkurye ( '{$key['id']}')\" class=\"\"><th scope='row' >{$sira}</th><td>{$key['name']} </td><td> <button type=\"button\" class=\"btn btn-primary\">Sec</button> </td></tr>";
  $sira++;
}
?>
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col"></th>
        <th scope="col">Soyad</th>
        <th scope="col">Sec</th>
    </tr>
    </thead>
    <tbody>
   <?php echo  $orderContent ; ?>

    </tbody>
</table>
<div  class="btn btn-primary" onclick="siparisOnayla()">Siparisi Onayla ve Fis Al</div>
<div  class="btn btn-primary ml-3" onclick="siparisIptal()">Siparisi Iptal Et</div>