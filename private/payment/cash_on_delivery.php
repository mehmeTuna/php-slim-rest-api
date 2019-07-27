<?php

namespace PAYMENT\CashOnDelivery ;

require_once __DIR__ ."/../NewOrder.php";

use NewOrder\CreateOrder ;


class Cashondelivery {
    private $data = array();
    private $control = true ;
    private $userData = "";
    private $product = array();

    public function __construct($data){
        $this->data = $data ;
        $this->addb = new CreateOrder();
    }

    public function control(){
    
        if(!isset($this->data["userData"]))
          $this->control = false ;

        if(!isset($this->data["userDataValue"]))
          $this->control = false ;

        if(!isset($this->data["deliveryTime"]))
          $this->control = false ; 

        if($this->control == false)
          return false ;

         $this->userData = $this->data["userData"];
         $this->userDataValue = $this->data["userDataValue"];
         $this->deliveryTime = $this->data["deliveryTime"];

        $_SESSION["user"]["product"] = array_map (function ($val){
            if(isset($val["features"])){
                array_splice ($val["features"]);
            }

            return $val ;
        },$_SESSION["user"]["product"]);


         $dataProduct = array(
            "orders"=>$_SESSION["user"]["product"],
            "order_amount"=>$_SESSION["user"]["cardTotal"],
            "icerik"=>$this->data["payment"]
        );
         $this->product = $dataProduct;
    }


    public function run(){
       return  $this->addb->add( $this->product )->run() ;
    }



    public function __destruct(){
        
    }
}