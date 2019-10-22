<?php


namespace Product ;

require_once __DIR__ ."/../../private/cors.php";

require_once __DIR__ .'/../../database/connect.php';
require_once __DIR__ .'/details.php';
require_once __DIR__ .'/category.php';
require_once __DIR__ ."/menu.php";


use Product\details ;
use Product\Category ;
use Menu\menuproduct ;

use Exception;



if(isset($_GET["productName"]) && strlen(trim($_GET["productName"])) >=3){
  $name = htmlspecialchars($_GET["productName"]) ;
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
        exit;
    }
} 

if( isset($_GET["menu"]) && $_GET["menu"] == "ok" ){
    $details = new menuproduct();

        try{
            $result = $details->run();
        }catch(Exception $e){
            echo json_encode([
                "description"=>$e,
                "result"=>[]
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }
    
    echo json_encode($result , JSON_UNESCAPED_UNICODE);
    exit ;
}