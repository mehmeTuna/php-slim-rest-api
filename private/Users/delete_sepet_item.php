<?php

namespace Sepet\DELETE_ITEM ;

session_start();
//header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Headers: *");
if(!isset($_SESSION["user"]))
 exit;
 
 $durum = "false";
 $count = 0 ;

 if(isset($_GET) && isset($_GET["id"]))
  $id = $_GET["id"];
 else 
   exit ;
    

 for($a = 0 ; $a < count( $_SESSION["user"]["product"]) ; $a++){
    if($_SESSION["user"]["product"][$a]["id"] == $id){
      $count = $a ;
      break;
    }
 }

 array_splice( $_SESSION["user"]["product"], $count );

 echo json_encode( 
    array(
        "status"=>"ok"
    ) 
    , JSON_UNESCAPED_UNICODE);

