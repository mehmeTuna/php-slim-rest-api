<?php

//id ve data geliyor ona göre sparişi onayla ve detay ekle
//post ile content değikeninde sipariş içerik ekleme geliyor

session_start();
require __DIR__ ."/../../database/connect.php";
require __DIR__ . "/../../private/Authority.php";



use DATABASE\Database ;



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


    /**
     * @param $id
     * @param $opt
     * @param string $orderDetail
     * @return false|string
     */
    public function run($id , $opt , $orderDetail = ''){
      $id= strip_tags(trim($id));
      $opt= strip_tags(trim($opt));
      $orderDetail= strip_tags(trim($orderDetail));
      
      $user_id = null ;

      if($opt == "1"){
        $user_id = "select user_id from order_items where order_id='".$id."'";


        $query = $this->conn->query ( $user_id , PDO::FETCH_ASSOC );

        if ( $query->rowCount () ) {
            foreach ( $query as $value ) {
              $user_id = $value[ 'user_id' ];
            }
        }else exit ;


        $firstOrder = "update users set first_order='1' where id='".$user_id."'";
        $statement = $this->conn->prepare($firstOrder);
        $statement->execute();
      }
      
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


  if(!isset($_GET) && !$_GET["id"] && !is_numeric($_GET["id"]) && !isset($_GET["opt"] ))
    exit;
    
  $rez = new Order();
    $opt ="0";

    
      if($_GET["opt"] == "red")
      $opt = "2";
      if($_GET["opt"] == "onay")
      $opt = "1";

      if(isset($_POST['content']) && $_POST['content'] != ''){
        $orderDetail = strip_tags( $_POST['content'] );
        $opt = 1 ; 
        if($_SESSION['operator']['authority'] == Authority::write)
             echo $rez->run($_GET["id"] , $opt , $orderDetail) ;
        else echo json_encode(['status' => 'Yetkisiz İşlem!m']);  
        exit;
      }
 

if($_SESSION['operator']['authority'] == Authority::write)
    echo $rez->run($_GET["id"] , $opt ) ;
else echo json_encode(['status' => 'Yetkisiz İşlem!']);  
