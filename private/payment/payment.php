<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

session_start();

require __DIR__.'/../orders/OrdersDb.php';

use Order\Add\Db\Add ;

class Payment{
    public $control = array() ;
    private $method ; 
    private $userId ;
    private $product ;
    private $cardTotal ;

    public function __construct()
    {

        if( !isset($_SESSION) && !isset($_SESSION['user']) ) $this->control['user'] = 'undefined' ;

        if( isset($_SESSION['user']['username']) ){
            $this->userId = $_SESSION['user']['username'];
        }else{
            $this->control['username'] = 'undefined' ;
        }

        if( count($_SESSION['user']['product']) > 0  ){
            $this->product = json_encode( $_SESSION['user']['product'] );

        }else {
            $this->control['cart'] = 'null' ;
        }

        if( isset($_SESSION['user']['cardTotal']) ){
            $this->cardTotal = $_SESSION['user']['cardTotal'];
        }else {
            $this->control['cardTotal'] = '0'; 
        }
    }

    //odeme yontemi tipi 
    //0 = kapida odeme
    //1= kartla kapida odeme
    //2 = kredi karti ile odeme
    public function method($method = ''){
        if($method == 0 || $method == 1 || $method == 2 ){
             $this->method = $method ;
             return $this; 
        }else $this->control = false  ;
    }

    public function Control (){
        if(  $this->control == array() ){
            return true ;
        }else{
            return $this->control ;
        }
    }

    public function run(){

        $response = new Add ();
         $response->Add("order_status", $this->method);
         $response->Add('user_id' , $this->userId);
         $response->Add('orders' , $this->product );
         $response->Add('order_amount' , $this->cardTotal);
    
    
        if( empty( $this->control) ){
            return $response->run();
          }else {
            return json_decode($this->control , true );
        }
    }

    public function __destruct()
    {
        
    }
}

$newpayment = new Payment();

$data = json_decode( file_get_contents('php://input' ) , true ) ;

$newpayment->method($data['picked']);

if($newpayment->control != true ){
echo $newpayment->control();
}
$rez = $newpayment->run();

print_r($rez);
//ilk once kontrol et
//daha sonra run ile calistir