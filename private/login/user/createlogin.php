<?php

namespace CreateUserLogin ;

include __DIR__ .'/../../../database/connect.php';
include __DIR__.'/../../time/timestamp.php';

use DATABASE\database ;

use formattimestamp\Ttime ;

class create{
  //connect database
  private $conn ;

  //user login db variables
  private $table_name = "login_users";
  //insert data
  private $values ="id,login_time,authority";
  private $valuesParameters = ":id,:login_time,:authority";
  private $data = array();

  public function __construct($cookie){
    $db = new database();
    $this->conn = $db->conn ;
    $data = array(
      "id"=>$cookie["id"],
      "login_time"=>$cookie["time"],
      "authority"=>$cookie["hash"]
    );
  }

  public function login(){
    $add = "insert into {$this->table_name} ({$this->values}) values ({$this->valuesParameters})" ;

    try{
      $statement = $this->conn->prepare($add);
      $statement->execute($this->data);
      return true ;
    }catch(PDOException $e){
      return $e;
    }
  }

    public function control( $cookie = array("id"=>"","hash"=>"","time"=>"") ){
        $id = $cookie["id"] ;
        $hash = $cookie["hash"];
        $time = $cookie["time"];

       $add = "select id from {$this->table_name} where login_time=':login_time' and authority=':value'";
      try{
        $statement = $conn->prepare($add);
        $veri->bindValue(':login_time', $time, PDO::PARAM_STR);
        $veri->bindValue(':value', $hash, PDO::PARAM_STR);
        $statement->execute();
        $dizi = $statement->fetchAll(PDO::FETCH_ASSOC);
        return ( isset($dizi[0]["id"]) ) ? $dizi[0]["id"] : false ;
      }catch(PDOException $e){
        return $e ;
      }
    }

    public function userData($cookie = array("id"=>"","hash"=>"","time"=>"")){
      $id = $cookie["id"] ;
      $hash = $cookie["hash"];
      $time = $cookie["time"];

     $add = "select id , value from {$this->table_name} where login_time=':login_time' and authority=':value'";
      try{
        $statement = $conn->prepare($add);
        $veri->bindValue(':login_time', $time, PDO::PARAM_STR);
        $veri->bindValue(':value', $hash, PDO::PARAM_STR);
        $statement->execute();
        $dizi = $statement->fetchAll(PDO::FETCH_ASSOC);
        $val = array(
          "id"=> ( isset($dizi[0]["id"]) ) ? $dizi[0]["id"] : false,
          "value"=>( isset($dizi[0]["value"]) ) ? $dizi[0]["value"] : false
        );
        return $val ;
      }catch(PDOException $e){
        return $e ;
      }
    }

    public function logout($cookie = array("id"=>"","hash"=>"","time"=>"") ){
      $id = $cookie["id"] ;
      $hash = $cookie["hash"];
      $time = $cookie["time"];

     $add ="delete from {$this->table_name} where login_time=':login_time' and authority=':value'";

      try{
        $statement = $conn->prepare($add);
        $veri->bindValue(':login_time', $time, PDO::PARAM_STR);
        $veri->bindValue(':value', $hash, PDO::PARAM_STR);
        $statement->execute();
        return true ;
      }catch(PDOException $e){
        return false ;
      }
    }


    public function __destruct(){

    }
}
