<?php

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
          $this->add->Add("icerik" , strip_tags(trim($val)));
          return $this->add->run();
    }


    public function __destruct(){
        
    }
}