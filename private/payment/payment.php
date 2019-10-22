<?php

session_start();


require __DIR__.'/../orders/OrdersDb.php';

use Order\Add\Db\Add ;

class Payment{
    public $control = [] ;
    private $method= 0 ;
    private $userId ;
    private $product ;
    private $cardTotal ;

    public function __construct()
    {

        if( !isset($_SESSION) && !isset($_SESSION['user']) ) $this->control["user"] = false;  

        if( isset($_SESSION['user']['username']) ){
            $this->userId = $_SESSION['user']['username'];
        }else{
            $this->control["username"] = false;
        }

        if( count($_SESSION['user']['product']) > 0  ){

            $this->product = json_encode( $_SESSION['user']['product'] , JSON_UNESCAPED_UNICODE );

        }else {
            $this->control["product"] = false;
        }

        if( isset($_SESSION['user']['cardTotal']) ){
            $this->cardTotal = $_SESSION['user']['cardTotal'];
        }else {
            $this->control["cardTotal"] = false;
        }
    }

    //odeme yontemi tipi 
    //0 = kapida odeme
    //1= kartla kapida odeme
    //2 = kredi karti ile odeme
    public function method($method = 0){

        if($method == ""){
            $this->control["method"] = false ;
            return ;
        }

        if($method == 2){
            exit ;
            //bu kısımda  kredı kartı ıle odeme kısmına yonlendır ok donerse bu kısımda sıparısı onayla
        }

        if($method == 0 || $method == 1 ){
             $this->method = $method ;
             return ;
        }else $this->control["method"] = false  ;
    }

    public function Control (){
        if(  $this->control == [] ){
            return true ;
        }else{
            return $this->control;
        }
    }

    public function run($icerik,$adress= "adress"){
        if($adress == "" ){
            $this->control["adress"] = false;
        }

        $addAdress= ($adress == "adress") ? "adress" : "adress_2";

        $response = new Add ();
         $response->Add("order_status", $this->method);
         $response->Add('user_id' , $this->userId);
         $response->Add('orders' , $this->product );
         $response->Add('order_amount' , $this->cardTotal);
        $response->Add('icerik' , strip_tags($icerik));
        $response->Add("adress",$addAdress);
    
       return $response->run();

    }

    public function __destruct()
    {
        
    }
}


$data = json_decode( file_get_contents("php://input") , true);

$newpayment = new Payment();

if(!isset($data["content"])){
    $data["content"] = "";
}

if(!isset($data["adress"])){
    $data["adress"] = "";
}

if( !isset($data['picked']) ){
    echo "odeme tıpı belırt";
    exit;
}

$newpayment->method($data['picked']);


if($newpayment->Control() !== true ){
    echo json_encode([
        "status" => false ,
        "error" => $newpayment->Control ()
    ] , JSON_UNESCAPED_UNICODE);
    exit ;
}else  echo json_encode ([
    "status" => true ,
    "code" => $newpayment->run($data['content'],$data["adress"] )
], JSON_UNESCAPED_UNICODE);