<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

 session_start();

require_once __DIR__ . '/../../database/connect.php' ;
use DATABASE\Database ; 

$uri = new Database();
$uri = $uri->url ;

if(isset($_SESSION)){
    session_destroy() ;
   header("location: ".$uri."/home");
}else{
    echo "err";
}