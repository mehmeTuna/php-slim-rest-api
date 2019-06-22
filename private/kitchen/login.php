<?php
//cors policy denied sorununu çözüyor
//ayrı pcler arası iletişim sorununu çözüyor
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");



session_start();

require __DIR__ .'/../../database/connect.php';

use DATABASE\Database ;

   $login = new Database();

    $js_echo = "bir hata oluştu";
    $username = "";
    $password = "";
    $name = array();
    $dbPassword = "" ;
    $uri = isset( $_GET['uri']) ? $login->url . '/' . $_GET['uri'] : $login->url . '/mutfak/home';
    $uriBack = isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : '';

      //using axios js post method data convert json to php array
      //$_POST = json_decode(file_get_contents('php://input') , true);

    if(isset($_POST["email"]) && strlen( trim( $_POST["email"] ) ) > 1 && filter_var( trim($_POST["email"]), FILTER_VALIDATE_EMAIL))
        $username = strip_tags( trim( $_POST["email"] ) ) ;
      
    if(isset($_POST["password"]) && strlen( trim( $_POST["password"] ) ) > 1 )
        $password = strip_tags( trim( $_POST["password"] ) ) ;


    if($username == "" ||  $password == ""){
        header("location: " . $uriBack);
        exit ;
    }

 
   $db_password = "";
          try{
            $query = $login->conn->query( "select id,name,password,authority from worker  where email='{$username}'" ,  PDO::FETCH_ASSOC);
          
            if($query->rowCount()){
                foreach($query as $val){
                    $name["name"] = $val["name"] ;
                    $db_password = $val["password"];
                    $name['authority'] = $val['authority'] ;
                }
            }else {
                $js_echo = "kullanıcı bulunamadı";
            }
        }catch(PDOException $e){
            $js_echo =   "denied" ;
        }


        if( password_verify($password , isset($db_password) ? $db_password : "" ) ){
            $_SESSION["mutfak"] = array(
                "id" => $val["id"] ,
                "name"=>$name["name"],
                'authority'=>$name['authority']
            );
            header("location: " . $uri);
            exit;
        }else{
            header("location: ".$uriBack);
        }


echo json_encode($js_echo , JSON_UNESCAPED_UNICODE);
exit ;