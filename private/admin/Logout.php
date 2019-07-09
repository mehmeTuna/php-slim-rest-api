<?php
session_start();

if(!isset($_REQUEST)){
    echo "access denied";
    exit;
}



if(isset($_SESSION["admin"])){
    unset($_SESSION["admin"]);
    header("Location: home");
exit;
}else{
    echo "err";
}