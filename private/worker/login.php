<?php
//cors policy denied sorununu çözüyor
//ayrı pcler arası iletişim sorununu çözüyor


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");



session_start();

require __DIR__ .'/../../database/connect.php';

use DATABASE\Database ;



    $js_echo = "bir hata oluştu";
    $username = "";
    $password = "";
    $name = array();
    $dbPassword = "" ;

      //using axios js post method data convert json to php array
      //$_POST = json_decode(file_get_contents('php://input') , true);

    if(isset($_POST["email"]) && strlen( trim( $_POST["email"] ) ) > 1 && filter_var( trim($_POST["email"]), FILTER_VALIDATE_EMAIL))
        $username = strip_tags( trim( $_POST["email"] ) ) ;
      
    if(isset($_POST["password"]) && strlen( trim( $_POST["password"] ) ) > 1 )
        $password = strip_tags( trim( $_POST["password"] ) ) ;


    if($username == "" ||  $password == ""){
        echo json_encode("uygun değerler giriniz" , JSON_UNESCAPED_UNICODE);
        exit ;
    }

    $login = new Database();
   
          try{
            $query = $login->conn->query( "select id,name,password from worker  where email='{$username}'" ,  PDO::FETCH_ASSOC);
          
            if($query->rowCount()){
                foreach($query as $val){
                    $name["name"] = $val["name"] ;
                    $db_password = $val["password"];

                }
            }else {
                $js_echo = "kullanıcı bulunamadı";
            }
        }catch(PDOException $e){
            $js_echo =   "denied" ;
        }


        if( $password == $db_password ){
            $_SESSION["operator"] = array(
                "id" => $val["id"] ,
                "name"=>$name["name"],
            );
            header("location: ../siparis-onay");
            exit;
        }else{
         $js_echo = "kullanıcı adı veya parola hatalı";
        }


echo json_encode($js_echo , JSON_UNESCAPED_UNICODE);
exit ;