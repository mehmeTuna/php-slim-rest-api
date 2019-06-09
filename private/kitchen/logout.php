<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");


 session_start();

   $uriBack = isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : '';


if(isset($_SESSION["mutfak"])){
   session_destroy();
  header("location: " . $uriBack);
}else{
    echo "err";
}