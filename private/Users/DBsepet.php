<?php
namespace Sepet ;

use DATABASE\Database ;
use PDO ;

class sepetProduct {
    private $connect ; 
    private $item ;

   public function __construct(){
      $connect = new Database();
      $this->connect = $connect->conn ;
   }


    public function run($id){
        $sepetData= "select price,name from products where id=".$id ;
        $this->item = array("id"=>$id,"count"=>1);
       
        try{
         $query = $this->connect->query( $sepetData ,  PDO::FETCH_ASSOC);
         
         if($query->rowCount()){
             foreach ($query as $value) {
 
                $this->item["price"] = $value["price"] ;
                $this->item["name"] = $value["name"] ;
             }
         }
       
         array_push($_SESSION["user"]["product"] , $this->item ) ; 
      }catch(PDOException $e){
          return $e ;
      }
    }

 

   public function __destruct(){
     
   }

}