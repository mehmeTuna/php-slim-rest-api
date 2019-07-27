<?php

namespace Sepet ;

//require_once  __DIR__ . "/../cors.php";

session_start();

if(!isset($_SESSION["user"]))
 exit;

 require __DIR__ ."/../../database/connect.php";
 require __DIR__."/DBsepet.php";

if(isset($_GET) && isset($_GET["item"]) && $_GET["item"] == "ok"){
    echo json_encode( $_SESSION , JSON_UNESCAPED_UNICODE);
    exit;
}
 $render = new sepetProduct();

 $data = json_decode( file_get_contents("php://input"), true);

        if($data != ""){
            $result = $render->run($data) ;
            if($result == false){
                echo "parametre hatası";
            }else echo json_encode (["status"=>"ok"] , JSON_UNESCAPED_UNICODE);
          exit;
        }
     
    


