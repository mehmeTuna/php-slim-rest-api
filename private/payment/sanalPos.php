<?php 

$Name= "Mehmet Tuna";//$_POST["CardHolderName"];
$CardNumber= "5282080014525412";//$_POST["CardNumber"];
$CardExpireDateMonth="10" ;//$_POST["CardExpireDateMonth"];
$CardExpireDateYear= "22";//$_POST["CardExpireDateYear"];
$CardCVV2= "300";//$_POST["CardCVV2"];
$Type = "Sale";
$CurrencyCode = "0949"; //TL islemleri için
$MerchantOrderId = "01-eticaret";// Siparis Numarasi
$Amount = "50"; //Islem Tutari // örnegin 1.00TL için 100 kati yani 100 yazilmali
$CustomerId = "125412"; //Müsteri Numarasi

$MerchantId = "44349"; //Magaza Kodu
$OkUrl = "https://www.zekiustakebap.com/tuna.php?m=true"; //Basarili sonuç alinirsa, yönledirelecek sayfa
$FailUrl ="https://www.zekiustakebap.com/tuna.php?m=false";//Basarisiz sonuç alinirsa, yönledirelecek sayfa
$UserName="api"; // Web Yönetim ekranalrindan olusturulan api rollü kullanici
$Password="21211986";// Web Yönetim ekranalrindan olusturulan api rollü kullanici sifresi
$HashedPassword = base64_encode(sha1($Password,"ISO-8859-9")); //md5($Password);
$HashData=base64_encode(sha1($MerchantId.$MerchantOrderId.$Amount.$OkUrl.$FailUrl.$UserName.$HashedPassword , "ISO-8859-9"));
$TransactionSecurity=3;


$xml= '<KuveytTurkVPosMessage xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">'
.'<APIVersion>1.0.0</APIVersion>'
.'<OkUrl>'.$OkUrl.'</OkUrl>'
.'<FailUrl>'.$FailUrl.'</FailUrl>'
.'<HashData>'.$HashData.'</HashData>'
.'<MerchantId>'.$MerchantId.'</MerchantId>'
.'<CustomerId>'.$CustomerId.'</CustomerId>'
.'<UserName>'.$UserName.'</UserName>'
.'<CardNumber>'.$CardNumber.'</CardNumber>'
.'<CardExpireDateYear>'.$CardExpireDateYear.'</CardExpireDateYear>'
.'<CardExpireDateMonth>'.$CardExpireDateMonth.'</CardExpireDateMonth>'
.'<CardCVV2>'.$CardCVV2.'</CardCVV2>'
.'<CardHolderName>'.$Name.'</CardHolderName>'
.'<CardType>MasterCard</CardType>'
.'<BatchID>0</BatchID>'
.'<TransactionType>'.$Type.'</TransactionType>'
.'<InstallmentCount>0</InstallmentCount>'
.'<Amount>'.$Amount.'</Amount>'
.'<DisplayAmount>'.$Amount.'</DisplayAmount>'
.'<CurrencyCode>'.$CurrencyCode.'</CurrencyCode>'
.'<MerchantOrderId>'.$MerchantOrderId.'</MerchantOrderId>'
.'<TransactionSecurity>3</TransactionSecurity>'
.'<TransactionSide>Sale</TransactionSide>' 
.'</KuveytTurkVPosMessage>';

try {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/xml', 'Content-length: '. strlen($xml)) );
    curl_setopt($ch, CURLOPT_POST, true); //POST Metodu kullanarak verileri gönder
    curl_setopt($ch, CURLOPT_HEADER, false); //Serverdan gelen Header bilgilerini önemseme.
    curl_setopt($ch, CURLOPT_URL,'https://boa.kuveytturk.com.tr/sanalposservice/Home/ThreeDModelPayGate'); //Baglanacagi URL
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //Transfer sonuçlarini al.
    $data = curl_exec($ch);
    curl_close($ch);
  }
  catch (Exception $e) {
    echo 'Caught exception: ', $e->getMessage(), "\n";
  }


  echo($data);
  error_reporting(E_ALL);
  ini_set("display_errors", 1);