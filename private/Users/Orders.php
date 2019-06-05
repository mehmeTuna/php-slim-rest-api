<?php 

session_start();
require_once __DIR__ . '/../../database/connect.php' ;

use DATABASE\Database ; 



if( !isset($_SESSION['user']) )
  exit ; 

$db = new Database();
$db = $db->conn ;

$response = [] ;

$result = $db->query('select * from order_items where user_id="'. $_SESSION['user']['username']. '"' ,  PDO::FETCH_ASSOC);

foreach($result as $val){
  array_push($response , $val);
} 


   $response = array_map(
       function($val){
           $val['orders'] = json_decode( $val['orders'] , true ) ; 
            return $val ;
       }, $response
   );


echo json_encode($response , JSON_UNESCAPED_UNICODE) ; 
exit ; 


