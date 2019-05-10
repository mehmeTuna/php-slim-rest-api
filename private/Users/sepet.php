<?php

namespace Sepet ;

session_start();

//header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Headers: *");
if(!isset($_SESSION["user"]))
 exit;



 if(isset($_POST)){


    //$_POST = json_decode( file_get_contents("php://input") , true);
     
    print_r($_POST);
    echo $_POST["data"];
    exit;

     if(isset($_POST["data"])){
         array_push($_SESSION["user"]["product"] , $_POST["data"] ) ; 
         exit;
     }
     
 }


if(!isset($_GET) && $_GET["item"] != "ok")
  exit;


  require __DIR__ . "/../../database/connect.php";
  


  require __DIR__."/DBsepet.php";
  
 
  $render = new sepetProduct();


 echo json_encode( $render->run() , JSON_UNESCAPED_UNICODE );
 exit;