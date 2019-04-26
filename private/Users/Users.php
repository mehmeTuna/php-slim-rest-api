<?php

namespace Users  ;

include __DIR__ .'/../Ip/Ip.php';
include __DIR__.'/DB_CREATE_USER.php';

use Ip\ip ;
use CREATE_USER\Create ;

use \Datetime;

class User {
  private $id ='';//int (11)
  private $email ='';//varchar(500)
  private $password ='';//varchar(500)
  private $firstname ='';//varchar(50)
  private $lastname ='';//varchar(50)
  private $email_verified ='';//tinyint(1)
  private $registration_date ='';//timestamp -> current_timestamp
  private $verification_code ='';//varchar(20)
  private $ip =''; //varchar(50)
  private $phone ='';//varchar(20)
  private $adress ='';//varchar(100)
  private $adress_2 ='';//varchar(100)

  /********/
  //control default true
  private $variableControl = true ;

  private $newuser ;

  public function __construct(){
    date_default_timezone_set('Europe/Istanbul');
    $date = new DateTime(date("y-m-d H:i:s")) ;
        $this->ip = ip::getIp();
        //demo
        $this->email_verified = '1';
        $this->registration_date = $date->getTimestamp();
        $this->newuser = new Create();

  }

  /*public method is variable add*/
  public function add($email , $password , $firstname , $lastname , $phone , $adress){
    $this->id = $this->createId(11);
    $this->email = $this->emailControl($email) ;
    $this->password =  $this->passwordCrypt($password);
    $this->firstname = $this->textControl($firstname , 50);
    $this->lastname = $this->textControl($lastname , 50);
    $this->phone = $this->validatePhoneNumber($phone);
    $this->adress = $this->textControl($adress , 100);
  }

    //data control return true or false
  public function control(){
    return ($this->variableControl === true) ? true : false ;
  }

    //new user add db return true or false
  public function userCreate(){
    if($this->variableControl === false )
      return false ;

      $this->newuser->add("id" , $this->id);
      $this->newuser->add("email" , $this->email);
      $this->newuser->add("password" , $this->password);
      $this->newuser->add("firstname" , $this->firstname);
      $this->newuser->add("lastname" , $this->lastname);
      $this->newuser->add("email_verified" , $this->email_verified);
      $this->newuser->add("registration_date" , $this->registration_date);
      $this->newuser->add("verification_code" , $this->verification_code);
      $this->newuser->add("ip" , $this->ip);
      $this->newuser->add("phone" , $this->phone);
      $this->newuser->add("adress" , $this->adress);
      $this->newuser->add("adress_2" , $this->adress_2);

      $isCreatedUser = $this->newuser->run() ;
      if( $isCreatedUser === false )
       return false ;
      else{
        $_SESION["user"] = array(
          "id"=>$this->id,
          "my_cart"=>array()
        );
        return true ;
      }

    }


  private function createId($digits = 11 ){
    return str_pad(rand(0, (integer)pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT) ;
  }

  /*basic email control*/
  private function emailControl($email = ''){
    if(strlen( trim( $email ) ) > 1 && filter_var( $email, FILTER_VALIDATE_EMAIL)){
      return strip_tags( trim($email) );
    }else{
      $this->variableControl = false ;
      return false ;
    }
  }

  /* password hash*/
  private function passwordCrypt($pass =''){
    if( strlen(trim($pass)) > 0 ){
      //control password hash password_verify(password , hash);
      return password_hash(trim($pass) , PASSWORD_DEFAULT );
    }else{
      $this->variableControl = false ;
      return false;
    }
  }

  /*
  *$text variable
  *$length variable max length
  */
  private function textControl($text = '' , $length = 50){
    $_length = strlen(trim( $text ));

    if($_length >=1 && $_length <= $length){
      return strip_tags( trim($text) );
    }else{
      $this->variableControl = false;
      return false ;
    }
  }

  /*$pNumber integer value */
  private function validatePhoneNumber($pNumber = '') {
    $_length = strlen( trim($pNumber) ) ;
    if( $_length > 2 && $_length <= 20  && is_numeric($pNumber) ){
      return strip_tags( trim($pNumber) ) ;
    }else {
      $this->variableControl = false ;
      return false ;
    }
  }

  /*create Ip*/
  private function getIp(){
    return Ip::getIp();
  }


  public function __destruct(){
    unset($id);
    unset($email);
    unset($password);
    unset($firstname);
    unset($lastname);
    unset($email_verified);
    unset($registration_date);
    unset($verification_code);
    unset($ip);
    unset($phone);
    unset($adress);
    unset($adress_2);
  }
} ;
