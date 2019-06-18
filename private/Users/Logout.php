<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

 session_start();

require_once  __DIR__ . '/../../Config.php' ;
$uri = (new WebRoot)->url() ;

if(isset($_SESSION)){
    session_destroy() ;
   header("location: ".$uri."/home");
}else{
    echo "err";
}