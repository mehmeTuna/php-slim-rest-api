<?php

namespace Menu ;


use DATABASE\Database ;
use PDO ;


class menuproduct {
    private $connect ; 

   public function __construct(){
      $connect = new Database();
      $this->connect = $connect->conn ;
   }


   public function run(){
     

       $categoryData= "select * from category" ;
       $item = array();
       $menuItems = array();
      
       try{
        $query = $this->connect->query( $categoryData ,  PDO::FETCH_ASSOC);
        
        if($query->rowCount()){
            foreach ($query as $value) {

                try{
                    $query = $this->connect->query( "select id,name,card_text,price from products where categoryId=" . $value["id"] ,  PDO::FETCH_ASSOC);
                    
                    if($query->rowCount()){
                        foreach ($query as $menuValue) {
                            array_push($menuItems , 
                            array(
                                    "id"=>$menuValue["id"],
                                    "name"=>$menuValue["name"],
                                    "position"=>"1",
                                    "description"=>$menuValue["card_text"],
                                    "price"=>$menuValue["price"],
                                    "category_name"=> $value["name"]
                            )
                         );
                        }
                    }
                 }catch(PDOException $e){
                     return $e ;
                 }


                 array_push($item , 
                 array(
                     "id"=>$value["id"],
                     "name"=>$value["name"],
                     "position"=>"0",
                     "categoryImage"=>$value["img"],
                     "menuItems"=>$menuItems
                 )
              );
              $menuItems = array();
            }
        }
      return $item ;
     }catch(PDOException $e){
         return $e ;
     }

    }
 

   public function __destruct(){
     
   }

}