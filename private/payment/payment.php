<?php

session_start();


require __DIR__.'/../orders/OrdersDb.php';

use Order\Add\Db\Add ;

class Payment{
    public $control = [] ;
    private $method= 0 ;
    private $userId ;
    private $product ;
    private $cardTotal ;

    public function __construct()
    {

        if( !isset($_SESSION) && !isset($_SESSION['user']) ) $this->control["user"] = false;  

        if( isset($_SESSION['user']['username']) ){
            $this->userId = $_SESSION['user']['username'];
        }else{
            $this->control["username"] = false;
        }

        if( count($_SESSION['user']['product']) > 0  ){

            $this->product = json_encode( $_SESSION['user']['product'] , JSON_UNESCAPED_UNICODE );

        }else {
            $this->control["product"] = false;
        }

        if( isset($_SESSION['user']['cardTotal']) ){
            $this->cardTotal = $_SESSION['user']['cardTotal'];
        }else {
            $this->control["cardTotal"] = false;
        }
    }

    //odeme yontemi tipi 
    //0 = kapida odeme
    //1= kartla kapida odeme
    //2 = kredi karti ile odeme
    public function method($method = 0, $data = []){

        if($method == ""){
            $this->control["method"] = false ;
            return ;
        }

        if($method == 2){

            $Name = '';
            $CardNumber = '';
            $CardExpireDateMonth = '';
            $CardCVV2 = '';
    
            if(issset($data['name'])){
                $name = $data['name'];
            }else return ;
    
            if(isset($data['cardNumber']))
                $CardNumber = $data['cardNumber'];
            else return ;
    
            if(isset($data['month']))
                $CardExpireDateMonth = $data['Month'];
            else return ;
    
            if(isset($data['year']))
                $CardExpireDateYear = $data['Year'];
            else return ;
    
            if(isset($data['cvv']))
                $CardCVV2 = $data['cvv'];
            else return ;
            //$Name= "Mehmet Tuna";//$_POST["CardHolderName"];
            //$CardNumber= "5282080014525412";//$_POST["CardNumber"];
            //$CardExpireDateMonth="10" ;//$_POST["CardExpireDateMonth"];
            //$CardExpireDateYear= "22";//$_POST["CardExpireDateYear"];
            //$CardCVV2= "300";//$_POST["CardCVV2"];
            $Type = "Sale";
            $CurrencyCode = "0949"; //TL islemleri için
            $MerchantOrderId = "01-eticaret";// Siparis Numarasi
            $Amount = $_SESSION['user']['cardTotal'] * 100; //Islem Tutari // örnegin 1.00TL için 100 kati yani 100 yazilmali
            $CustomerId = $_SESSION['user']['username']; //Müsteri Numarasi

            $MerchantId = "44349"; //Magaza Kodu
            $OkUrl = "https://www.zekiustakebap.com/private/payment/sanalPos.php"; //Basarili sonuç alinirsa, yönledirelecek sayfa
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
            exit ;
            //bu kısımda  kredı kartı ıle odeme kısmına yonlendır ok donerse bu kısımda sıparısı onayla
        }

        if($method == 0 || $method == 1 ){
             $this->method = $method ;
             return ;
        }else $this->control["method"] = false  ;
    }

    public function Control (){
        if(  $this->control == [] ){
            return true ;
        }else{
            return $this->control;
        }
    }

    public function run($icerik,$adress= "adress"){
        if($adress == "" ){
            $this->control["adress"] = false;
        }

        $addAdress = "adress";
        if($adress == "adress"){
            $addAdress = "adress";
        }else if($adress == "adress_2"){
            $addAdress = "adress_2";
        }else if($adress == "adress_3"){
            $addAdress= "adress_3";
        }

        $response = new Add ();
         $response->Add("order_status", $this->method);
         $response->Add('user_id' , $this->userId);
         $response->Add('orders' , $this->product );
         $response->Add('order_amount' , $this->cardTotal);
        $response->Add('icerik' , strip_tags($icerik));
        $response->Add("adress",$addAdress);
    
       return $response->run();

    }

    public function __destruct()
    {
        
    }
}


$data = json_decode( file_get_contents("php://input") , true);

$newpayment = new Payment();

if(!isset($data["content"])){
    $data["content"] = "";
}

if(!isset($data["adress"])){
    $data["adress"] = "";
}

if( !isset($data['picked']) ){
    echo "odeme tıpı belırt";
    exit;
}

$newpayment->method($data['picked']);


if($newpayment->Control() !== true ){
    echo json_encode([
        "status" => false ,
        "error" => $newpayment->Control ()
    ] , JSON_UNESCAPED_UNICODE);
    exit ;
}else  echo json_encode ([
    "status" => true ,
    "code" => $newpayment->run($data['content'],$data["adress"] )
], JSON_UNESCAPED_UNICODE);