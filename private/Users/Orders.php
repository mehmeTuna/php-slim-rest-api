<?php 

//require_once  __DIR__ . "/../cors.php";

session_start();

require_once __DIR__ . '/../../database/connect.php' ;

use DATABASE\Database ; 



if( !isset($_SESSION['user']) )
  exit ; 

$db = new Database();
$db = $db->conn ;

$response = [] ;

$result = $db->query('select * from order_items where user_id="'. $_SESSION['user']['username']. '" ORDER BY m_date DESC' ,  PDO::FETCH_ASSOC);

foreach($result as $val){
  array_push($response , $val);
} 


   $response = array_map(
       function($val){
           if(isset($val['m_status'])){
               if($val['m_status']== 0 ){
                   $val['m_status'] = 'Sipariş alındı' ;
               }else if($val['m_status'] == 1 ){
                   $val['m_status'] = 'Siparişiniz onaylandı';
               }else if($val['m_status'] == 2){
                   $val['m_status'] = 'Siparişiniz iptal edildi';
               }else if ($val['m_status'] == 3){
                   $val['m_status'] = 'Siparişiniz hazırlandı' ;
               }else if ($val['m_status'] == 4){
                   $val['m_status'] = 'Siparişiniz reddedildi' ;
               }else if ($val['m_status'] == 5){
                   $val['m_status'] = 'Siparişiniz kuryeye verildi' ;
               }
           }
           $val['orders'] = json_decode( $val['orders'] , true ) ; 
            return $val ;
       }, $response
   );


echo json_encode($response , JSON_UNESCAPED_UNICODE) ; 
exit ;


