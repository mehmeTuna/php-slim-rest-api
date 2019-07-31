<?php
namespace Admin\Product ;

use DATABASE\Database ;

use PDO ;

class Add {
  /*sql query*/
  private $table_name = "products";
  private $values = "id,price,name,date,numberOfProduct,categoryId,unlimited,live,card_text,img,other_img,stores,long_text,features";
  private $valuesParameters = ":id,:price,:name,:date,:numberOfProduct,:categoryId,:unlimited,:live,:card_text,:img,:other_img,:stores,:long_text,:features";
  private $data = array();
  private $addFeatures= "";

  private $conn ;
  public function __construct(){
      $db = new Database();
      $this->conn = $db->conn ;
  }

  public function add($variable , $value ){
      if($variable == "features"){
          $id = rand(100,1000);
          $result = $value;
          $this->data["features"] = $id ;

          $this->addFeatures = "insert into feature (id,content) values (".$id.",'".$result."')";


          return $this;
      }
    $this->data[$variable] = $value ;
    return $this ;
  }

  public function run(){
   $add = 'insert into '.$this->table_name .' ('.$this->values.') values ('.$this->valuesParameters .')';

    try{
      $statement = $this->conn->prepare($add);
      $statement->execute($this->data);
    }catch(PDOException $e){
      return "denied" ;
    }

    try{
      $statement = $this->conn->prepare($this->addFeatures);
      $statement->execute();
      return ['status'=>'ok'] ;
    }catch(PDOException $e){
    }
  }



  public function __destruct(){

  }
}
