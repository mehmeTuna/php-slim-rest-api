<?php
//cors policy denied sorununu çözüyor
//ayrı pcler arası iletişim sorununu çözüyor

/*
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
*/


session_start();

require __DIR__ .'/../../database/connect.php';

use DATABASE\Database ;

/*
if(!isset($_REQUEST)){
    echo "access denied";
    exit;
}
*/

    

    $js_echo = "bir hata oluştu";
    $username = "";
    $password = "";
    $name = array();
    $dbPassword = "" ;

      //using axios js post method data convert json to php array
      //$_POST = json_decode(file_get_contents('php://input') , true);

    if(isset($_POST["username"]) && strlen( trim( $_POST["username"] ) ) > 1 && filter_var( trim($_POST["username"]), FILTER_VALIDATE_EMAIL))
        $username = strip_tags( trim( $_POST["username"] ) ) ;
      
    if(isset($_POST["password"]) && strlen( trim( $_POST["password"] ) ) > 1 )
        $password = strip_tags( trim( $_POST["password"] ) ) ;


    if($username == "" ||  $password == ""){
        echo json_encode("uygun değerler giriniz" , JSON_UNESCAPED_UNICODE);
        exit ;
    }

    $login = new Database();
   
          try{
            $query = $login->conn->query( "select id,firstname,lastname,password,adress from users  where email='{$username}'" ,  PDO::FETCH_ASSOC);
          
            if($query->rowCount()){
                foreach($query as $val){
                    $name["firstname"] = $val["firstname"];
                    $name["lastname"] = $val["lastname"] ;
                    $name["adress"] = $val["adress"] ;
                    $db_password = $val["password"];

                }
            }else {
                $js_echo = "kullanıcı bulunamadı";
            }
        }catch(PDOException $e){
            $js_echo =   "denied" ;
        }


        if( password_verify($password ,$db_password )){
            $_SESSION["user"] = array(
                "username" => $val["id"] ,
                "firstname"=>$name["firstname"],
                "lastname"=>$name["lastname"],
                "email"=>$username ,
                "adress"=>$name["adress"],
                "product"=> array()
            );
            echo json_encode($name , JSON_UNESCAPED_UNICODE);
            exit;
        }else{
         $js_echo = "kullanıcı adı veya parola hatalı";
        }


echo json_encode($js_echo , JSON_UNESCAPED_UNICODE);
exit ;