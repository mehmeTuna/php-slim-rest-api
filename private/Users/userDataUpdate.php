<?php
session_start ();
//kullanıcı adres güncelleme kısmı

require_once __DIR__ . "/../../database/connect.php";
$db = new \DATABASE\Database();
$db = $db->conn ;

if(!isset($_SESSION["user"]))
    echo array ("status"=>"login değil");

$dataAdress = json_decode ( file_get_contents ("php://input"), JSON_UNESCAPED_UNICODE);
if(!$dataAdress){
    echo json_encode (array ("status"=>"bos veri"),JSON_UNESCAPED_UNICODE);
    exit;
}

$dataAdress["adress"] = strip_tags (trim($dataAdress["adress"]));
$query = "update  users set adress_2=:adres where id=:id";

try {
    $statement = $db->prepare ( $query );
    $statement->execute ( ["adres"=>$dataAdress["adress"] , "id"=>$_SESSION["user"]["username"]] );
    $_SESSION["user"]["adress_2"] = $dataAdress["adress"];

    echo json_encode ( [ 'status' => 'ok' ] , JSON_UNESCAPED_UNICODE );
    exit;

} catch ( PDOException $e ) {
    echo json_encode ( [ 'status' => 'kaydetme sorunu' ] , JSON_UNESCAPED_UNICODE );
    exit;
}