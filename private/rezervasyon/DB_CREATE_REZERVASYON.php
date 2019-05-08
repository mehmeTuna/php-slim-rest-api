<?php


namespace Rezervasyon ;

use DATABASE\Database ;
use PDO ;

class Add {
  /*sql query*/
  private $table_name = "rezervasyon";
  private $values = "id,time,name,e_mail,phone,kisi_sayisi,m_status,ip,rez_date";
  private $valuesParameters = ":id,:time,:name,:e_mail,:phone,:kisi_sayisi,:m_status,:ip,:rez_date";
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
      return "ok" ;
    }catch(PDOException $e){
      return $e ;
    }
  }



  public function __destruct(){

  }
} 
