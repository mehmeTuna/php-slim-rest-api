<?php

//id ve data geliyor ona göre sparişi onayla ve detay ekle
//post ile content değikenşnde sipariş içerik ekleme geliyor


require __DIR__ ."/../../database/connect.php";

use DATABASE\Database ;

class Order {
    /*sql query*/
    private $table_name = "order_items";
    private $conn ;

    public function __construct(){
        $db = new Database();
        $this->conn = $db->conn ;
    }
  

  
    public function run($id , $opt ){
      
        $sql = "UPDATE {$this->table_name} SET m_status=? WHERE order_id=?";
  
      try{
        $this->conn->prepare($sql)->execute([$opt, $id]);
       
       return  json_encode(
            array(
                "status"=>"ok"
            )
        );
    
      }catch(PDOException $e){
        return  json_encode(
            array(
                "status"=>"red"
            )
        );
      }
    }
  
  
  
    public function __destruct(){
  
    }
  }


  if(!isset($_GET) && !$_GET["id"] && !is_numeric($_GET["id"]) && strlen($_GET["id"])<=15)
    exit;

    

    $opt ="0";

    if( isset($_GET["opt"] ) ){
      if($_GET["opt"] == "red")
      $opt = "2";
      if($_GET["opt"] == "onay")
      $opt = "1";
    }else
    exit;

    $rez = new Order();

    echo $rez->run($_GET["id"] , $opt) ;
  
