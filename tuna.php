<?php

$AuthenticationResponse=$_POST["AuthenticationResponse"];
$RequestContent = urldecode($AuthenticationResponse);
$xxml=simplexml_load_string($RequestContent) or die("Error: Cannot create object");


function SimpleXML2ArrayWithCDATASupport($xml)
{   
    $array = (array)$xml;

    if (count($array) === 0) {
        return (string)$xml;
    }

    foreach ($array as $key => $value) {
        if (!is_object($value) || strpos(get_class($value), 'SimpleXML') === false) {
            continue;
        }
        $array[$key] = SimpleXML2ArrayWithCDATASupport($value);
    }

    return $array;
}


$data = SimpleXML2ArrayWithCDATASupport($xxml) ;


$MerchantOrderId = $data['MerchantOrderId'];
$Amount = $data['VPosMessage']['Amount']; //Islem Tutari
$MD = $data['MD'];
$Type = "Sale";
$CurrencyCode = "0949"; //TL islemleri için
$CustomerId = "125412"; //Müsteri Numarasi
$MerchantId = "44349"; //Magaza Kodu
$UserName="api"; // Web Yönetim ekranalrindan olusturulan api rollü kullanici
$Password="21211986";// Web Yönetim ekranalrindan olusturulan api rollü kullanici sifresi
$HashedPassword = base64_encode(sha1($Password,"ISO-8859-9")); //md5($Password);
//$HashData = $data['HashData'];
$HashData = base64_encode(sha1($MerchantId.$MerchantOrderId.$Amount.$UserName.$HashedPassword , "ISO-8859-9"));
$TransactionSecurity=3;
$xml='<KuveytTurkVPosMessage xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
<APIVersion>1.0.0</APIVersion>
<HashData>'.$HashData.'</HashData>
<MerchantId>'.$MerchantId.'</MerchantId>
<CustomerId>'.$CustomerId.'</CustomerId>
<UserName>'.$UserName.'</UserName>
<TransactionType>Sale</TransactionType>
<InstallmentCount>0</InstallmentCount>
<Amount>'.$Amount.'</Amount>
<MerchantOrderId>'.$MerchantOrderId.'</MerchantOrderId>
<TransactionSecurity>3</TransactionSecurity>
<KuveytTurkVPosAdditionalData>
<AdditionalData>
<Key>MD</Key>
<Data>'.$MD.'</Data>
</AdditionalData>
</KuveytTurkVPosAdditionalData>
</KuveytTurkVPosMessage>';

echo "\n";

try {
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/xml', 'Content-length: '. strlen($xml)) );
curl_setopt($ch, CURLOPT_POST, true); //POST Metodu kullanarak verileri gönder
curl_setopt($ch, CURLOPT_HEADER, false); //Serverdan gelen Header bilgilerini önemseme.
curl_setopt($ch,CURLOPT_URL,'https://boa.kuveytturk.com.tr/sanalposservice/Home/ThreeDModelProvisionGate'); //Baglanacagi URL
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