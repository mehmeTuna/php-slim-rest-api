<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");


 session_start();



if(isset($_SESSION["operator"])){
    unset($_SESSION["operator"]);
  header("location: ../calisan");
}else{
    echo "err";
}