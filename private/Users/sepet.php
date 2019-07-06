<?php

namespace Sepet ;

//require_once  __DIR__ . "/../cors.php";

session_start();


if(!isset($_SESSION["user"]))
 exit;

 require __DIR__ ."/../../database/connect.php";
 require __DIR__."/DBsepet.php";
 

 $render = new sepetProduct();

 $data = json_decode( file_get_contents("php://input"), true);

        if($data != ""){
          $render->run($data);
          exit;
        }
     
    
  if(isset($_GET) && isset($_GET["item"]) && $_GET["item"] == "ok"){
    echo json_encode( $_SESSION , JSON_UNESCAPED_UNICODE);
    exit;
  }

