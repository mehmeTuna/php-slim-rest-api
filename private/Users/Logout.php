<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");


if(!isset($_SESSION))
 session_start();



if(isset($_SESSION["user"])){
    unset($_SESSION["user"]);
    echo "ok";
}else{
    echo "err";
}