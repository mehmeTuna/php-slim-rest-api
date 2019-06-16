<?php

require_once __DIR__ . '/DataClass.php';

use KitchenData\Data ;


$data = new Data();

$res =   $data->BringAllKurye();

$orderContent = '';
    foreach($res as $key ){
             $orderContent .= '<div class="mt-1"> ' . $key['name'] . ' <span class="btn btn-primary " onclick="addkurye('.$key['id'].')">Sec</span> <div> <br>';
        }


echo $orderContent ;
?>
