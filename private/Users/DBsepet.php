<?php
namespace Sepet ;

use DATABASE\Database ;
use PDO ;

class sepetProduct {
    private $connect ; 

   public function __construct(){
      $connect = new Database();
      $this->connect = $connect->conn ;
   }


   public function add($id){
     
       $sepetData= "select price,name from products where id=".$id ;
       $item = array("price"=>"", "name"=>"");
      
       try{
        $query = $this->connect->query( $sepetData ,  PDO::FETCH_ASSOC);
        
        if($query->rowCount()){
            foreach ($query as $value) {

               $item["price"] = $value["price"] ;
               $item["name"] = $value["name"] ;
            }
        }
      return $item ;
     }catch(PDOException $e){
         return $e ;
     }
    }

    public function run(){
        $item = array();
       if(isset($_SESSION["user"]["product"]))
        for($a = 0 ; $a<count($_SESSION["user"]["product"]) ; $a++){
             array_push($item , $this->add($_SESSION["user"]["product"][$a]));
        }
        return $item ;
    }
 

   public function __destruct(){
     
   }

}