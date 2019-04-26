<?php

namespace Product ;

use DATABASE\Database ;
use PDO ;


class Category {
    private $connect ; 
    private $tableName ="products";
    private $name ="" ;
    private $piece = "10" ;
    private $column ="*" ;
    private $where_key ="" ;
    private $where_value ="" ;



   public function __construct(){
      $connect = new Database();
      $this->connect = $connect->conn ;
   }

   
   public function name($_name){
    $this->name = strip_tags( trim($_name) ) ;
    return $this; 
   }

   public function piece($_piece){
       $this->piece = strip_tags( trim($_piece) ) ;
       return $this;
   }

   public function page($_page){
       $this->page = strip_tags( trim($_page) ) ;
       return $this; 
   }

   public function column($_column){
       $_column = strip_tags( trim($_column) ) ;
       $this->column += (strlen($this->column) == 0 ) ? $_column : ",".$_column ;
      return $this ;
   }

   public function where($_where){
       $this->where_key = strip_tags( trim($_name) );
       return $this;
   }

   public function key($_value){
       $this->where_value = strip_tags( trim($_key) ) ;
       return $this;
   }

   public function run(){
       if($this->name == "all")
        $where = "" ;
       else 
        $where = " where category_id = '{$this->name}' " ;  
    
       $limit = "Order By id ASC LIMIT ". $this->page*10 ." , 10";

       $add= "select {$this->column} from {$this->tableName}  {$where} {$limit}" ;
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
