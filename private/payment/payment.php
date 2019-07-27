<?php

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

        if( !isset($_SESSION) && !isset($_SESSION['user']) ) $this->control = false;  ;

        if( isset($_SESSION['user']['username']) ){
            $this->userId = $_SESSION['user']['username'];
        }else{
            $this->control = false;
        }

        if( count($_SESSION['user']['product']) > 0  ){

            $this->product = json_encode( $_SESSION['user']['product'] , JSON_UNESCAPED_UNICODE );

        }else {
            $this->control = false;
        }

        if( isset($_SESSION['user']['cardTotal']) ){
            $this->cardTotal = $_SESSION['user']['cardTotal'];
        }else {
            $this->control = false;
        }
    }

    //odeme yontemi tipi 
    //0 = kapida odeme
    //1= kartla kapida odeme
    //2 = kredi karti ile odeme
    public function method($method = ''){
        if($method == 2){
            exit ;
            //bu kısımda  kredı kartı ıle odeme kısmına yonlendır ok donerse bu kısımda sıparısı onayla
        }else $this->control = false  ;

        if($method == 0 || $method == 1 ){
             $this->method = $method ;
             return $this; 
        }else $this->control = false  ;
    }

    public function Control (){
        if(  $this->control == false ){
            return true ;
        }else{
            return $this->control ;
        }
    }

    public function run($icerik){

        $response = new Add ();
         $response->Add("order_status", $this->method);
         $response->Add('user_id' , $this->userId);
         $response->Add('orders' , $this->product );
         $response->Add('order_amount' , $this->cardTotal);
        $response->Add('icerik' , $icerik);
    
    
        if( empty( $this->control) ){
            return $response->run();
          }else {
            return json_encode($this->control , JSON_UNESCAPED_UNICODE );
        }
    }

    public function __destruct()
    {
        
    }
}


$data = json_decode( file_get_contents("php://input") , true);

//$data = $_POST ;



$newpayment = new Payment();


if(!isset($data["content"])){
    echo "Açıklama ekleyiniz";
     exit;
}else $data["content"] = "";


if( !isset($data['picked']) ){
    echo "odeme tıpı belırt";
    exit;
}

$newpayment->method($data['picked']);

if($newpayment->control() != true ){
echo json_decode($newpayment->control() , JSON_UNESCAPED_UNICODE);
exit ;
}else  echo $newpayment->run($data['content']);