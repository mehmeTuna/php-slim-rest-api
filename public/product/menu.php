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
                    $query = $this->connect->query( "select * from products where categoryId=" . $value["id"] ,  PDO::FETCH_ASSOC);
                    if($query->rowCount()){
                        foreach ($query as $menuValue) {
                            try{
                                $query = $this->connect->query( "select * from features where id=" . $menuValue["features"] ,  PDO::FETCH_ASSOC);
                                if($query->rowCount()) {
                                    foreach ($query as $productOpt){
                                        $option=json_decode ($productOpt["content"] , true);
                                    }
                                }
                            }catch (\PDOException $e){$option = ""; }
                            array_push($menuItems , 
                            array(
                                    "id"=>$menuValue["id"],
                                    "name"=>$menuValue["name"],
                                    "position"=>"1",
                                    "description"=>$menuValue["card_text"],
                                    "price"=>$menuValue["price"],
                                    "category_name"=> $value["name"],
                                    "quantity"=>1,
                                    "option"=>$option
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