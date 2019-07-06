<?php



namespace Sepet\DELETE_ITEM ;

//require_once  __DIR__ . "/../cors.php";

session_start();

if(!isset($_SESSION["user"])){
  echo json_encode( ['status'=>'login degil'], JSON_UNESCAPED_UNICODE); 
  exit;
}
 
 
 $durum = false ;
 $count = 0 ;

 if(isset($_GET) && isset($_GET["id"]))
  $id = $_GET["id"];
 else {
   echo json_encode( ['status'=>'parametre haatasi'], JSON_UNESCAPED_UNICODE);
   exit;
 }

 for($a = 0 ; $a < count( $_SESSION["user"]["product"]) ; $a++){
    if($_SESSION["user"]["product"][$a]["id"] == $id){
      $count = $a ;
      $durum =  true ;
      break;
    }
 }


 if($durum == true ){
     array_splice( $_SESSION["user"]["product"], $count , 1 );

     
         $_SESSION["user"]["cardTotal"] = 0 ;
         //sepet toplam fiyat
         array_map( function ($sepet) {   $_SESSION["user"]["cardTotal"] += (float) $sepet["price"] ; }, $_SESSION["user"]["product"]);
         $_SESSION["user"]["orderCount"] =  count($_SESSION["user"]["product"]);


     
 echo json_encode( 
    array(
        "status"=>"ok"
    ) 
    , JSON_UNESCAPED_UNICODE);

 }else {
   echo json_encode( ['status'=>'urun bulunamadi'], JSON_UNESCAPED_UNICODE);
 }



 


