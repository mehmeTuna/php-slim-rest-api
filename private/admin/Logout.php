<?php
session_start();

if(!isset($_REQUEST)){
    echo "access denied";
    exit;
}



if(isset($_SESSION["admin"])){
    unset($_SESSION["admin"]);
    echo "ok";
}else{
    echo "err";
}