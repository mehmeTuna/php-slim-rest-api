<?php

namespace Data ;

require_once __DIR__ .'/../../database/connect.php';

use DATABASE\Database ;
use PDO;
use PDOException;


class Insert{
    private $db = '';
    private $tableName = 'data_istatistik';
    private $id = '' ;
    private $year = '';
    private $month = '';
    private $day = '' ;
    private $timeJson = '' ;
    private $kuryeOrderCount = '' ;
    private $kuryeJson = '' ;
    private $orderPrice ='';
    private $orderCount = '' ;
    private $orderKapidaPos = '' ;
    private $orderKapidaNakit = '' ;
    private $orderKredi = '' ;
    private $orderJson = '' ;
    private $rezervasyonCount = '' ;
    private $rezervasyonJson = '' ;

    /**
     * Insert constructor.
     */
    public function __construct ()
    {
        $this->db = new Database();
        $this->db = $this->db->conn ;
        $this->id = rand(1000 , 10000);
        $this->year = date('Y');
        $this->month = ltrim(date('m'),0);
        $this->day = ltrim(date('d') , 0);

    }

    public function addKuryeOrder($kuryeId = '' ){
        if($kuryeId == '')
            return false ;
         $result = $this->queryData('kurye_order_count');
         if($result == null)
             $result[$kuryeId] = 1 ;
         else {
             $result = json_decode ($result , true) ;
             if( isset($result[$kuryeId]) )
                  $result[$kuryeId] = $result[$kuryeId] +1 ;
              else
                  $result[$kuryeId] = 1 ;
         }

         $result = json_encode ($result , JSON_UNESCAPED_UNICODE) ;

            $sql = "UPDATE {$this->tableName} SET kurye_order_count=? WHERE m_year=? and m_month=? and m_day=?";

     try{
         $this->db->prepare($sql)->execute([$result, $this->year ,$this->month , $this->day]);
         return true ;
     }catch(PDOException $e){
         return false ;
     }
    }

    public function orderPrice($price = ''){
        if($price == '')
            return false ;
        $result = $this->queryData('order_price');
        if($result == null)
            $result = $price ;
        else
            $result = $result+$price ;

        $sql = "UPDATE {$this->tableName} SET order_price=? WHERE m_year=? and m_month=? and m_day=?";

        try{
            $this->db->prepare($sql)->execute([$result, $this->year ,$this->month , $this->day]);
            return true ;
        }catch(PDOException $e){
            return false ;
        }
    }

    public function orderCount($count){
        if($count == '')
            return false ;
        $result = $this->queryData('order_count');
        if($result == null)
            $result = $count ;
        else
            $result = $result+$count ;

        $sql = "UPDATE {$this->tableName} SET order_count=? WHERE m_year=? and m_month=? and m_day=?";

        try{
            $this->db->prepare($sql)->execute([$result, $this->year ,$this->month , $this->day]);
            return true ;
        }catch(PDOException $e){
            return false ;
        }
    }

    public function orderKapidaPos($count , $price){
        if($count == '')
            return false ;
        $result = $this->queryData('order_kapida_pos');
        if($result == null){
          $result['count'] = $count ;
          $result['price'] = $price;
        }else {
            $result = json_decode ($result , true) ;
            $result['count'] = $result['count'] + $count ;
            $result['price'] = $result['price'] + $price ;
        }

        $result = json_encode ($result , JSON_UNESCAPED_UNICODE) ;

        $sql = "UPDATE {$this->tableName} SET order_kapida_pos=? WHERE m_year=? and m_month=? and m_day=?";

        try{
            $this->db->prepare($sql)->execute([$result, $this->year ,$this->month , $this->day]);
            return true ;
        }catch(PDOException $e){
            return false ;
        }
    }



    public function run(){
         return true ;
    }

    /**
     * @param $sutun
     * @return bool|false|\PDOStatement|string
     */
    private function queryData( $sutun){
        $result = '';

        if($sutun == '')
            return false ;

        $sql = "select {$sutun} from {$this->tableName}  where  m_year='{$this->year}' and m_month='{$this->month}' and m_day='{$this->day}'";

        try {
            $result = $this->db->query ( $sql , PDO::FETCH_ASSOC );
            if ( !$result->rowCount () ){
                $this->newData () ;
            }
        } catch ( PDOException $e ) {
            return false;
        }
        $result = $this->db->query ( $sql , PDO::FETCH_ASSOC );
        foreach ($result as $val){
            $result = $val[$sutun];
        }

        return $result ;
    }


    /**
     * @return bool
     */
    public function newData(){
        $sql = "select * from {$this->tableName}  where  m_year='{$this->year}' and m_month='{$this->month}' and m_day='{$this->day}'";

        try {
            $result = $this->db->query ( $sql , PDO::FETCH_ASSOC );
            if ( $result->rowCount () ){
             return true ;
            }
        } catch ( PDOException $e ) {
            return false;
        }

        $createDataQuery = "insert into {$this->tableName}(id,m_year,m_month,m_day)values('{$this->id}','{$this->year}','{$this->month}','{$this->day}')";
         try{
             $statement = $this->db->prepare ( $createDataQuery );
             $statement->execute ();
             return true ;
         }catch (PDOException $e){
             return false ;
         }
    }

    public function  __destruct ()
    {
        // TODO: Implement __destruct() method.
    }
}