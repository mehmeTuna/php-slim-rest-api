<?php
if(!isset($_SESSION))
 session_start();

if(!isset($_REQUEST)){
    echo "access denied";
    exit;
}



if(isset($_SESSION["user"])){
    unset($_SESSION["user"]);
    echo "ok";
}else{
    echo "err";
}