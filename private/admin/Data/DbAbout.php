<?php

namespace Admin;
date_default_timezone_set ( 'Europe/Istanbul' );

require_once __DIR__ . '/../../../database/connect.php';

require_once __DIR__ . '/../product/create.php';

require_once __DIR__ . '/../../Ip/Ip.php';
require_once __DIR__ . '/../../time/timestamp.php';

require_once __DIR__. "/img.php";

use formattimestamp\Ttime;
use Ip\ip ;
use img\SimpleImage;


//trait
require_once __DIR__ . '/Config.php';


use DATABASE\Database;
use PDO;
use Admin\Product\Create;
use PDOException;

class Data
{

    use \Config;

    public $db;


    public
    function __construct ()
    {
        $this->db = new Database();
        $this->db = $this->db->conn;
    }

    //return this day clock 00.00
    //format timestamp
    public function getTimeDayStartTime(){
        return mktime ( 0 , 0 , 0 , ltrim ( date ( 'm' ) , 0 ) , ltrim ( date ( 'd' ) , 0 ) , date ( 'Y' ) );
    }

    //return this week clock 00.00
    //format timestamp
    public function getTimeWeektartTime(){
        return mktime ( 0 , 0 , 0 , ltrim ( date ( 'm' ) , 0 ) , date ( 'd' ,strtotime("-".(date('N')-1)." days") ) ,date ( 'Y' ) );
    }

    //return this month clock 00.00
    //format timestamp
    public function getTimeMonthThisTime(){
        return mktime ( 0 , 0 , 0 , ltrim ( date ( 'm' ) , 0 ) , 1 , date ( 'Y' ) );
    }

    //return this year clock 00.00
    //format timestamp
    public function getTimeYearThisTime(){
        return mktime ( 0 , 0 , 0 , 1, 1 , date ( 'Y' ) );
    }


    //all user count
    public
    function getAllUser ()
    {
        $add = "select count(*) from {$this->UserTable}";
        $data[ 'count' ] = [];

        try {
            $query = $this->db->query ( $add , PDO::FETCH_ASSOC );

            if ( $query->rowCount () ) {
                foreach ( $query as $value ) {
                    $data[ 'count' ] = $value[ 'count(*)' ];
                }

                return json_encode ( $data , JSON_UNESCAPED_UNICODE );
            }
        } catch ( PDOException $e ) {
            return array (
                'status' => $e
            );
        }
    }

    //get this month user
    public
    function getThisMontUser ( $month )
    {
        if ( !( is_numeric ( $month ) && $month >= 1 && $month <= 12 ) )
            return json_encode ( [ 'status' => 'erorr' , 'type' => 'gecerli tarih giriniz' ] , JSON_UNESCAPED_UNICODE );

        $thismonth = mktime ( 0 , 0 , 0 , $month , 1 , date ( 'Y' ) );

        $nowdate = time ();
        $data[ 'count' ] = [];

        $add = "select count(*) from {$this->UserTable} where registration_date >= {$thismonth} and registration_date <= {$nowdate}";

        try {
            $query = $this->db->query ( $add , PDO::FETCH_ASSOC );

            if ( $query->rowCount () ) {
                foreach ( $query as $value ) {
                    $data[ 'count' ] = $value[ 'count(*)' ];
                }

                return json_encode ( $data , JSON_UNESCAPED_UNICODE );
            } else return json_encode ( [ 'status' => 'not found' ] , JSON_UNESCAPED_UNICODE );
        } catch ( PDOException $e ) {
            return array (
                'status' => $e
            );
        }
    }

    //this year user
    public
    function getThisYearUser ( $year )
    {
        if ( !is_numeric ( $year ) )
            return json_encode ( [ 'status' => 'erorr' , 'type' => 'gecerli tarih giriniz' ] , JSON_UNESCAPED_UNICODE );

        $thisyear = mktime ( 0 , 0 , 0 , 1 , 1 , $year );
        $nowdate = time ();

        $data[ 'count' ] = [];

        $add = "select count(*) from {$this->UserTable} where registration_date >= {$thisyear} and registration_date <= {$nowdate}";

        try {
            $query = $this->db->query ( $add , PDO::FETCH_ASSOC );

            if ( $query->rowCount () ) {
                foreach ( $query as $value ) {
                    $data[ 'count' ] = $value[ 'count(*)' ];
                }
                return json_encode ( $data , JSON_UNESCAPED_UNICODE );
            } else return json_encode ( [ 'status' => 'not found' ] , JSON_UNESCAPED_UNICODE );
        } catch ( PDOException $e ) {
            return array (
                'status' => $e
            );
        }
    }


    /**
     * @param $month
     * @return array|false|string
     */
    public
    function getmonthorder ( $month )
    {
        $thisyear = date ( 'Y' );


        if ( !( $month >= 0 && $month <= 12 ) )
            return json_encode ( [ 'status' => 'gecerli parametre giriniz' ] , JSON_UNESCAPED_UNICODE );

        $createMkTime = mktime ( 0 , 0, 0 , $month , 1 , $thisyear );

        if($month == 12)
          $endcreateMkTime = mktime ( 0 , 0, 0 , $month , 31 , $thisyear );
        else
          $endcreateMkTime = mktime ( 0 , 0, 0 , $month+1 , -1 , $thisyear );

        $add = "select * from {$this->order} where m_status=5 and m_date >='{$createMkTime}' and m_date<='{$endcreateMkTime}'" ;
        $result = array ( 'orderAmount' => 0 , 'count' => 0 , 'status' => array ( 0 => 0 , 1 => 0 , 2 => 0 ) , 'orderStatus' => array () );

        try {
            $query = $this->db->query ( $add , PDO::FETCH_ASSOC );

            if ( $query->rowCount () ) {
                foreach ( $query as $key => $value ) {
                    $result[ 'orderAmount' ] += $value[ 'order_amount' ];
                    $orderData = json_decode ( $value[ 'orders' ] , true );
                    $result[ 'status' ][ $value[ 'order_status' ] ] ++;

                    for ( $a = 0 ; $a < count ( $orderData ) ; $a ++ ) {
                        $result[ 'count' ] += $orderData[ $a ][ 'count' ];
                    }
                }
                return json_encode ( $result , JSON_UNESCAPED_UNICODE );
            } else return json_encode ( [ 'status' => 'not found' ] , JSON_UNESCAPED_UNICODE );
        } catch ( PDOException $e ) {
            return array (
                'status' => $e
            );
        }
    }


    //all rezervasyon count
    public
    function getAllRezervasyon ()
    {
        $add = "select count(*) from {$this->RezervasyonTable}";
        $data[ 'count' ] = [];

        try {
            $query = $this->db->query ( $add , PDO::FETCH_ASSOC );

            if ( $query->rowCount () ) {
                foreach ( $query as $value ) {
                    $data[ 'count' ] = $value[ 'count(*)' ];
                }
                return json_encode ( $data , JSON_UNESCAPED_UNICODE );
            } else return json_encode ( [ 'status' => 'not found' ] , JSON_UNESCAPED_UNICODE );
        } catch ( PDOException $e ) {
            return array (
                'status' => $e
            );
        }
    }

    public
    function getThisMontRezervasyon ( $month )
    {
        if ( !( is_numeric ( $month ) && $month >= 1 && $month <= 12 ) )
            return json_encode ( [ 'status' => 'error' , 'type' => 'gecerli tarih giriniz' ] , JSON_UNESCAPED_UNICODE );

        $thismonth = mktime ( 0 , 0 , 0 , $month , 1 , date ( 'Y' ) );
        $nowdate = time ();
        $data[ 'count' ] = [];

        $add = "select count(*) from {$this->RezervasyonTable} where time >= {$thismonth} and time <= {$nowdate}";

        try {
            $query = $this->db->query ( $add , PDO::FETCH_ASSOC );

            if ( $query->rowCount () ) {
                foreach ( $query as $value ) {
                    $data[ 'count' ] = $value[ 'count(*)' ];
                }
                return json_encode ( $data , JSON_UNESCAPED_UNICODE );
            } else return json_encode ( [ 'status' => 'not found' ] , JSON_UNESCAPED_UNICODE );
        } catch ( PDOException $e ) {
            return array (
                'status' => $e
            );
        }
    }

    public
    function getThisYearRezervasyon ( $year )
    {
        if ( !is_numeric ( $year ) )
            return false;

        $thisyear = mktime ( 0 , 0 , 0 , 1 , 1 , $year );
        $nowdate = time ();
        $data[ 'count' ] = [];

        $add = "select count(*) from {$this->RezervasyonTable} where time >= {$thisyear} and time <= {$nowdate}";

        try {
            $query = $this->db->query ( $add , PDO::FETCH_ASSOC );

            if ( $query->rowCount () ) {
                foreach ( $query as $value ) {
                    $data[ 'count' ] = $value[ 'count(*)' ];
                }
                return json_encode ( $data , JSON_UNESCAPED_UNICODE );
            } else return json_encode ( [ 'status' => 'not found' ] , JSON_UNESCAPED_UNICODE );
        } catch ( PDOException $e ) {
            return array (
                'status' => $e
            );
        }
    }

    //get all category
    public
    function getAllCategory ()
    {

        $add = "select * from {$this->category}";
        $result = array ();
        $url = $_SERVER["REQUEST_SCHEME"] ."://". $_SERVER["HTTP_HOST"] ."/" ;

        try {
            $query = $this->db->query ( $add , PDO::FETCH_ASSOC );

            if ( $query->rowCount () ) {
                foreach ( $query as $key => $value ) {
                  
                    if( isset( $value["img"] ))
                     $value["img"] =  $value["img"];
        
                    $result[ $key ] = $value;
                }
                return json_encode ( $result , JSON_UNESCAPED_UNICODE );
            } else return json_encode ( [ 'status' => 'not found' ] , JSON_UNESCAPED_UNICODE );
        } catch ( PDOException $e ) {
            return array (
                'status' => $e
            );
        }
    }


    //gunluk satislar
    public
    function getThisDayOrder ()
    {
        $createMkTime = $this->getTimeDayStartTime();

        $add = "select * from {$this->order} where m_status=5 and m_date >=" . $createMkTime;
        $result = array ( 'orderAmount' => 0 , 'count' => 0 , 'status' => array ( 0 => 0 , 1 => 0 , 2 => 0 ) , 'orderStatus' => array () );

        try {
            $query = $this->db->query ( $add , PDO::FETCH_ASSOC );

            if ( $query->rowCount () ) {
                foreach ( $query as $key => $value ) {
                    $result[ 'orderAmount' ] += $value[ 'order_amount' ];
                    $orderData = json_decode ( $value[ 'orders' ] , true );
                    $result[ 'status' ][ $value[ 'order_status' ] ] ++;

                    for ( $a = 0 ; $a < count ( $orderData ) ; $a ++ ) {
                        $result[ 'count' ] += $orderData[ $a ][ 'count' ];
                    }
                }
                return json_encode ( $result , JSON_UNESCAPED_UNICODE );
            } else return json_encode ( [ 'status' => 'not found' ] , JSON_UNESCAPED_UNICODE );
        } catch ( PDOException $e ) {
            return array (
                'status' => $e
            );
        }
    }


    //aylik satislar
    public
    function getThisMonthOrder ()
    {
        $createMkTime = $this->getTimeMonthThisTime();

        $add = "select * from {$this->order} where m_status=5 and m_date >=" . $createMkTime;
        $result = array ( 'orderAmount' => 0 , 'count' => 0 , 'status' => array ( 0 => 0 , 1 => 0 , 2 => 0 ) , 'orderStatus' => array () );

        try {
            $query = $this->db->query ( $add , PDO::FETCH_ASSOC );

            if ( $query->rowCount () ) {
                foreach ( $query as $key => $value ) {
                    $result[ 'orderAmount' ] += $value[ 'order_amount' ];
                    $orderData = json_decode ( $value[ 'orders' ] , true );
                    $result[ 'status' ][ $value[ 'order_status' ] ] ++;

                    for ( $a = 0 ; $a < count ( $orderData ) ; $a ++ ) {
                        $result[ 'count' ] += $orderData[ $a ][ 'count' ];
                    }
                }
                return json_encode ( $result , JSON_UNESCAPED_UNICODE );
            } else return json_encode ( [ 'status' => 'not found' ] , JSON_UNESCAPED_UNICODE );
        } catch ( PDOException $e ) {
            return array (
                'status' => $e
            );
        }
    }


    //gunluk kredili ve nakit satis miktarlari
    public
    function getThisDayPayment ()
    {
        $createMkTime = $this->getTimeDayStartTime();

        $add = "select * from {$this->order} where m_status=5 and m_date >=" . $createMkTime;
        $result = array ( 'kapidaNakit' => 0 , 'kapidaKartla' => 0 , 'krediKarti' => 0 );

        try {
            $query = $this->db->query ( $add , PDO::FETCH_ASSOC );

            if ( $query->rowCount () ) {
                foreach ( $query as $key => $value ) {
                    //0 = kapida odeme
                    //1= kartla kapida odeme
                    //2 = kredi karti ile odeme
                    if ( $value[ 'order_status' ] == 0 )
                        $result[ 'kapidaNakit' ] ++;
                    else if ( $value[ 'order_status' ] == 1 )
                        $result[ 'kapidaKartla' ] ++;
                    else if ( $value[ 'order_status' ] == 2 )
                        $result[ 'krediKarti' ] ++;

                }
                return json_encode ( $result , JSON_UNESCAPED_UNICODE );
            } else return json_encode ( [ 'status' => 'not found' ] , JSON_UNESCAPED_UNICODE );
        } catch ( PDOException $e ) {
            return array (
                'status' => $e
            );
        }
    }


    //gunluk kredili ve nakit satis miktarlari
    public
    function getThisMonthPayment ()
    {
        $createMkTime = $this->getTimeDayStartTime();

        $add = "select * from {$this->order} where m_status=5 and m_date >=" . $createMkTime;
        $result = array ( 'kapidaNakit' => 0 , 'kapidaKartla' => 0 , 'krediKarti' => 0 );

        try {
            $query = $this->db->query ( $add , PDO::FETCH_ASSOC );

            if ( $query->rowCount () ) {
                foreach ( $query as $key => $value ) {
                    //0 = kapida odeme
                    //1= kartla kapida odeme
                    //2 = kredi karti ile odeme
                    if ( $value[ 'order_status' ] == 0 )
                        $result[ 'kapidaNakit' ] ++;
                    else if ( $value[ 'order_status' ] == 1 )
                        $result[ 'kapidaKartla' ] ++;
                    else if ( $value[ 'order_status' ] == 2 )
                        $result[ 'krediKarti' ] ++;

                }
                return json_encode ( $result , JSON_UNESCAPED_UNICODE );
            } else return json_encode ( [ 'status' => 'not found' ] , JSON_UNESCAPED_UNICODE );
        } catch ( PDOException $e ) {
            return array (
                'status' => $e
            );
        }
    }


    //gunluk iptal olan siparisler
    public
    function thisDayiptalOrder ()
    {

        $createMkTime = $this->getTimeDayStartTime();

        $add = "select count(*) from {$this->order} where m_date >=" . $createMkTime . ' and  m_status=2';
        $result = array ( 'iptalCount' => 0 );

        try {
            $query = $this->db->query ( $add , PDO::FETCH_ASSOC );

            if ( $query->rowCount () ) {
                foreach ( $query as $key => $value ) {
                    $result[ 'iptalCount' ] = $value[ 'count(*)' ];
                }
                return json_encode ( $result , JSON_UNESCAPED_UNICODE );
            } else return json_encode ( [ 'status' => 'not found' ] , JSON_UNESCAPED_UNICODE );
        } catch ( PDOException $e ) {
            return array (
                'status' => $e
            );
        }
    }


    //aylik iptal olan siparisler
    public
    function thisMonthiptalOrder ()
    {
        $createMkTime = $this->getTimeMonthThisTime();

        $add = "select count(*) from {$this->order} where m_date >=" . $createMkTime . ' and  m_status=2';
        $result = array ( 'iptalCount' => 0 );

        try {
            $query = $this->db->query ( $add , PDO::FETCH_ASSOC );

            if ( $query->rowCount () ) {
                foreach ( $query as $key => $value ) {
                    $result[ 'iptalCount' ] = $value[ 'count(*)' ];
                }
                return json_encode ( $result , JSON_UNESCAPED_UNICODE );
            } else return json_encode ( [ 'status' => 'not found' ] , JSON_UNESCAPED_UNICODE );
        } catch ( PDOException $e ) {
            return array (
                'status' => $e
            );
        }
    }


    //gunluk toplam satis
    public
    function thisDaymany ()
    {
        $createMkTime =  $this->getTimeDayStartTime();

        $add = "select sum(order_amount) as toplam from {$this->order} where m_status=5 and m_date >=" . $createMkTime;
        $result = array ( 'toplam' => 0 );

        try {
            $query = $this->db->query ( $add , PDO::FETCH_ASSOC );

            if ( $query->rowCount () ) {
                foreach ( $query as $key => $value ) {
                    $result[ 'toplam' ] = $value[ 'toplam' ];
                }
                return json_encode ( $result , JSON_UNESCAPED_UNICODE );
            } else return json_encode ( [ 'status' => 'not found' ] , JSON_UNESCAPED_UNICODE );
        } catch ( PDOException $e ) {
            return array (
                'status' => $e
            );
        }
    }


    //aylik toplam satis miktari
    public
    function thisMonthmany ()
    {
        $createMkTime =  $this->getTimeMonthThisTime();

        $add = "select sum(order_amount) as toplam from {$this->order} where m_status=5 and m_date >=" . $createMkTime;
        $result = array ( 'toplam' => 0 );

        try {
            $query = $this->db->query ( $add , PDO::FETCH_ASSOC );

            if ( $query->rowCount () ) {
                foreach ( $query as $key => $value ) {
                    $result[ 'toplam' ] = $value[ 'toplam' ];
                }
                return json_encode ( $result , JSON_UNESCAPED_UNICODE );
            } else return json_encode ( [ 'status' => 'not found' ] , JSON_UNESCAPED_UNICODE );
        } catch ( PDOException $e ) {
            return array (
                'status' => $e
            );
        }
    }

    //rezervasyon sayisi
    //gunluk rezervasyon detaylari
    public
    function rezervasyonThisCount ( $opt )
    {
        if ( $opt == 'day' )
            $createMkTime =  $this->getTimeDayStartTime();
        if ( $opt == 'month' )
            $createMkTime = $this->getTimeMonthThisTime();
        if ( $opt == 'year' )
            $createMkTime = $this->getTimeYearThisTime();

        $add = "select  count(*) as toplam   from {$this->RezervasyonTable} where time >=" . $createMkTime;


        try {
            $query = $this->db->query ( $add , PDO::FETCH_ASSOC );

            if ( $query->rowCount () ) {
                foreach ( $query as $key => $value ) {
                    return $value[ 'toplam' ];
                }
            } else return false;
        } catch ( PDOException $e ) {
            return false;
        }
    }

    //gunluk rezervasyon detaylari
    public
    function rezervasyonThisDay ()
    {

        $createMkTime = $this->getTimeDayStartTime();

        $add = "select  m_status,kisi_sayisi  from {$this->RezervasyonTable} where time >=" . $createMkTime;
        $result = array ( 'toplam' => $this->rezervasyonThisCount ( 'day' ) , 'wait' => 0 , 'ok' => 0 , 'red' => 0 , 'usercount' => 0 );


        try {
            $query = $this->db->query ( $add , PDO::FETCH_ASSOC );

            if ( $query->rowCount () ) {
                foreach ( $query as $key => $value ) {

                    if ( $value[ 'm_status' ] == '0' )
                        $result[ 'wait' ] = $result[ 'wait' ] + 1;
                    else if ( $value[ 'm_status' ] == '1' )
                        $result[ 'ok' ] = $result[ 'ok' ] + 1;
                    else if ( $value[ 'm_status' ] == '2' )
                        $result[ 'red' ] = $result[ 'red' ] + 1;

                    if ( isset( $value[ 'kisi_sayisi' ] ) )
                        $result[ 'usercount' ] += (int)$value[ 'kisi_sayisi' ];
                }
                return json_encode ( $result , JSON_UNESCAPED_UNICODE );
            } else return json_encode ( [ 'status' => 'not found' ] , JSON_UNESCAPED_UNICODE );
        } catch ( PDOException $e ) {
            return array (
                'status' => $e
            );
        }
    }

    //aylik rezervasyon detaylari
    public
    function rezervasyonThisMonth ()
    {
        $createMkTime = $this->getTimeMonthThisTime();

        $add = "select  m_status,kisi_sayisi  from {$this->RezervasyonTable} where time >=" . $createMkTime;
        $result = array ( 'toplam' => $this->rezervasyonThisCount ( 'month' ) , 'wait' => 0 , 'ok' => 0 , 'red' => 0 , 'usercount' => 0 );

        try {
            $query = $this->db->query ( $add , PDO::FETCH_ASSOC );

            if ( $query->rowCount () ) {
                foreach ( $query as $key => $value ) {

                    if ( $value[ 'm_status' ] == 0 )
                        $result[ 'wait' ] ++;
                    else if ( $value[ 'm_status' ] == 1 )
                        $result[ 'ok' ] ++;
                    else if ( $value[ 'm_status' ] == 2 )
                        $result[ 'red' ] ++;

                    $result[ 'usercount' ] += $value[ 'kisi_sayisi' ];
                }
                return json_encode ( $result , JSON_UNESCAPED_UNICODE );
            } else return json_encode ( [ 'status' => 'not found' ] , JSON_UNESCAPED_UNICODE );
        } catch ( PDOException $e ) {
            return array (
                'status' => $e
            );
        }
    }

    //yillik rezervasyon detaylari
    public
    function rezervasyonThisYear ()
    {
        $createMkTime = $this->getTimeYearThisTime();

        $add = "select  m_status,kisi_sayisi  from {$this->RezervasyonTable} where time >=" . $createMkTime;
        $result = array ( 'toplam' => $this->rezervasyonThisCount ( 'year' ) , 'wait' => 0 , 'ok' => 0 , 'red' => 0 , 'usercount' => 0 );

        try {
            $query = $this->db->query ( $add , PDO::FETCH_ASSOC );

            if ( $query->rowCount () ) {
                foreach ( $query as $key => $value ) {

                    if ( $value[ 'm_status' ] == 0 )
                        $result[ 'wait' ] ++;
                    else if ( $value[ 'm_status' ] == 1 )
                        $result[ 'ok' ] ++;
                    else if ( $value[ 'm_status' ] == 2 )
                        $result[ 'red' ] ++;

                    $result[ 'usercount' ] += $value[ 'kisi_sayisi' ];
                }
                return json_encode ( $result , JSON_UNESCAPED_UNICODE );
            } else return json_encode ( [ 'status' => 'not found' ] , JSON_UNESCAPED_UNICODE );
        } catch ( PDOException $e ) {
            return array (
                'status' => $e
            );
        }
    }

    public
    function getCategory ( $id )
    {
        if ( !is_numeric ( $id ) )
            return false;

        $sql = "select name from {$this->category} where id=" . $id;
        $status = [];

        try {
            $result = $this->db->query ( $sql , PDO::FETCH_ASSOC );
            if ( !$result->rowCount () )
                return json_encode ( [ 'status' => 'not found' ] , JSON_UNESCAPED_UNICODE );

            foreach ( $result as $key => $value ) {
                return $value[ 'name' ];
            }
        } catch ( PDOException $e ) {
            return [ 'status' => 'not found' ];
        }
    }

    public
    function thisAllProduct ()
    {
        $sql = "select * from {$this->product}";
        $status = [];

        try {
            $result = $this->db->query ( $sql , PDO::FETCH_ASSOC );
            if ( !$result->rowCount () )
                return json_encode ( [ 'status' => 'not found' ] , JSON_UNESCAPED_UNICODE );

            foreach ( $result as $key => $value ) {
                try{
                    $query = $this->db->query( "select * from features where id=" . $value["features"] ,  PDO::FETCH_ASSOC);
                    if($query->rowCount()) {
                        foreach ($query as $productOpt){
                            $option=json_decode ($productOpt["content"] , true);
                        }
                    }
                }catch (\PDOException $e){$option = ""; }
                array_push ( $status ,
                    [
                        'id' => $value[ 'id' ] ,
                        'name' => $value[ 'name' ] ,
                        'price' => $value[ 'price' ] ,
                        'numberOfProduct' => $value[ 'numberOfProduct' ] ,
                        'categoryName' => $this->getCategory ( $value[ 'categoryId' ] ) ,
                        'live' => $value[ 'live' ] ,
                        'cardText' => $value[ 'card_text' ] ,
                        'stores' => $value[ 'stores' ],
                        "options"=>$option,
                        "img"=>$value["img"]
                    ]
                );
            }

            return json_encode ( $status , JSON_UNESCAPED_UNICODE );
        } catch ( PDOException $e ) {
            return json_encode ( [ 'status' => 'not found' ] , JSON_UNESCAPED_UNICODE );
        }

    }

    public
    function newProduct ( $data )
    {
        if ( $data == null || $data=="" )
            return json_encode ( 'data yok' );

        $item = new Create();
        $item->add ( $data );

        return json_encode ($item->run() , JSON_UNESCAPED_UNICODE);
    }

    public
    function updateProduct ( $data= null )
    {
        if ( $data == null || $data=="" )
            return json_encode ( 'data yok' );

        $price= strip_tags(trim($data["price"]));
        $id= strip_tags(trim($data["id"]));


        $result = [
            "price"=>$price,
            'id'=>$id
        
        ];

        $updateDataQuery = "update  {$this->product} set price=:price where id=:id";

        try {
            $statement = $this->db->prepare ( $updateDataQuery );
            $statement->execute ( $result );
            return json_encode ( [ 'status' => 'ok' ] , JSON_UNESCAPED_UNICODE );

        } catch ( PDOException $e ) {
            return json_encode ( [ 'status' => 'kaydetme sorunu' ] , JSON_UNESCAPED_UNICODE );
        }
    }

    public function bringGetKuryeDetay($active=1)
    {

        $resultData= [] ;
        $day= $this->getTimeDayStartTime();
        $week= $this->getTimeWeektartTime();
        $month= $this->getTimeMonthThisTime();
        $year= $this->getTimeYearThisTime();

        $allKurye = "select * from {$this->kurye} where active={$active}";
        $result = $this->db->query ( $allKurye , PDO::FETCH_ASSOC );
      //  $allKurye = $result->fetchAll();

        foreach($result as $kurye){
            $id= $kurye['id'];
            $dayCount = "select count(*) as toplam from {$this->kuryeTakip} where  kurye_id='{$id}' and start_date >={$day}";
            $weekCount = "select count(*) as toplam from {$this->kuryeTakip} where  kurye_id='{$id}' and start_date >={$week}";
            $monthCount = "select count(*) as toplam from {$this->kuryeTakip} where  kurye_id='{$id}' and start_date >={$month}";
            $yearCount = "select count(*) as toplam from {$this->kuryeTakip} where  kurye_id='{$id}' and start_date >={$year}";

            $query = $this->db->query ( $dayCount , PDO::FETCH_ASSOC );
            $dayCount= $query->fetchAll();
            $query = $this->db->query ( $weekCount , PDO::FETCH_ASSOC );
            $weekCount= $query->fetchAll();
            $query = $this->db->query ( $monthCount , PDO::FETCH_ASSOC );
            $monthCount= $query->fetchAll();
            $query = $this->db->query ( $yearCount , PDO::FETCH_ASSOC );
            $yearCount= $query->fetchAll();

            array_push($resultData, [
                'id' => $kurye['id'],
                'name' => $kurye['firstname'] .' '. $kurye['lastname'],
                'day' => $dayCount[0]['toplam'],
                'week' => $weekCount[0]['toplam'],
                'month' => $weekCount[0]['toplam'],
                'year' => $weekCount[0]['toplam']
            ]);
        }

        return $resultData;
        
    }

    public
    function getKuryeCount ( $id )
    {
        $sql = "select count(*) as toplam from {$this->kuryeTakip} where  kurye_id='{$id}'";


        try {
            $result = $this->db->query ( $sql , PDO::FETCH_ASSOC );
            if ( !$result->rowCount () )
                return 'not found';

            foreach ( $result as $key => $value ) {
                return $value[ 'toplam' ];
            }
        } catch ( PDOException $e ) {
            return false;
        }
    }

    public
    function allKurye ()
    {
        $sql = "select * from {$this->kurye}";
        $status = [];

        try {
            $result = $this->db->query ( $sql , PDO::FETCH_ASSOC );
            if ( !$result->rowCount () )
                return json_encode ( [ 'status' => 'not found' ] , JSON_UNESCAPED_UNICODE );

            foreach ( $result as $key => $value ) {
                array_push ( $status ,
                    [
                        'firstname' => $value[ 'firstname' ] ,
                        'lastname' => $value[ 'lastname' ] ,
                        'date' => date ( 'Y-m-d H:i' , $value[ 'date' ] ) ,
                        'username' => $value[ 'username' ] ,
                        'id' => $value[ 'id' ] ,
                        'siparis' => $this->getKuryeCount ( $value[ 'id' ] )
                    ]
                );
            }

            return json_encode ( $status , JSON_UNESCAPED_UNICODE );
        } catch ( PDOException $e ) {
            return json_encode ( [ 'status' => 'not found' ] , JSON_UNESCAPED_UNICODE );
        }
    }


    /**
     * @param array $data
     * @return false|string
     */
    public
    function newKurye ( $data )
    {
        $data[ 'username' ] = strip_tags ( trim ( $data[ 'username' ] ) );
        $data[ 'firstname' ] = strip_tags ( trim ( $data[ 'firstname' ] ) );
        $data[ 'lastname' ] = strip_tags ( trim ( $data[ 'lastname' ] ) );

        if ( isset( $data[ 'password' ] ) && strlen ( $data[ 'password' ] ) > 0 )
            $data[ 'password' ] = password_hash ( trim ( $data[ 'password' ] ) , PASSWORD_DEFAULT );


        $time = new Ttime();

        $data[ 'date' ] = $time->gettime ();
        $worker = 'insert into kurye (firstname,lastname,date,username,password) values (:firstname,:lastname,:date,:username,:password)';

        try {
            $statement = $this->db->prepare ( $worker );
            $statement->execute ( $data );
            return json_encode ( [ 'status' => 'ok' ] , JSON_UNESCAPED_UNICODE );

        } catch ( PDOException $e ) {
            return $e ;
            return json_encode ( [ 'status' => 'kaydetme sorunu' ] , JSON_UNESCAPED_UNICODE );
        }

    }

    public
    function delkurye ( $id = '' )
    {
        if ( $id == '' )
            return json_encode ( [ 'status' => 'gecerli id giriniz' ] , JSON_UNESCAPED_UNICODE );

        $sql = 'update kurye set active=0 where id="' . strip_tags ( trim ( $id ) ) . '"';
        try {
            $statement = $this->db->prepare ( $sql );
            $statement->execute ();
            return json_encode ( [ 'status' => 'ok' ] , JSON_UNESCAPED_UNICODE );

        } catch ( PDOException $e ) {
            return json_encode ( [ 'status' => 'kayit silinemedi' ] , JSON_UNESCAPED_UNICODE );
        }
    }

    public
    function delproduct ( $id )
    {
        $id= strip_tags ( trim ( $id ) );
        if ( $id == '' )
            return json_encode ( [ 'status' => 'gecerli id giriniz' ] , JSON_UNESCAPED_UNICODE );
        $productOptionDeleteQuery= "DELETE FROM feature WHERE id=(SELECT features FROM products WHERE id=? )";
        $productDeleteQuery="DELETE FROM products WHERE id=?";

        try {
            $option = $this->db->prepare ( $productOptionDeleteQuery );
            $option->execute ([$id]);

            $statement = $this->db->prepare ( $productDeleteQuery );
            $statement->execute ([$id]);
            return json_encode ( [ 'status' => 'ok' ] , JSON_UNESCAPED_UNICODE );

        } catch ( PDOException $e ) {
            return json_encode ( [ 'status' => 'kayit silinemedi' ] , JSON_UNESCAPED_UNICODE );
        }

    }

    public
    function newCategory($val = []){
        if($val == [])
            return json_encode (["status"=>"gecerli deger giriniz"] , JSON_UNESCAPED_UNICODE) ;

        $imgUrl = $this->imgUpload ( );

        if($imgUrl == false )
            return json_encode (["status"=>"Görsel yüklemek zorunludur"] , JSON_UNESCAPED_UNICODE) ;

        $result = [
            "name"=>strip_tags (trim ( isset($val["name"]) ? $val["name"] : "" )),
            "img"=> $imgUrl
        ];

        $query = "insert into {$this->category} (name,img) values (:name,:img)";

        try {
            $statement = $this->db->prepare ( $query );
            $statement->execute ( $result );
            return json_encode ( [ 'status' => 'ok' ] , JSON_UNESCAPED_UNICODE );

        } catch ( PDOException $e ) {
            return json_encode ( [ 'status' => 'kaydetme sorunu' ] , JSON_UNESCAPED_UNICODE );
        }
    }

    private function imgUpload($fileName=""){
        $fileName= "image";
        //Check if the file is well uploaded
        if($_FILES[$fileName]['error'] > 0) { return 'Error during uploading, try again'; }

        //We won't use $_FILES['file']['type'] to check the file extension for security purpose

        //Set up valid image extensions
        $extsAllowed = array( 'jpg', 'jpeg', 'png' );

        //Extract extention from uploaded file
        //substr return ".jpg"
        //Strrchr return "jpg"

        $extUpload = strtolower( substr( strrchr($_FILES[$fileName]['name'], '.') ,1) ) ;
        //Check if the uploaded file extension is allowed

        if (in_array($extUpload, $extsAllowed) ) {

            //Upload the file on the server
            $randname =  md5(time() . $_FILES[$fileName]['name']) .".".pathinfo($_FILES[$fileName]['name'], PATHINFO_EXTENSION);

            $name = __DIR__ ."/../../../img/" . $randname;
            $result = move_uploaded_file($_FILES[$fileName]['tmp_name'], $name);


                return "img/".$randname ;

        } else {
            return false;
        }
    }

    public
    function deleteCategory($id){
        if ( $id == '' )
            return json_encode ( [ 'status' => 'gecerli id giriniz' ] , JSON_UNESCAPED_UNICODE );

        $sql = "delete from {$this->category} where id='" . strip_tags ( trim ( $id ) ) . "'";
        try {
            $statement = $this->db->prepare ( $sql );
            $statement->execute ();
            return json_encode ( [ 'status' => 'ok' ] , JSON_UNESCAPED_UNICODE );

        } catch ( PDOException $e ) {
            return json_encode ( [ 'status' => 'kayit silinemedi' ] , JSON_UNESCAPED_UNICODE );
        }
    }

    public
    function newCalisan($val = []){
        if($val == [] || $val["name"] == "" || $val["authority"]== "" )
            return json_encode (["status"=>"gecerli deger giriniz"] , JSON_UNESCAPED_UNICODE);

        if(  !filter_var( $val["email"] , FILTER_VALIDATE_EMAIL))
            return json_encode (["status"=>"gecerli deger giriniz"] , JSON_UNESCAPED_UNICODE);

        $time = new Ttime();
        $ip = new ip();

        $result = [
            "id"=>rand(1000,10000),
            "email"=>$val["email"],
            "password"=>password_hash (trim ($val["password"]) ,PASSWORD_DEFAULT),
            "name"=>strip_tags (trim ( isset($val["name"]) ? $val["name"] : "" )),
            "m_date"=>$time->gettime (),
            "ip"=>$ip->getIp (),
            "authority"=>strip_tags (trim ( $val["authority"]))
            ];

        $query = "insert into {$this->worker} (id,email,password,name,m_date,ip,authority) values (:id,:email,:password,:name,:m_date,:ip,:authority)";

        try {
            $statement = $this->db->prepare ( $query );
            $statement->execute ( $result );
            return json_encode ( [ 'status' => 'ok' ] , JSON_UNESCAPED_UNICODE );

        } catch ( PDOException $e ) {
            return json_encode ( [ 'status' => 'kaydetme sorunu' ] , JSON_UNESCAPED_UNICODE );
        }
    }

    /**
     * @param array $val
     * @return false|string
     */
    public
     function  updateCalisan($val = []){
        $Gyetki = ["0","1","2"];

        $id= strip_tags(trim($val["id"]));
        $yetki= strip_tags(trim($val["authority"]));

        $result = [
            "authority"=>$yetki,
            "id"=>$id
        ];

        $query = "update  {$this->worker} set authority=:authority where id=:id";

        try {
            $statement = $this->db->prepare ( $query );
            $statement->execute ( $result );
            return json_encode ( [ 'status' => 'ok' ] , JSON_UNESCAPED_UNICODE );

        } catch ( PDOException $e ) {
            return json_encode ( [ 'status' => 'kaydetme sorunu' ] , JSON_UNESCAPED_UNICODE );
        }
    }

    public
    function delCalisan($id){
            if ( $id == '' )
                return json_encode ( [ 'status' => 'gecerli id giriniz' ] , JSON_UNESCAPED_UNICODE );

            $sql = "delete from {$this->worker} where id='" . strip_tags ( trim ( $id ) ) . "'";
            try {
                $statement = $this->db->prepare ( $sql );
                $statement->execute ();
                return json_encode ( [ 'status' => 'ok' ] , JSON_UNESCAPED_UNICODE );

            } catch ( PDOException $e ) {
                return json_encode ( [ 'status' => 'kayit silinemedi' ] , JSON_UNESCAPED_UNICODE );
            }
    }

    public
    function bringGetOrderDetay($opt = "day"){
        if($opt == "year")
            $createMkTime =  $this->getTimeYearThisTime();
        elseif ($opt == "month")
            $createMkTime =  $this->getTimeMonthThisTime();
        elseif ($opt == "day")
            $createMkTime = $this->getTimeDayStartTime();
        elseif($opt == "week")
            $createMkTime = $this->getTimeWeektartTime();

        $add = "select orders from {$this->order} where m_status=5 and m_date >=" . $createMkTime . " ORDER BY m_date";
        $resultData = [];

        try {
            $query = $this->db->query ( $add , PDO::FETCH_ASSOC );

            if ( $query->rowCount () ) {
                foreach ( $query as $key => $value ) {
                    $val = json_decode ($value["orders"] , true) ;
                    foreach ($val as $value){
                        //satılan urunlerın kacar adet satıldıgı hesaplanacak
                        if( isset($resultData[$value["id"]]) )
                            $resultData[$value["id"]] = $resultData[$value["id"]] + $value["count"] ;
                        else
                            $resultData[$value["id"]] = $value["count"] ;
                    }
                }
                $response = [] ;
                foreach ($resultData as $key =>$val){
                    array_push ($response , ["name"=>$this->getProductName ($key) , "count"=>$val , "id"=>$key ]) ;
                }
                return json_encode ( $response , JSON_UNESCAPED_UNICODE );
            } else return json_encode ( [ 'status' => 'not found' ] , JSON_UNESCAPED_UNICODE );
        } catch ( PDOException $e ) {
            return array (
                'status' => $e
            );
        }
    }

    private
    function getProductName($id){

        $sql = "select name from {$this->product} where id='{$id}'";
        $status = [];

        try {
            $result = $this->db->query ( $sql , PDO::FETCH_ASSOC );
            if ( !$result->rowCount () )
                return json_encode ( [ 'status' => 'not found' ] , JSON_UNESCAPED_UNICODE );

            foreach ( $result as $key => $value ) {
                        return  $value[ 'name' ] ;
            }
        } catch ( PDOException $e ) {
            return json_encode ( [ 'status' => 'not found' ] , JSON_UNESCAPED_UNICODE );
        }
    }

    public
    function getWorker(){
        $add = "select id,email,name,authority from {$this->worker}";
        $result = array ();

        try {
            $query = $this->db->query ( $add , PDO::FETCH_ASSOC );

            if ( $query->rowCount () ) {
                foreach ( $query as $key => $value ) {
                    $result[ $key ] = $value;
                }
                return json_encode ( $result , JSON_UNESCAPED_UNICODE );
            } else return json_encode ( [ 'status' => 'not found' ] , JSON_UNESCAPED_UNICODE );
        } catch ( PDOException $e ) {
            return array (
                'status' => $e
            );
        }
    }



    public
    function __destruct () {
        $this->db= null;

    }
}
