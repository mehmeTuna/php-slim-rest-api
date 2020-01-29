<?php
include 'class.phpmailer.php';
include '../../database/connect.php';

$db = new DATABASE\Database();

      //using axios js post method data convert json to php array
      $userEmail = json_decode(file_get_contents('php://input') , true);
$userEmail = trim($userEmail["email"]);

if(!filter_var( $userEmail, FILTER_VALIDATE_EMAIL)){
  echo json_encode([
    "status" => false,
    "text" => "Geçerli eposta hesabı girin"
  ]);
  exit;
}


$user = [] ;

try{
  $query = $db->conn->query( "select * from users  where email='{$userEmail}'" ,  PDO::FETCH_ASSOC);

  if($query->rowCount()){
      foreach($query as $val){
        $user["name"] = $val["firstname"] ." ". $val["lastname"];
      }
  }else {
    echo json_encode([
      "status" => false,
      "text" => "Geçerli eposta hesabı girin",
    ]);
    exit;
  }
}catch(PDOException $e){
  echo json_encode([
    "status" => false,
    "text" => "Hata"
  ]);
  exit;
}


$newPassword= rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9) ;

$updateMail = "UPDATE users SET password=? WHERE email=?";

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->Username = 'noreplyzekiusta@gmail.com';
$mail->Password = 'ggzsgwpahvcfkger';
$mail->SetFrom($mail->Username, $user["name"]);
$mail->AddAddress($userEmail, $user["name"]);
$mail->CharSet = 'UTF-8';
$mail->Subject = 'Parola değişikliği talebi';
$content = '<div style="background: #eee; padding: 10px; font-size: 14px">Parolanız başarılı bir şekilde değiştirildi. Parola:'.$newPassword.' </div>';
$mail->MsgHTML($content);


if($mail->Send()) {

$newPasswordHash = password_hash(trim($newPassword) , PASSWORD_DEFAULT );

  try {
    $db->conn->prepare ( $updateMail )->execute ( [$newPasswordHash , $userEmail] );

    $result =['status'=>'ok'];

} catch ( PDOException $e ) {
  echo json_encode([
    "status" => false,
    "text" => "Parola değiştirilemedi."
  ]);
  exit;
}


  echo json_encode([
    "status" => true,
    "text" => "Yeni parolanız için mail hesabınızı kontrol edin."
  ]);
  exit;
    // e-posta başarılı ile gönderildi
} else {
    // bir sorun var, sorunu ekrana bastıralım
    echo json_encode([
      "status" => false,
      "text" => "Mail gönderilemedi"
    ]);
    exit;
}
