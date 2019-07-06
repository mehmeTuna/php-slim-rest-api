<?php
session_start();


if ( !isset( $_SESSION[ "mutfak" ] ) || $_SESSION[ 'mutfak' ][ 'authority' ] != '2' ) {
    echo json_encode (['status'=>'yetkisiz islem'] , JSON_UNESCAPED_UNICODE) ;
    exit;
}

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
    $orderContent .="<tr onclick=\"addkurye ( '{$key['id']}')\"><th scope=\"row\"  >{$sira}</th><th scope=\"row\"> {$key['name']}</th>  <th scope=\"row\"><button type=\"button\" class=\"btn btn-primary\">Sec</button> </th></tr>";
  $sira++;
}
?>


        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Kurye Seç
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <table class="table dropup">
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
        </div>

<div  class="btn btn-primary" onclick="siparisOnayla()">Kuryeye ver</div>

