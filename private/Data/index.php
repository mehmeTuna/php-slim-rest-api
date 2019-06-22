<?php
namespace Data ;
require_once  __DIR__ .'/insert.php';
use Data\Insert ;

$deneme = new Insert();

print_r( $deneme->orderKapidaPos('1' , '5') );