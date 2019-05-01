<?php

namespace Product ;
require __DIR__ .'/../../database/connect.php';
require __DIR__ .'/details.php';
require __DIR__ . '/category.php';

use Product\details ;
use Product\Category ;

if(!isset($_REQUEST)){
    echo "access denied";
    exit;
}


if(isset($_GET["productName"]) && strlen(trim($_GET["productName"])) >=3){
  $name = $_GET["productName"] ;
  $details = new details();
  $result = $details->name($name)->run();
  echo json_encode($result , JSON_UNESCAPED_UNICODE);
  exit ;
}


if(isset($_GET["categoryName"]) && isset($_GET["page"]) ){
    if(is_numeric( $_GET["page"] ) && (int)$_GET["page"] >=0 && (int)$_GET["page"] <=1024){
        $page = $_GET["page"] ;
        $categoryName = trim( $_GET["categoryName"] ) ;
        $category = new Category();
        $result = $category->name($categoryName)->page($page)->run();
        echo json_encode($result , JSON_UNESCAPED_UNICODE);
        exit ;
    }else {
        echo "page to 0-1024";
    }
} 
