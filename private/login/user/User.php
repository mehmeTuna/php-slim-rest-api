<?php

namespace Login ;

include __DIR__ .'/../../Ip/Ip.php';
include __DIR__ .'/createlogin.php';
include __DIR__ .'/../../time/timestamp.php';


use Ip\Ip ;
use CreateUserLogin\create  ;
use formattimestamp\Ttime ;

class User {
    private $cookie = array("id"=>"" ,"hash"=>"" ,"time"=>"") ;
    private $cookieControl = true ;
    private $login ;

  public function __construct(){


  }

  public function createUser(){
    $id = str_pad(rand(0, (integer)pow(10, 11)-1), 11, '0', STR_PAD_LEFT) ;
    $time = Ttime::gettime();
    $hash = password_hash( strval(IP::getIp()) + strval($time) , PASSWORD_DEFAULT);

    setcookie("id", $id, time() + (86400 * 30), "/");
    setcookie("hash", $hash, time() + (86400 * 30), "/");
    setcookie("time" , $time , time()+(86400*30) , "/");

    // $this->login = new create($this->cookie);
  }


  public function islogin(){

    if(isset($_COOKIE["id"]))
     $this->cookie["id"] = strip_tags( trim($_COOKIE["id"]) ) ;
   else
     $this->cookieControl = false ;

   if( isset($_COOKIE["hash"]) )
     $this->cookie["hash"] = strip_tags( trim($_COOKIE["hash"]) );
   else
     $this->cookieControl = false ;

   if( isset($_COOKIE["time"]) )
     $this->cookie["time"] = strip_tags( trim($_COOKIE["time"]) ) ;
   else
     $this->cookieControl = false ;

     if($this->cookieControl != false ){
       $this->login = new create($this->cookie);
     }else {
       return false;
     }

     $this->login->control($this->cookie);
  }


  public function __destruct(){

  }
}

$nesd = new User();
