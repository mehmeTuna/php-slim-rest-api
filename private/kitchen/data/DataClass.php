<?php

namespace KitchenData;


require_once __DIR__ . '/../../../database/connect.php';
require_once __DIR__  .'/../../time/timestamp.php';


use DATABASE\Database;
use formattimestamp\Ttime ;
use PDO;
use PDOException;
use Exception ;

class Data
{
    public $db;
    public $orderCount = array();
    private $thisDayTime = '';

    public
    function __construct()
    {
        $this->db = new Database();
        $this->db = $this->db->conn;
        $this->thisDayTime = $thisDayTime = mktime ( 0 , 1 , 0 , ltrim ( date ( 'm' ) , 0 ) , ltrim ( date ( 'd' ) , 0 ) , ltrim ( date ( 'Y' ) , 0 ) );
    }


    public
    function Bringdata($val , $name)
    {
        $sql = 'select count(*) from order_items where m_status="' . $val . '" and m_date >="' . $this->thisDayTime . '"';

        try {
            $query = $this->db->query ( $sql , PDO::FETCH_ASSOC );

            foreach ( $query as $val ) {
                $this->orderCount[ $name ] = $val[ 'count(*)' ];
            }
        } catch ( PDOException $e ) {
            return $e;
        }
    }

    public
    function BringAllOrders($val)
    {
        $result = array();
        $val = strip_tags ( $val );
        if ( !is_numeric ( $val ) )
            return $result;
        $sql = 'select orders,user_id,m_date,order_id from order_items where m_status="' . $val . '" and m_date >="' . $this->thisDayTime . '"' . ' order by m_date asc';
        $thisResult = array();
        try {
            $query = $this->db->query ( $sql , PDO::FETCH_ASSOC );

            foreach ( $query as $val ) {

                $thisResult[ 'content' ] = $val[ 'orders' ];
                $thisResult[ 'date' ] = $val[ 'm_date' ];
                $thisResult[ 'orderId' ] = $val[ 'order_id' ];
                $thisResult[ 'phone' ] = $val[ 'user_id' ];

                $query = $this->db->query ( 'select phone from users where id=' . $thisResult[ 'phone' ] , PDO::FETCH_ASSOC );

                foreach ( $query as $val ) {

                    $thisResult[ 'phone' ] = $val[ 'phone' ];
                }


                array_push ( $result , $thisResult );
            }


            return $result;
        } catch ( PDOException $e ) {
            return array(
                'status' => $e
            );
        }
    }


    public
    function BringSearchAllOrders($val)
    {
        $result = array();
        $val = strip_tags ( $val );
        if ( !is_numeric ( $val ) )
            return $result;
        $sql = 'select orders,user_id,m_date,order_id from order_items where order_id=' . $val . ' order by m_date asc';
        $thisResult = array();
        try {
            $query = $this->db->query ( $sql , PDO::FETCH_ASSOC );

            foreach ( $query as $val ) {

                $thisResult[ 'content' ] = $val[ 'orders' ];
                $thisResult[ 'date' ] = $val[ 'm_date' ];
                $thisResult[ 'orderId' ] = $val[ 'order_id' ];
                $thisResult[ 'phone' ] = $val[ 'user_id' ];

                $query = $this->db->query ( 'select phone from users where id=' . $thisResult[ 'phone' ] , PDO::FETCH_ASSOC );

                foreach ( $query as $val ) {

                    $thisResult[ 'phone' ] = $val[ 'phone' ];
                }


                array_push ( $result , $thisResult );
            }


            return $result;
        } catch ( PDOException $e ) {
            return array(
                'status' => $e
            );
        }
    }

    /**
     * @param $id
     * @return array
     */
    public
    function BringOrderdetay($id)
    {
        $queryData = "";
        $itemFeatures=array ();//db opsiyonlar
        $result = array();
        $resultOrderName= ""; //features ve siparişleri ekleme
        $OrderDetailQuery = 'select icerik,orders from order_items where order_id="' . $id . '"';

        try {
            $query = $this->db->prepare ( $OrderDetailQuery );
            $query->execute();
            $queryData = $query->fetchAll();
            $result[ 'content' ] = $queryData[0][ 'icerik' ];
            $result[ 'orders' ] = json_decode ($queryData[0][ 'orders' ] , true);
            if($result[ 'orders' ] == false) throw new Exception("Sipariş hatası");            
        } catch ( PDOException $e ) {
            return array(
                'status' => $e
            );
        }

                foreach($result["orders"] as $value){
                  
                    $productId= $value["id"];//ürün idsi
                    $orderCount = $value["count"];//ürün adeti
                    $orderName = $value["name"];//ürün adı
                    $orderFeatures= isset($value["features"]) ? $value["features"] : "";//[count=> , items[0=> , 1=> ]]//ürün detayları

                    $getDataysql = 'select * from feature where id=(select features from products where id="'.$productId.'")';
                   
                    try{
                        $query = $this->db->prepare( $getDataysql);
                        $query->execute();
                        $resultFeaturesDetay= $query->fetchAll();
                        $itemFeatures= json_decode ($resultFeaturesDetay[0]["content"], true);
                        if($itemFeatures == false) throw new Exception("detay kısmında hata var");
                    }catch (PDOException $e){    }

                    if(!is_array($orderFeatures) || count($orderFeatures)==0){
                        return $orderCount." x ".$orderName;
                    }
                  
                    foreach($orderFeatures as $result){
                        $resultOrderName.=$result["count"]. " x ". $orderName." ( ";
                        foreach($result["items"] as $items){
                            foreach($itemFeatures as $itemResult){
                                if($itemResult["id"] == $items)
                                 $resultOrderName.= $itemResult["content"]." ,";
                            }
                        }
                        $resultOrderName.=" ) <br>";
                    }
                }

        return $resultOrderName;
    }

    public
    function BringAllKurye()
    {
        $res = array();
        $sql = 'select * from kurye';

        try {
            $query = $this->db->query ( $sql , PDO::FETCH_ASSOC );

            foreach ( $query as $val ) {
                array_push ( $res , ['name' => $val[ 'firstname' ] . ' ' . $val[ 'lastname' ] , 'id' => $val[ 'id' ]] );
            }

            if ( $res == [] ) return array('status' => 'not found');
            else return $res;
        } catch ( PDOException $e ) {
            return array(
                'status' => $e
            );
        }
    }

    /**
     * @param $id
     * @param $opt
     * @param string $orderDetail
     * @return false|string
     */
    public
    function orderRed($id , $opt = 4)
    {
        //4 mutfak tarafindan iptal edilen siparis
        $sql = "UPDATE order_items SET m_status=? WHERE order_id=?";

        try {
            $this->db->prepare ( $sql )->execute ( [$opt , $id] );

            return json_encode (
                array(
                    "status" => "ok"
                )
            );

        } catch ( PDOException $e ) {
            return json_encode (
                array(
                    "status" => "red"
                )
            );
        }
    }

    /**
     * @param string $id
     * @param string $kuryeId
     * @param int $opt
     * @return false|string
     */
    public function orderOnay($id = '' , $kuryeId = '' , $opt = 5)
    {
        //4 mutfak tarafindan iptal edilen siparis
        //5 mutfak tarafindan onaylanip kuryey verilen siparis
        $order_sql = "UPDATE order_items SET m_status=? WHERE order_id=?";
        $kurye_sql = "INSERT INTO kurye_takip (id,order_id,kurye_id,start_date,finish_date) VALUES (?,?,?,?,0)";
        $kurye_data = [
            rand ( 1000 , 10000 ) ,
            strip_tags ( trim ( $id ) ) ,
            strip_tags ( trim ( $kuryeId ) ) ,
            (new Ttime)->gettime ()
        ];
        $result = '';

        try {
            $this->db->prepare ( $order_sql )->execute ( [$opt , $id] );

            $result =['status'=>'ok'];

        } catch ( PDOException $e ) {
            $result =['status'=>'red'];
        }

            if($result['status'] == 'red')
                 return json_encode ( ['status' => 'kaydetme sorunu'] , JSON_UNESCAPED_UNICODE );

        try {
            $this->db->prepare ( $kurye_sql )->execute ($kurye_data);
            $result =['status'=>'ok'];

        } catch ( PDOException $e ) {
            $result =['status'=>$e];
        }

        return json_encode ($result , JSON_UNESCAPED_UNICODE);
    }


    public
    function __destruct()
    {

    }
}
