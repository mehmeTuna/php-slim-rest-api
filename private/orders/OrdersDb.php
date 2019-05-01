<?php


namespace Order\Add\Db ;

require __DIR__ ."/../../database.php";
require __DIR__."/../time/timestamp.php";

use DATABASE\Database ;
class Add {
    public $islogin = false ;
    private $data = array();//order_id,user_id,m_date,orders,m_status,order_status
    private $value = array();
    private $firstOrder = 0 ;
    private $dbErr = true ; //true = no err or false = err
    private $db  ;

    public function __construct()
    { 
        $this->db = new Database();
        $this->db = $this->db->conn ;     
    }


    public function IsLogin(){
        if(isset($_SESSION["user"]))
          $this->islogin = true ;

          return $this ;
    }

    public function Add($data , $value){
      $this->data = $data ;
      $this->value = $value ;
      return $this ;
    }

    public function run(){
        
        
        try{
            $query = $this->db->query( "select first_order from users  where id='".$_SESSION['user']["username"]."'" ,  PDO::FETCH_ASSOC);
           
            if($query->rowCount()){
                foreach($query as $val){

                    if($val["first_order"] == 0 ){
                         $this->firstOrder = 0 ;
                    }else{
                        $this->firstOrder = 1 ;
                    }
                }
            }else {
                echo json_encode("kullanıcı bulunamadı" , JSON_UNESCAPED_UNICODE);
            }
        }catch(PDOException $e){
             $this->dbErr =  false ; 
        }



       
        $add = 'insert into order_items (order_id,user_id,m_date,orders,m_status,order_status) values (:order_id,:user_id,:m_date,:orders,:m_status,:order_status)';

        try{
          $statement = $this->conn->prepare($add);
          $statement->execute($this->data);
          return true ;
        }catch(PDOException $e){
          return $e ;
        }



        $add = "UPDATE users SET firs_order = 1 WHERE id='" . $_SESSION["user"]["username"] ."'";

        try{
            $statement = $this->conn->prepare($add);
            $statement->execute();
            return true ;
        }catch(PDOException $e){
            $this->dbErr = false;
        }









    }




    public function __destruct()
    {
        
    }
}