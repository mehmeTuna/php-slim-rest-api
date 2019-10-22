<?php
session_start ();
//kullanıcı adres güncelleme kısmı

require_once __DIR__ . "/../../database/connect.php";
$db = new DATABASE\Database();
$db = $db->conn ;



if(!isset($_SESSION["user"])){
   echo json_encode (array ("status"=>"login değil"),JSON_UNESCAPED_UNICODE);
    exit;
}


$queryData=[];

$data = json_decode ( file_get_contents ("php://input"), JSON_UNESCAPED_UNICODE);


if(!$data){
    echo json_encode (array(
        'status'=>false,
        'text'=>'bos data'
    ),JSON_UNESCAPED_UNICODE);
    exit;
}

$data= array_map (function ($data){
    if(!is_array($data))
        return  strip_tags ( htmlspecialchars( trim($data)) );  
        
        return $data ;
}, $data);

$userData = null ;

    try{
        $result= $db->query("SELECT * FROM users WHERE id = '{$_SESSION["user"]["username"]}'")->fetch(PDO::FETCH_ASSOC);
      
        if($result){
           $userData= $result ;
        }else {
            echo json_encode (array(
                'status'=>false,
                'text'=>'hatali kullanici'
            ),JSON_UNESCAPED_UNICODE);
            exit;
        }
    }catch(PDOException $e){
        echo json_encode (array(
            'status'=>false,
            'text'=>'kullanici bulunamadi'
        ),JSON_UNESCAPED_UNICODE);
        exit;
    }


$query = "update users set ";

if(isset($data["adress"]) &&  is_array($data["adress"]) ){
        switch($data['adress']['id']){
            case 0 :
            $adres= json_encode([
                'title' => isset($data["adress"]['title']) ? $data["adress"]['title'] : null,
                'content' => substr($data["adress"]['content'], 0 , 99)
            ], JSON_UNESCAPED_UNICODE);

            if($userData['adress'] == null){
                $query.=($query != "update users set ") ? ", " : "" ;
                $query.="adress=:adress";
                $queryData["adress"]= $adres;
                $_SESSION["user"]["adress"]= $data["adress"];
                break;
            }else if($userData['adress_2'] == null){
                $query.=($query != "update users set ") ? ", " : "" ;
                $query.="adress_2=:adress";
                $queryData["adress"]= $adres;
                $_SESSION["user"]["adress_2"]= $data["adress"];
                break;
            }else if($userData['adress_3'] == null){
                $query.=($query != "update users set ") ? ", " : "" ;
                $query.="adress_3=:adress";
                $queryData["adress"]= $adres;
                $_SESSION["user"]["adress_3"]= $data["adress"];
            }else {
                $query.=($query != "update users set ") ? ", " : "" ;
                $query.="adress_3=:adress";
                $queryData["adress"]= $adres;
                $_SESSION["user"]["adress_3"]= $data["adress"];
            }
            break;
            case 1:
            $adres= json_encode([
                'title' => isset($data["adress"]['title']) ? $data["adress"]['title'] : null,
                'content' => substr($data["adress"]['content'], 0 , 99)
            ], JSON_UNESCAPED_UNICODE);
            $query.=($query != "update users set ") ? ", " : "" ;
            $query.="adress=:adress";
            $queryData["adress"]= $adres;
            $_SESSION["user"]["adress"]= $adres;
            break;
            case 2:
            $adres= json_encode([
                'title' =>isset($data["adress"]['title']) ? $data["adress"]['title'] : null,
                'content' => substr($data["adress"]['content'], 0 , 99)
            ], JSON_UNESCAPED_UNICODE);
            $query.=($query != "update users set ") ? ", " : "" ;
            $query.="adress_2=:adress";
            $queryData["adress"]= $adres;
            $_SESSION["user"]["adress_2"]= $adres;
            break;
            case 3:
            $adres= json_encode([
                'title' => isset($data["adress"]['title']) ? $data["adress"]['title'] : null,
                'content' => substr($data["adress"]['content'], 0 , 99)
            ], JSON_UNESCAPED_UNICODE);
            $query.=($query != "update users set ") ? ", " : "" ;
            $query.="adress_3=:adress";
            $queryData["adress"]= $adres;
            $_SESSION["user"]["adress_3"]= $adres;
            break;
        }
}


if(isset($data["email"]) && $data["email"] != "" && filter_var( trim($data["email"]), FILTER_VALIDATE_EMAIL)){
    $query.=($query != "update users set ") ? ", " : "" ;
    $query.= "email=:email ";
    $queryData["email"]= substr($data["email"], 0 , 99);
    $_SESSION["user"]["email"]= $data["email"];
}
if(isset($data["firstname"]) && $data["firstname"] != ""){
    $query.=($query != "update users set ") ? ", " : "" ;
    $query.= "firstname=:firstname ";
    $queryData["firstname"]= substr($data["firstname"], 0 , 49);
    $_SESSION["user"]["firstname"]= $data["firstname"];
}
if(isset($data["lastname"]) && $data["lastname"] != ""){
    $query.=($query != "update users set ") ? ", " : "" ;
    $query.= "lastname=:lastname ";
    $queryData["lastname"]= substr($data["lastname"], 0 , 49);
    $_SESSION["user"]["lastname"]= $data["lastname"];
}
if(isset($data["phone"]) && $data["phone"] != ""){
    $query.=($query != "update users set ") ? ", " : "" ;
    $query.= "phone=:phone ";
    $queryData["phone"]= substr($data["phone"], 0 , 19);
    $_SESSION["user"]["phone"]= $data["phone"];
}

if(isset($data["oldPassword"]) && $data["oldPassword"] != "" && isset($data["newPassword"]) && $data["newPassword"] != ""){
    try{
        $result=  $db->query( "select * from users  where id='{$_SESSION["user"]["username"]}'" ,  PDO::FETCH_ASSOC);
      
        if($result->rowCount()){
            foreach($result as $val){
               if( password_verify($data["oldPassword"] , isset($val["password"]) ? $val["password"] : "" )){
                    $query.=($query != "update users set ") ? ", " : "" ;
                    $query.= "password=:newPassword ";      
                    $queryData["newPassword"]= password_hash(trim($data["newPassword"]) , PASSWORD_DEFAULT );
               }
            }
        }else {
            echo json_encode (array(
                'status'=>false,
                'text'=>'parola hatali'
            ),JSON_UNESCAPED_UNICODE);
            exit;
        }
    }catch(PDOException $e){
        echo json_encode (array(
            'status'=>false,
            'text'=>'Parola islemi hatasi'
        ),JSON_UNESCAPED_UNICODE);
        exit;
    }

   
}

$query.= " where id=:id";


$queryData["id"]= $_SESSION["user"]["username"] ;



try {
    $statement = $db->prepare ( $query );
    $statement->execute ( $queryData  );

    echo json_encode ( [
        'status' => true,
        'text' => 'basarili'
        ] , JSON_UNESCAPED_UNICODE );
    exit;

} catch ( PDOException $e ) {
    echo json_encode (array(
        'status' => false,
        'text' => 'biseyler ters gitti'
    ) , JSON_UNESCAPED_UNICODE );
    exit;
}