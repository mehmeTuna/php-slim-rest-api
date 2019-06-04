<?php


namespace KitchenData ; 

require_once __DIR__ . '/../../../database/connect.php';



use DATABASE\Database;
use PDO;

class Data {
    private $db ;
    public $orderCount = array();

    public function __construct()
    {
       $this->db = new Database(); 
       $this->db = $this->db->conn ; 
    }



    public function Bringdata($val , $name){
        $sql = 'select count(*) from order_items where m_status=' . $val;

        try{
            $query = $this->db->query( $sql ,  PDO::FETCH_ASSOC);
           
                foreach($query as $val){
                    $this->orderCount[$name] = $val['count(*)'] ; 
                }
        }catch(PDOException $e){
            return  $e ;
        }
    }

    public function BringAllOrders($val){
        $result = array();
        $sql = 'select orders,user_id,m_date,order_id from order_items where m_status=' . $val  . ' order by m_date asc';
        $thisResult = array(); 
        try{
            $query = $this->db->query( $sql ,  PDO::FETCH_ASSOC);
           
                foreach($query as $val){
                   
                    $thisResult['content'] = $val['orders'];
                    $thisResult['date']  = $val['m_date'] ; 
                    $thisResult['orderId'] = $val['order_id']; 
                    $thisResult['phone'] = $val['user_id'];

                      $query = $this->db->query( 'select phone from users where id=' . $thisResult['phone'] ,  PDO::FETCH_ASSOC);

                foreach($query as $val){

                    $thisResult['phone'] = $val['phone'] ; 
                }


                    array_push($result , $thisResult);
                }

              

                return $result ;
        }catch(PDOException $e){
            return array(
                'status'=>$e
            );
        }
    }

    public function BringOrderdetay($id){

        $result = array();
        $sql = 'select icerik,orders from order_items where order_id="'.$id.'"';
      
        try{
            $query = $this->db->query( $sql ,  PDO::FETCH_ASSOC);
           
                foreach($query as $val){
                    $result['content'] = $val['icerik'];
                    $result['orders']  = $val['orders'];
                }
               
                if($result == [] ) return array('status'=>'not found');
                else return $result ;
        }catch(PDOException $e){
            return array(
                'status'=> $e
            );
        }
        
    }


    public function __destruct()
    {
        
    }
}