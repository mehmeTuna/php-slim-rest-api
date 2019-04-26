<?php

namespace Admin\Product ;

include __DIR__. '/DB_CREATE_PRODUCT.php';

use CREATE_PRODUCT\Create ;
use \Datetime;

class product {
    private $connect ; 
    private $id ;
    private $name ;
    private $price ;
    private $discount ;
    private $card_desc ;
    private $short_desc ;
    private $long_desc ;
    private $image_logo ;
    private $product_img ;
    private $product_img_1 ;
    private $product_img_2 ;
    private $product_img_3 ;
    private $category ;
    private $date ;
    private $stok = 10;
    private $live = 1 ;
    private $unlimited ;
    private $location = "Adana";


    private $newProduct ;

    private $variableControl = true ;



   public function __construct(){
      date_default_timezone_set('Europe/Istanbul');
      $date = new DateTime(date("y-m-d H:i:s")) ;

      $this->id = $this->createId(11);
      $this->date = $date->getTimestamp() ;
      $this->unlimited = "1";


      $this->newProduct = new Create();
   }

   public function add($name , $discount , $card_desc , $short_desc , $long_desc , $image_logo , $product_img_1 , $product_img_2 , $product_img_3 , $category){
        $this->name =  $this->textControl($name , 50 ) ;
        $this->discount =  $this->textControl($discount , 50) ;
        $this->card_desc =  $this->textControl($card_desc , 50) ;
        $this->short_desc =  $this->textControl($short_desc , 500) ;
        $this->long_desc =  $this->textControl($long_desc , 1024) ;
        $this->image_logo = $image_logo ;
        $this->product_img_1 = $product_img_1 ;
        $this->product_img_2 = $product_img_2 ;
        $this->product_img_3 = $product_img_3 ;
        $this->category =  $this->textControl($category , 50) ;
   }

   public function addDb(){
    $this->newProduct->add("id" , $this->id);
    $this->newProduct->add("name" , $this->name);
    $this->newProduct->add("price" , $this->price);
    $this->newProduct->add("discount" , "1");
    $this->newProduct->add("card_desc" , $this->discount);
    $this->newProduct->add("short_desc" , $this->short_desc);
    $this->newProduct->add("long_desc" , $this->long_desc);
    $this->newProduct->add("image" , $this->image_logo);
    $this->newProduct->add("image_list" , 
         json_encode( array(1=>$this->product_img_1,2=>$this->product_img_2,3=>$this->product_img_3), JSON_UNESCAPED_UNICODE) 
     );
     $this->newProduct->add("category_id" , "all");
     $this->newProduct->add("update_date" , $this->date);
     $this->newProduct->add("stock" , $this->stok);
     $this->newProduct->add("live" , $this->live);
     $this->newProduct->add("unlimited" , $this->unlimited);
     $this->newProduct->add("location" , $this->location);

     return $this->newProduct->run();

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

  private function createId($digits = 11 ){
    return str_pad(rand(0, (integer)pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT) ;
  }

   public function __destruct(){
     
   }

}

$safda = new Product();