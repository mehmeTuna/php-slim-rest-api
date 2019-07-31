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
        $product = array();
        $id = strip_tags (trim ( $data["id"] )) ;

        if(isset($data["count"]))
            $count =(is_numeric (trim($data["count"]))) ? ($data["count"] > 0) ? $data["count"] : 1 : 1 ;
        else $count = 1 ;

        if(!isset($data["id"])) return false ;

        if(!isset($data["options"]) ){
            $data["options"] = array();
           }

        try{
            $query = $this->connect->prepare("SELECT price,name FROM products WHERE id=?");
            $query->execute( array($id) );
            if($query->rowCount()){
                $product= $query->fetchAll();
                $product= $product[0];
            }
        }catch(PDOException $e){
            return $e;
        }

       

      for($a = 0 ; $a < count( $_SESSION["user"]["product"]) ; $a++){
         if($_SESSION["user"]["product"][$a]["id"] == $id){
             //ürün detay ekleme
                 if(isset($_SESSION["user"]["product"][$a]["features"])){
                     array_push ($_SESSION["user"]["product"][$a]["features"] ,["count"=>$count , "items"=>$data["options"]] );
                 }
           
            $_SESSION["user"]["product"][$a]["count"] +=  $count ;
            $_SESSION["user"]["product"][$a]["price"] +=  round( round( $product["price"], 2) * $count ,2) ;
            $this->oldItem = false ;
         }
      }
     
        $this->item = array("id"=>$id,"count"=> $count , "features"=>array( ) );
       
        if($this->oldItem == true ){
            $this->item["price"] = round( $product["price"] * $this->item["count"] ,2) ;
            $this->item["name"] = $product["name"] ;
            array_push($this->item["features"], ["count"=> $count , "items"=>$data["options"]] );
            array_push(  $_SESSION["user"]["product"] , $this->item);
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