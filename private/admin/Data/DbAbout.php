<?php
namespace Admin;
date_default_timezone_set('Europe/Istanbul');

require_once __DIR__ .'/../../../database/connect.php';

require_once __DIR__ . '/../product/create.php';


//trait
require_once __DIR__ . '/Config.php';


use DATABASE\Database ;
use PDO;
use Admin\Product ;

class Data{

    use \Config;

    public $db ;

    public function __construct()
    {
      $this->db = new Database();
      $this->db = $this->db->conn ;
    }



    //all user count
    public function getAllUser(){
        $add= "select count(*) from {$this->UserTable}" ;
        $data['count'] = [] ;

        try{
         $query = $this->db->query( $add ,  PDO::FETCH_ASSOC);

         if($query->rowCount()){
             foreach ($query as $value) {
                $data['count'] = $value['count(*)'];
             }

             return json_encode($data , JSON_UNESCAPED_UNICODE);
         }
      }catch(PDOException $e){
          return array(
              'status'=>$e
          ) ;
      }
    }

    //get this month user
    public function getThisMontUser($month){
        if(!(is_numeric($month) && $month >=1  &&  $month <=12))
            return json_encode(['status'=>'erorr','type'=>'gecerli tarih giriniz'] , JSON_UNESCAPED_UNICODE);

        $thismonth = mktime(0,0,0,$month,1,date('Y'));

        $nowdate = time();
        $data['count'] = [] ;

        $add= "select count(*) from {$this->UserTable} where registration_date >= {$thismonth} and registration_date <= {$nowdate}" ;

        try{
         $query = $this->db->query( $add ,  PDO::FETCH_ASSOC);

         if($query->rowCount()){
             foreach ($query as $value) {
                 $data['count'] = $value['count(*)'] ;
             }

             return json_encode($data , JSON_UNESCAPED_UNICODE) ;
         }else return json_encode(['status'=>'not found'] , JSON_UNESCAPED_UNICODE);
      }catch(PDOException $e){
          return array(
              'status'=>$e
          ) ;
      }
    }

    //this year user
    public function getThisYearUser($year){
        if( ! is_numeric($year) )
        return json_encode(['status'=>'erorr','type'=>'gecerli tarih giriniz'] , JSON_UNESCAPED_UNICODE);

        $thisyear = mktime(0,0,0,1,1,$year);
        $nowdate = time();

        $data['count'] = [] ;

        $add= "select count(*) from {$this->UserTable} where registration_date >= {$thisyear} and registration_date <= {$nowdate}" ;

        try{
         $query = $this->db->query( $add ,  PDO::FETCH_ASSOC);

         if($query->rowCount()){
             foreach ($query as $value) {
                 $data['count'] = $value['count(*)'];
             }
             return json_encode($data , JSON_UNESCAPED_UNICODE) ;
         } else return json_encode(['status'=>'not found'] , JSON_UNESCAPED_UNICODE);
      }catch(PDOException $e){
          return array(
              'status'=>$e
          ) ;
      }
    }

        //all rezervasyon count
    public function getAllRezervasyon(){
        $add= "select count(*) from {$this->RezervasyonTable}" ;
        $data['count'] = [] ;

        try{
         $query = $this->db->query( $add ,  PDO::FETCH_ASSOC);

         if($query->rowCount()){
             foreach ($query as $value) {
                 $data['count'] =  $value['count(*)'];
             }
              return json_encode($data , JSON_UNESCAPED_UNICODE) ;
         } else return json_encode(['status'=>'not found'] , JSON_UNESCAPED_UNICODE);
      }catch(PDOException $e){
          return array(
              'status'=>$e
          ) ;
      }
    }

    public function getThisMontRezervasyon($month){
        if(!(is_numeric($month) && $month >=1  &&  $month <=12))
         return json_encode(['status'=>'erorr','type'=>'gecerli tarih giriniz'] , JSON_UNESCAPED_UNICODE);

        $thismonth = mktime(0,0,0,$month,1,date('Y'));
        $nowdate = time();
        $data['count'] = [] ;

        $add= "select count(*) from {$this->RezervasyonTable} where time >= {$thismonth} and time <= {$nowdate}" ;

        try{
         $query = $this->db->query( $add ,  PDO::FETCH_ASSOC);

         if($query->rowCount()){
             foreach ($query as $value) {
                 $data['count'] = $value['count(*)'];
             }
             return json_encode( $data , JSON_UNESCAPED_UNICODE);
         } else return json_encode(['status'=>'not found'] , JSON_UNESCAPED_UNICODE);
      }catch(PDOException $e){
          return array(
              'status'=>$e
          ) ;
      }
    }

    public function getThisYearRezervasyon($year){
        if( ! is_numeric($year) )
        return false ;

        $thisyear = mktime(0,0,0,1,1,$year);
        $nowdate = time();
        $data['count'] = [] ;

        $add= "select count(*) from {$this->RezervasyonTable} where time >= {$thisyear} and time <= {$nowdate}" ;

        try{
         $query = $this->db->query( $add ,  PDO::FETCH_ASSOC);

         if($query->rowCount()){
             foreach ($query as $value) {
                 $data['count'] =  $value['count(*)'];
             }
             return json_encode($data , JSON_UNESCAPED_UNICODE);
         }else return json_encode(['status'=>'not found'] , JSON_UNESCAPED_UNICODE);
      }catch(PDOException $e){
          return array(
              'status'=>$e
          ) ;
      }
    }

    //get all category
    public function getAllCategory(){

        $add= "select * from {$this->category}" ;
        $result = array();

        try{
         $query = $this->db->query( $add ,  PDO::FETCH_ASSOC);

         if($query->rowCount()){
             foreach ($query as $key => $value) {
                 $result[$key] = $value;
             }
             return json_encode($result, JSON_UNESCAPED_UNICODE);
         }else return json_encode(['status'=>'not found'] , JSON_UNESCAPED_UNICODE);
      }catch(PDOException $e){
          return array(
              'status'=>$e
          ) ;
      }
    }


        //gunluk satislar
    public function getThisDayOrder(){
        $createMkTime = mktime(0,1,0 , ltrim(date('m') , 0 ) , ltrim(date('d') , 0 ) , 2019 );

        $add= "select * from {$this->order} where m_date >=". $createMkTime  ;
        $result = array('orderAmount'=>0 , 'count'=>0,'status'=>array(0 => 0 , 1 => 0 , 2 => 0),'orderStatus'=>array());

        try{
         $query = $this->db->query( $add ,  PDO::FETCH_ASSOC);

         if($query->rowCount()){
             foreach ($query as $key => $value) {
                 $result['orderAmount'] += $value['order_amount'] ;
                 $orderData = json_decode( $value['orders'] , true ) ;
                 $result['status'][$value['order_status']] ++ ;

               for($a = 0 ; $a  < count($orderData) ; $a++){
                   $result['count'] += $orderData[$a]['count'] ;
               }
             }
             return json_encode($result, JSON_UNESCAPED_UNICODE);
         }else return json_encode(['status'=>'not found'] , JSON_UNESCAPED_UNICODE);
      }catch(PDOException $e){
          return array(
              'status'=>$e
          ) ;
      }
    }


     //aylik satislar
    public function getThisMonthOrder(){
        $createMkTime = mktime(0,1,0 , ltrim(date('m') , 0 ) , 1 , 2019 );

        $add= "select * from {$this->order} where m_date >=". $createMkTime  ;
        $result = array('orderAmount'=>0 , 'count'=>0,'status'=>array(0 => 0 , 1 => 0 , 2 => 0),'orderStatus'=>array());

        try{
         $query = $this->db->query( $add ,  PDO::FETCH_ASSOC);

         if($query->rowCount()){
             foreach ($query as $key => $value) {
                 $result['orderAmount'] += $value['order_amount'] ;
                 $orderData = json_decode( $value['orders'] , true ) ;
                 $result['status'][$value['order_status']] ++ ;

               for($a = 0 ; $a  < count($orderData) ; $a++){
                   $result['count'] += $orderData[$a]['count'] ;
               }
             }
             return json_encode($result, JSON_UNESCAPED_UNICODE);
         }else return json_encode(['status'=>'not found'] , JSON_UNESCAPED_UNICODE);
      }catch(PDOException $e){
          return array(
              'status'=>$e
          ) ;
      }
    }


         //gunluk kredili ve nakit satis miktarlari
    public function getThisDayPayment(){
        $createMkTime = mktime(0,1,0 , ltrim(date('m') , 0 ) ,  ltrim(date('d'))  , 2019 );

        $add= "select * from {$this->order} where m_date >=". $createMkTime  ;
        $result = array('kapidaNakit'=>0 , 'kapidaKartla'=>0 , 'krediKarti'=>0);

        try{
         $query = $this->db->query( $add ,  PDO::FETCH_ASSOC);

         if($query->rowCount()){
             foreach ($query as $key => $value) {
                 //0 = kapida odeme
                //1= kartla kapida odeme
                //2 = kredi karti ile odeme
                if($value['order_status'] == 0)
                  $result['kapidaNakit'] ++  ;
                else if($value['order_status'] == 1)
                  $result['kapidaKartla'] ++ ;
                else if($value['order_status'] == 2)
                 $result['krediKarti'] ++ ;

             }
             return json_encode($result, JSON_UNESCAPED_UNICODE);
         }else return json_encode(['status'=>'not found'] , JSON_UNESCAPED_UNICODE);
      }catch(PDOException $e){
          return array(
              'status'=>$e
          ) ;
      }
    }



             //gunluk kredili ve nakit satis miktarlari
    public function getThisMonthPayment(){
        $createMkTime = mktime(0,1,0 , ltrim(date('m') , 0 ) ,  1 , 2019 );

        $add= "select * from {$this->order} where m_date >=". $createMkTime  ;
        $result = array('kapidaNakit'=>0 , 'kapidaKartla'=>0 , 'krediKarti'=>0);

        try{
         $query = $this->db->query( $add ,  PDO::FETCH_ASSOC);

         if($query->rowCount()){
             foreach ($query as $key => $value) {
                 //0 = kapida odeme
                //1= kartla kapida odeme
                //2 = kredi karti ile odeme
                if($value['order_status'] == 0)
                  $result['kapidaNakit'] ++  ;
                else if($value['order_status'] == 1)
                  $result['kapidaKartla'] ++ ;
                else if($value['order_status'] == 2)
                 $result['krediKarti'] ++ ;

             }
             return json_encode($result, JSON_UNESCAPED_UNICODE);
         }else return json_encode(['status'=>'not found'] , JSON_UNESCAPED_UNICODE);
      }catch(PDOException $e){
          return array(
              'status'=>$e
          ) ;
      }
    }


        //gunluk iptal olan siparisler
    public function thisDayiptalOrder(){
        $createMkTime = mktime(0,1,0 , ltrim(date('m') , 0 ) ,  ltrim(date('d'))  , 2019 );

        $add= "select count(*) from {$this->order} where m_date >=". $createMkTime  . ' and  m_status=2' ;
        $result = array('iptalCount'=>0 );

        try{
         $query = $this->db->query( $add ,  PDO::FETCH_ASSOC);

         if($query->rowCount()){
             foreach ($query as $key => $value) {
                    $result['iptalCount'] = $value['count(*)']  ;
             }
             return json_encode($result, JSON_UNESCAPED_UNICODE);
         }else return json_encode(['status'=>'not found'] , JSON_UNESCAPED_UNICODE);
      }catch(PDOException $e){
          return array(
              'status'=>$e
          ) ;
      }
    }



            //aylik iptal olan siparisler
    public function thisMonthiptalOrder(){
        $createMkTime = mktime(0,1,0 , ltrim(date('m') , 0 ) ,  1  , 2019 );

        $add= "select count(*) from {$this->order} where m_date >=". $createMkTime  . ' and  m_status=2' ;
        $result = array('iptalCount'=>0 );

        try{
         $query = $this->db->query( $add ,  PDO::FETCH_ASSOC);

         if($query->rowCount()){
             foreach ($query as $key => $value) {
                    $result['iptalCount'] = $value['count(*)']  ;
             }
             return json_encode($result, JSON_UNESCAPED_UNICODE);
         }else return json_encode(['status'=>'not found'] , JSON_UNESCAPED_UNICODE);
      }catch(PDOException $e){
          return array(
              'status'=>$e
          ) ;
      }
    }


        //gunluk toplam satis
    public function thisDaymany(){
        $createMkTime = mktime(0,1,0 , ltrim(date('m') , 0 ) , ltrim(date('d'))   , 2019 );

        $add= "select sum(order_amount) as toplam from {$this->order} where m_date >=". $createMkTime   ;
        $result = array('toplam'=>0 );

        try{
         $query = $this->db->query( $add ,  PDO::FETCH_ASSOC);

         if($query->rowCount()){
             foreach ($query as $key => $value) {
                    $result['toplam'] = $value['toplam']  ;
             }
             return json_encode($result, JSON_UNESCAPED_UNICODE);
         }else return json_encode(['status'=>'not found'] , JSON_UNESCAPED_UNICODE);
      }catch(PDOException $e){
          return array(
              'status'=>$e
          ) ;
      }
    }


    //aylik toplam satis miktari
    public function thisMonthmany(){
        $createMkTime = mktime(0,1,0 , ltrim(date('m') , 0 ) , 1   , 2019 );

        $add= "select sum(order_amount) as toplam from {$this->order} where m_date >=". $createMkTime   ;
        $result = array('toplam'=>0 );

        try{
         $query = $this->db->query( $add ,  PDO::FETCH_ASSOC);

         if($query->rowCount()){
             foreach ($query as $key => $value) {
                    $result['toplam'] = $value['toplam']  ;
             }
             return json_encode($result, JSON_UNESCAPED_UNICODE);
         }else return json_encode(['status'=>'not found'] , JSON_UNESCAPED_UNICODE);
      }catch(PDOException $e){
          return array(
              'status'=>$e
          ) ;
      }
    }

    public function getCategory($id){
      if( !is_numeric($id) )
        return false ;

        $sql = "select name from {$this->category}";
        $status = [] ;

         try{
           $result = $this->db->query( $sql , PDO::FETCH_ASSOC);
           if( !$result->rowCount() )
             return json_encode(['status'=>'not found'] , JSON_UNESCAPED_UNICODE);

              foreach ($result as $key => $value) {
                return $value['name'] ;
             }
         }catch(PDOException $e){
           return ['status'=>'not found'];
         }
    }

    public function thisAllProduct(){
      $sql = "select * from {$this->product}";
      $status = [] ;

       try{
         $result = $this->db->query( $sql , PDO::FETCH_ASSOC);
         if( !$result->rowCount() )
           return json_encode(['status'=>'not found'] , JSON_UNESCAPED_UNICODE);

            foreach ($result as $key => $value) {
             array_push($status ,
             [
               'name'=>$value['name'],
               'price'=>$value['price'],
               'numberOfProduct'=>$value['numberOfProduct'],
               'categoryName'=>$this->getCategory($value['categoryId']) ,
               'live'=>$value['live'],
               'cardText'=>$value['card_text'] ,
               'stores' => $value['stores']
             ]
           );
           }

           return json_encode( $status , JSON_UNESCAPED_UNICODE);
       }catch(PDOException $e){
         return json_encode( ['status'=>'not found'], JSON_UNESCAPED_UNICODE);
       }

    }

    public function newProduct($data){
      if($data == null )
        return json_encode('data yok');

        $item = new Create();
        $item->add($data);

        return $item->run();


    }

    public function allKurye(){
      $sql = "select * from {$this->kurye}";
      $status = [] ;

       try{
         $result = $this->db->query( $sql , PDO::FETCH_ASSOC);
         if( !$result->rowCount() )
           return json_encode(['status'=>'not found'] , JSON_UNESCAPED_UNICODE);

            foreach ($result as $key => $value) {
             array_push($status ,
             [
               'surname'=>$value['surname'],
               'lastname'=>$value['lastname'],
               'date'=>$value['date'],
               'username'=>$value['username'] ,
            ]
           );
           }

           return json_encode( $status , JSON_UNESCAPED_UNICODE);
       }catch(PDOException $e){
         return json_encode( ['status'=>'not found'] , JSON_UNESCAPED_UNICODE);
       }
    }


    public function newKurye(){
      
    }



    public function __destruct()
    {

    }
}
