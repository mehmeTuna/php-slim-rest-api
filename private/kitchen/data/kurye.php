<?php

require_once __DIR__ . '/DataClass.php';

use KitchenData\Data ;

if ( !isset( $_SESSION[ "mutfak" ] ) || $_SESSION[ 'mutfak' ][ 'authority' ] == '0' ) {
    echo 'yetki sahibi degilsiniz' ;
    exit;
}

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
        <th scope="col">Ad Soyad</th>
        <th scope="col">Sec</th>
    </tr>
    </thead>
    <tbody>
   <?php echo  $orderContent ; ?>

    </tbody>
</table>
<div  class="btn btn-primary" onclick="siparisOnayla()">Kuryeye ver</div>
