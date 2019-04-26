<?php

namespace Product ;

use DATABASE\Database ;
use PDO ;


class details {
    private $connect ; 
    private $tableName ="products";
    private $name ="" ;
   

   public function __construct(){
      $connect = new Database();
      $this->connect = $connect->conn ;
   }

   
   public function name($_name){
    $this->name = strip_tags( trim($_name) ) ;
    return $this; 
   }



   public function run(){
        $where = " where id = '{$this->name}' " ;  


       $add= "select * from {$this->tableName}  {$where}" ;
       $item = array();
      
       try{
        $query = $this->connect->query( $add ,  PDO::FETCH_ASSOC);
        
        if($query->rowCount()){
            foreach ($query as $value) {
                array_push($item , $value );
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
