<?php 

session_start();
require_once __DIR__ . '/../../database/connect.php' ;

use DATABASE\Database ; 



if( !isset($_SESSION['user']))
  exit ; 
$db = new Database();
$db = $db->conn ;

$response = [3=>34] ;

$result = $db->query('select * from order_items where user_id="'. $_SESSION['user']['username']. '"' ,  PDO::FETCH_ASSOC);

foreach($result as $val){
  array_push($response , $val);
} 

echo json_encode($response , JSON_UNESCAPED_UNICODE) ; 
exit ; 


