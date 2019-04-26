<?php
namespace CREATE_PRODUCT ;


use DATABASE\Database ;
use PDO ;

class Create {
  /*sql query*/
  private $table_name = "products";
  private $values = "id,name,price,discount,card_desc,short_desc,long_desc,image,image_list,category_id,update_date,stock,live,unlimited,location";
  private $valuesParameters = ":id,:name,:price,:discount,:card_desc,:short_desc,:long_desc,:image,:image_list,:category_id,:update_date,:stock,:live,:unlimited,:location";
  private $data = array();

  private $conn ;
  public function __construct(){
      $db = new Database();
      $this->conn = $db->conn ;
  }

  public function add($variable , $value ){
    $this->data[$variable] = $value ;
    return $this ;
  }

  public function run(){
   $add = 'insert into '.$this->table_name .' ('.$this->values.') values ('.$this->valuesParameters .')';

    try{
      $statement = $this->conn->prepare($add);
      $statement->execute($this->data);
      return true ;
    }catch(PDOException $e){
      return false ;
    }
  }



  public function __destruct(){

  }
}