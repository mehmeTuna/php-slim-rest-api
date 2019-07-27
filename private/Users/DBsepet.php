<?php
namespace Sepet ;

use DATABASE\Database ;
use PDO ;
use PDOException;

class sepetProduct {
    private $connect ; 
    private $item ;
    private  $oldItem = true  ;

   public function __construct(){
      $connect = new Database();
      $this->connect = $connect->conn ;
   }


    public function run($data){
       if(!isset($data["id"])){
           return false;
       }
       $id = strip_tags (trim ( $data["id"] )) ;
       if(isset($data["count"]))
        $count =(is_numeric (trim($data["count"]))) ? ($data["count"] > 0) ? $data["count"] : 1 : 1 ;
       else $count = 1 ;

      for($a = 0 ; $a < count( $_SESSION["user"]["product"]) ; $a++){
         if($_SESSION["user"]["product"][$a]["id"] == $id){

             //ürün detay ekleme
             if(isset($data["options"]) && is_array ($data["options"])){
                 if(isset($_SESSION["user"]["product"][$a]["features"])){
                     array_push ($_SESSION["user"]["product"][$a]["features"] ,["count"=>$count , "items"=>$data["options"]] );
                 }
             }else array_push ($_SESSION["user"]["product"][$a]["features"] ,["count"=>$count , "items"=>""] );

             $price = $_SESSION["user"]["product"][$a]["price"] / $_SESSION["user"]["product"][$a]["count"] ;

            $_SESSION["user"]["product"][$a]["count"] +=  $count ;
            $_SESSION["user"]["product"][$a]["price"] +=  round($price, 2) * $count ;//number_format((float)$price, 2, '.', ''); ;
            $this->oldItem = false ;
         }
      }
     
      $sepetData= "select price,name from products where id='{$id}'" ;
        $this->item = array("id"=>$id,"count"=> $count );
       
      if($this->oldItem == true ){
          try{
              $query = $this->connect->query( $sepetData ,  PDO::FETCH_ASSOC);

              if($query->rowCount()){
                  foreach ($query as $value) {
                      $this->item["price"] = $value["price"] * $this->item["count"] ;
                      $this->item["name"] = $value["name"] ;

                      if(isset($data["options"]))
                        $this->item["features"] = [0=>["count"=>$this->item["count"] , "items"=>$data["options"]]];
                  }
              }
              array_push(  $_SESSION["user"]["product"] , $this->item);
          }catch(PDOException $e){
              return $e ;
          }
      }


         $_SESSION["user"]["cardTotal"] = 0 ;
         //sepet toplam fiyat
         array_map( function ($sepet) {   $_SESSION["user"]["cardTotal"] += (float) $sepet["price"] ; }, $_SESSION["user"]["product"]);
         $_SESSION["user"]["orderCount"] =  count($_SESSION["user"]["product"]);
        return true ;

    }

 

   public function __destruct(){
     
   }

}