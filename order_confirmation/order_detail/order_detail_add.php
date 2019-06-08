<?php

//id ve data geliyor ona göre sparişi onayla ve detay ekle
//post ile content değikenşnde sipariş içerik ekleme geliyor


require __DIR__ ."/../../database/connect.php";

use DATABASE\Database ;
session_start();

if(!isset($_SESSION["operator"])){
  header("location: calisan");
  exit;
}

class Order {
    /*sql query*/
    private $table_name = "order_items";
    private $conn ;

    public function __construct(){
        $db = new Database();
        $this->conn = $db->conn ;
    }
  

  
    public function run($id , $opt , $orderDetail = ''){
      
      if($orderDetail != '')
        $sql = "UPDATE {$this->table_name} SET m_status=? , icerik=? WHERE order_id=?";
        else 
          $sql = "UPDATE {$this->table_name} SET m_status=? WHERE order_id=?"; 
  
      try{
        if($orderDetail == '')
         $this->conn->prepare($sql)->execute([$opt, $id]);
        else 
         $this->conn->prepare($sql)->execute([$opt, $orderDetail,  $id ]);
          
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

    
  $rez = new Order();
    $opt ="0";

    if( isset($_GET["opt"] ) ){

      if($_GET["opt"] == "red")
      $opt = "2";
      if($_GET["opt"] == "onay")
      $opt = "1";

      if(isset($_POST['content']) && $_POST['content'] != ''){
        $orderDetail = $_POST['content'];
        $opt = 1 ; 
        if($_SESSION['operator']['authority'] == 2)
             echo $rez->run($_GET["id"] , $opt , $orderDetail) ;
        else echo json_encode(['status' => 'yetkisiz islem']);  
        exit;
      }
    }else
      exit;

if($_SESSION['operator']['authority'] == 2)
    echo $rez->run($_GET["id"] , $opt ) ;
else echo json_encode(['status' => 'yetkisiz islem']);  
