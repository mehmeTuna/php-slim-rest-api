<?php
namespace Sepet ;

use DATABASE\Database ;
use PDO ;

class sepetProduct {
    private $connect ; 
    private $item ;
    private  $oldItem = true  ;

   public function __construct(){
      $connect = new Database();
      $this->connect = $connect->conn ;
   }


    public function run($id){
       
      $id = strip_tags( $id ); 

      for($a = 0 ; $a < count( $_SESSION["user"]["product"]) ; $a++){
         if($_SESSION["user"]["product"][$a]["id"] == $id){
            $_SESSION["user"]["product"][$a]["count"]++ ; 
            $this->oldItem = false ;
         }
      }
     
      $sepetData= "select price,name from products where id='{$id}'" ;
        $this->item = array("id"=>$id,"count"=>1);
       
      if($this->oldItem == true )
         try{
            $query = $this->connect->query( $sepetData ,  PDO::FETCH_ASSOC);
            
            if($query->rowCount()){
               foreach ($query as $value) {
                  $this->item["price"] = $value["price"] ;
                  $this->item["name"] = $value["name"] ;
               }
            }        
                  array_push(  $_SESSION["user"]["product"] , $this->item);
         }catch(PDOException $e){
            return $e ;
         }

         $_SESSION["user"]["cardTotal"] = 0 ;
         //sepet toplam fiyat
         array_map( function ($sepet) {   $_SESSION["user"]["cardTotal"] += (float) $sepet["price"] ; }, $_SESSION["user"]["product"]);
         $_SESSION["user"]["orderCount"] =  count($_SESSION["user"]["product"]);


    }

 

   public function __destruct(){
     
   }

}