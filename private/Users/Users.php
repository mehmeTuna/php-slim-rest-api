<?php

namespace User ;

if(!isset($_SESSION))
 session_start();

include __DIR__ .'/../Ip/Ip.php';
include __DIR__ . "/../time/timestamp.php";

use Ip\ip ;

use formattimestamp\Ttime;

class Create {

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
    
        $this->ip = ip::getIp();
        //demo
        $this->email_verified = '1';
        $this->registration_date = Ttime::gettime();
        $this->newuser = new Add();
  }

  /*public method is variable add*/
  public function add($val = array() ){
    $this->id = $this->createId();
    $this->email = $this->emailControl($val["email"]) ;

    $this->password =  $this->passwordCrypt($val["password"]);
    $this->firstname = $this->textControl($val["firstname"] , 50);
    $this->lastname = $this->textControl($val["lastname"] , 50);
    $this->phone = $this->validatePhoneNumber($val["phone"]);
    $this->adress = $this->textControl($val["adress"] , 100);
  }

    //data control return true or false
  public function control(){
    return ($this->variableControl === true) ? true : false ;
  }

    //new user add db return true or false
  public function run(){
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
        $_SESSION["user"] = array(
          "username" => $this->id ,
          "firstname"=>$this->firstname,
          "lastname"=>$this->lastname,
          "email"=>$this->email ,
          "adress"=>$this->adress,
          "product"=> array()
      );
        return "ok" ;
      }
    }

  /*create default number = 11 id  */
  private function createId(){
    return rand(10000 , 100000);
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
