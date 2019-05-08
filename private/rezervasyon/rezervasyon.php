<?php

namespace Rezervasyon ;

if(!isset($_SESSION))
 session_start();

include __DIR__ .'/../Ip/Ip.php';
include __DIR__ . "/../time/timestamp.php";

use Ip\ip ;
use Rezervasyon\Add ;

use formattimestamp\Ttime;

class Create {

  private $id ='';//int (11)
  private $time ='';//timestamp -> current_timestamp
  private $name ='';//varchar(50)
  private $email ='';//varchar(50)
  private $phone ='';//varchar(50)
  private $kisi_sayisi ='';//varchar(20)
  private $m_status ='';
  private $ip='';
  private $rez_date = '';
  private $newRezervasyon ;

  
  /********/
  //control default true
  private $variableControl = true ;

  public function __construct(){
    
        $this->ip = ip::getIp();
        //demo
        $this->m_status = '0';
        $this->time = Ttime::gettime();

        $this->newRezervasyon = new  Add();
   }

  /*public method is variable add*/
  public function add($val = array() ){
    $this->id = $this->createId();
    $this->email = $this->emailControl(isset($val["email"]) ? $val["email"] : "") ;

    $this->name = $this->textControl(isset($val["name"]) ? $val["name"] : "" , 50);
    $this->kisi_sayisi = $this->textControl(isset($val["attendents"]) ? $val["attendents"] : "" , 50);
    $this->phone = $this->validatePhoneNumber(isset($val["phone"]) ? $val["phone"] : "");
    $this->rez_date = $this->textControl(isset($val["date"]) ? $val["date"] : "" , 50);
  }

  //data control return true or false
  public function control(){
    return ($this->variableControl === true) ? true : false ;
  }

    //new user add db return true or false
  public function run(){
    if($this->variableControl === false )
      return false ;

      $this->newRezervasyon->add("id" , $this->id);
      $this->newRezervasyon->add("time" , $this->time);
      $this->newRezervasyon->add("name" , $this->name);
      $this->newRezervasyon->add("e_mail" , $this->email);
      $this->newRezervasyon->add("phone" , $this->phone);
      $this->newRezervasyon->add("kisi_sayisi" , $this->kisi_sayisi);
      $this->newRezervasyon->add("m_status" , $this->m_status);
      $this->newRezervasyon->add("ip" , $this->ip);
      $this->newRezervasyon->add("rez_date" , $this->rez_date);
      
     
       return $this->newRezervasyon->run() ;
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
