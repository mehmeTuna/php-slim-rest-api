<?php

require_once __DIR__ . '/DataClass.php';

use KitchenData\Data ;




$id = strip_tags($_GET['id']) ;

$data = new Data();

$res =   $data->BringOrderdetay($id);

if( isset($res['content'])  && $res['content'] != '')
$note  = 'Musteri Notu: '.$res['content'] ;
else $note = '';


$orderContent = '';
if( isset($res['orders']) && $res['orders'] != '' ){
    $content = json_decode($res['orders'] , true ) ;
    if($content != false && $content != null){
        foreach($content as $key ){
             $orderContent .= '<tr><td>' . $key['count'] . ' x '.$key['name'].'</td></tr>';
        }
     }
}


?>



<thead>


    </thead>

    <tbody>
        <?php  echo $orderContent ;  ?>
    <tr>
    <td> <?php echo $note;  ?></td>
    </tr>

</tbody>
