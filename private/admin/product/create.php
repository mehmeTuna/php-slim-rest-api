<?php

namespace Admin\Product ;

use \Datetime;

class Create {
    private $id ;
    private $price ;
    private $name ;
    private $date ;
    private $numberOfProduct ;
    private $categoryId ;
    private $unlimited ;
    private $live = "1";
    private $card_text ;
    private $img = "null";
    private $other_img ="null";
    private $stores = "Adana";
    private $long_text ;


    private $newProduct ;

    private $variableControl = true ;



   public function __construct(){
      date_default_timezone_set('Europe/Istanbul');
      $date = new DateTime(date("y-m-d H:i:s")) ;

      $this->date = $date->getTimestamp() ;
      $this->unlimited = "1";
      $this->live = "1" ;
      $this->id = $this->createId() ;


      $this->newProduct = new Add();
   }

   public function add($val = array() ){

    $this->price =  $this->textControl($val["price"] , 50 ) ; 
    $this->name =  $this->textControl($val["name"] , 50 ) ; 
    $this->numberOfProduct =  $this->textControl($val["numberOfProduct"] , 50 ) ; 
    $this->categoryId =  $this->textControl($val["categoryId"] , 50 ) ; 
    $this->card_text =  $this->textControl($val["card_text"] , 50 ) ; 
    $this->long_text =  $this->textControl($val["long_text"] , 500 ) ; 
    $this->img = (isset($_FILES["img"])) ? $this->imgUpload("img") : "";
    $this->other_img = json_encode(
      array(
        1=>(isset($_FILES["img_1"])) ? $this->imgUpload("img_1") : "",
        2=>(isset($_FILES["img_2"])) ? $this->imgUpload("img_2") : "",
        3=>(isset($_FILES["img_3"])) ? $this->imgUpload("img_3") : "",
      )
      , JSON_UNESCAPED_UNICODE) ;


    //img ler eklenmeli ve isimleri  db ye eklenmeli
   }

   public function run(){
    $this->newProduct->add("id" , $this->id);
    $this->newProduct->add("price" , $this->price);
    $this->newProduct->add("name" , $this->name);
    $this->newProduct->add("date" , $this->date);
    $this->newProduct->add("numberOfProduct" , $this->numberOfProduct);

    $this->newProduct->add("categoryId" , $this->categoryId);
    $this->newProduct->add("unlimited" , $this->unlimited);
    $this->newProduct->add("live" , $this->live);
    $this->newProduct->add("card_text" , $this->card_text);

    $this->newProduct->add("img" , $this->img);
    $this->newProduct->add("other_img" , $this->other_img );
    $this->newProduct->add("stores" , $this->stores);
    $this->newProduct->add("long_text" , $this->long_text);

     if($this->variableControl)
      return $this->newProduct->run();
     else return false ; 
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

  private function createId(){
    return rand(100000,999999);
   }

  public function __destruct(){
    unset($this->id);
  }


  private function imgUpload($fileName){
   //Check if the file is well uploaded
	if($_FILES[$fileName]['error'] > 0) { return 'Error during uploading, try again'; }
	
	//We won't use $_FILES['file']['type'] to check the file extension for security purpose
	
	//Set up valid image extensions
	$extsAllowed = array( 'jpg', 'jpeg', 'png', 'gif' );
	
	//Extract extention from uploaded file
		//substr return ".jpg"
		//Strrchr return "jpg"
		
	$extUpload = strtolower( substr( strrchr($_FILES[$fileName]['name'], '.') ,1) ) ;
	//Check if the uploaded file extension is allowed
	
	if (in_array($extUpload, $extsAllowed) ) { 
	
  //Upload the file on the server
  $randname =  md5(time() . $_FILES[$fileName]['name']) .".".pathinfo($_FILES[$fileName]['name'], PATHINFO_EXTENSION);
	
	$name = __DIR__ . "/../../../uploads/".$randname;
  $result = move_uploaded_file($_FILES[$fileName]['tmp_name'], $name);
 	
  if($result){
    return $randname ;
  }else{
    $this->variableControl = false;
  }
		
	} else { 
    $this->variableControl = false;
    return 'File is not valid. Please try again'; }
  }

}