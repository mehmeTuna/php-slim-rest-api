<?php

namespace Menu ;


use DATABASE\Database ;
use PDO ;
use Exception ;


class menuproduct extends Database {
    const getAllCategorySqlQuery = "SELECT * FROM category ORDER BY id ASC";

    private $getProductSpecificCategorySqlQuery= "SELECT products.id,products.name,products.img,products.unlimited AS position ,products.card_text AS description,products.price,(SELECT name FROM category WHERE id=products.categoryId ) AS category_name,products.unlimited AS quantity,feature.content AS options FROM feature INNER JOIN products ON products.features= feature.id WHERE products.categoryId=? ORDER BY id ASC";

    public function __construct(){
        parent::startConnect();
    }


   public function run(){
       $categorys = $this->allCategory();
       $item = array();
       foreach($categorys as $result){
           $menuItems = [];
           $product= $this->productSpecificCategory($result["id"]);
            foreach($product as $key => $value){
                array_push($menuItems,[//bir ürüne ait detaylar
                    "id"=>$value["id"],
                    "name"=>$value["name"],
                    "position"=>$value["position"],
                    "price"=>$value["price"],
                    "category_name"=>$value["category_name"],
                    "quantity"=>$value["quantity"],
                    "options"=>json_decode($value["options"], true),
                    "description"=>$value["description"],
                    "img"=>$value["img"]
                ]);
            }
           array_push($item,[//bir menüye ait detaylar
            "id"=>$result["id"],
            "name"=>$result["name"],
            "position"=>"0",
            "categoryImage"=>$result["img"],
            "menuItems"=>$menuItems
           ]);
       }
    return $item ;
    }

    public function productSpecificCategory($categoryId= null) {
       try{
           $query = parent::connect()->prepare($this->getProductSpecificCategorySqlQuery);
           $query->execute( [$categoryId] );

           if(!$query->rowCount())
            return [];

            //id,name,position,description,price,categoryName,quantity,options(json)
            return $query->fetchAll();

       }catch(PDOException $e) {
           throw new Exception("Sorgu hatası");
       }
    }


    public function allCategory() {
        try{
            $query = parent::connect()->prepare( self::getAllCategorySqlQuery );
            $query->execute();
 
            if(!$query->rowCount())
             return [];
 
             return $query->fetchAll();
 
        }catch(PDOException $e) {
            throw new Exception("Sorgu hatası");
        }
    }
 

   public function __destruct(){
     parent::disconnect() ;
   }

}