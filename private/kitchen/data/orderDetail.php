<?php

session_start();

require_once __DIR__ . '/DataClass.php';

use KitchenData\Data ;


if ( !isset( $_SESSION[ "mutfak" ] ) || $_SESSION[ 'mutfak' ][ 'authority' ] == '0' ) {
    echo 'yetki sahibi degilsiniz' ;
    exit;
}

$id = strip_tags($_GET['id']) ;

$data = new Data();

//BringOrderdetay fonksiyonu tam değil düzenlenmesi lazım çalışmaz şu an
$res =   $data->BringOrderdetay($id);

$note = isset( $res[ 'content' ] ) && $res[ 'content' ] != '' ? 'Musteri Notu: ' . $res[ 'content' ] : '';

$orderContent = '';
if( isset($res['orders']) && $res['orders'] != '' ){
        foreach($res['orders'] as $key ){
                $orderContent .= '<tr><td>' . $key .'    </td></tr>';

        }
}
?>

<thead></thead>

    <tbody class="table">
        <?php  echo $orderContent ;  ?>
    <tr>
    <td > <?php echo $note;  ?></td>
    </tr>

</tbody>
