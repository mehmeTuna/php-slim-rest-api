<?php 
//id durum ise ok ve red bu iki duruma göre işelmi onayla veya reddet

require __DIR__ ."/../../database/connect.php";

use DATABASE\Database ;

class Rezervasyon {
    /*sql query*/
    private $table_name = "rezervasyon";
    private $conn ;

    public function __construct(){
        $db = new Database();
        $this->conn = $db->conn ;
    }
  

  
    public function run($id , $opt ){
      $durum = "0";
 
      if($opt == "ok")
        $durum = "1" ;
        else if($opt == "red")
        $durum = "2" ;

        
        $sql = "UPDATE {$this->table_name} SET m_status=? WHERE id=?";
        
  
      try{
        $this->conn->prepare($sql)->execute([$durum, $id]);
       
       return  json_encode(
            array(
                "status"=>$opt
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



    $rez = new Rezervasyon();

    if($_GET["durum"] == "ok")
    echo $rez->run($_GET["id"] , "ok") ;
    else 
    echo $rez->run($_GET["id"] , "red");

