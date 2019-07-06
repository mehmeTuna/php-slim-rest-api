<?php


namespace User ;

use DATABASE\Database ;
use PDOException;

class Add {
  /*sql query*/
  private $table_name = "users";
  private $values = "id,email,password,firstname,lastname,birthday,email_verified,registration_date,verification_code,ip,phone,adress,adress_2";
  private $valuesParameters = ":id,:email,:password,:firstname,:lastname,:birthday,:email_verified,:registration_date,:verification_code,:ip,:phone,:adress,:adress_2";
  private $data = array();

  private $conn ;
  public function __construct(){
      $db = new database();
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
