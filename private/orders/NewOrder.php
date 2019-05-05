<?php 
//orders,m_status,order_status

namespace NewOrder ;

require __DIR__ ."/OrdersDb.php";

use Order\Add\Db\Add ;

class CreateOrder {
    private $add ;
    public $islogin ;

    public function __construct(){
         $this->add = new Add();
    }



    public function item($val){
   
        if(!$this->add->IsLogin())
          return "login değil" ;

          $this->add->Add("orders",$val["orders"]);
          return $this->add->run();
    }



    public function __destruct(){
        
    }
}