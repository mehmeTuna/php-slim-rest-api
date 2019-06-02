<?php

date_default_timezone_set('Europe/Istanbul');

require_once __DIR__ .'/../../database/connect.php'; 


//trait
require_once __DIR__ . '/Config.php';

namespace Admin\Data ;
use DATABASE\Database ;


class DbAbout{
    
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
        
        try{
         $query = $this->db->query( $add ,  PDO::FETCH_ASSOC);
         
         if($query->rowCount()){
             foreach ($query as $value) {
                 return $value;
             }
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
        return false ;
        
        $thismonth = mktime(0,0,0,$month,1,date('Y'));
        $nowdate = time();

        $add= "select count(*) from {$this->UserTable} where m_date >= {$thismonth} and m_date <= {$nowdate}" ;
        
        try{
         $query = $this->db->query( $add ,  PDO::FETCH_ASSOC);
         
         if($query->rowCount()){
             foreach ($query as $value) {
                 return $value;
             }
         }
      }catch(PDOException $e){
          return array(
              'status'=>$e
          ) ;
      }
    }

    //this year user
    public function getThisYearUser($year){
        if( ! is_numeric($year) )
        return false ;
        
        $thisyear = mktime(0,0,0,1,1,$year);
        $nowdate = time();

        $add= "select count(*) from {$this->UserTable} where m_date >= {$thisyear} and m_date <= {$nowdate}" ;
        
        try{
         $query = $this->db->query( $add ,  PDO::FETCH_ASSOC);
         
         if($query->rowCount()){
             foreach ($query as $value) {
                 return $value;
             }
         }
      }catch(PDOException $e){
          return array(
              'status'=>$e
          ) ;
      }
    }

        //all user count 
    public function getAllRezervasyon(){
        $add= "select count(*) from {$this->RezervasyonTable}" ;
        
        try{
         $query = $this->db->query( $add ,  PDO::FETCH_ASSOC);
         
         if($query->rowCount()){
             foreach ($query as $value) {
                 return $value;
             }
         }
      }catch(PDOException $e){
          return array(
              'status'=>$e
          ) ;
      }
    }

    public function getThisMontRezervasyon($month){
        if(!(is_numeric($month) && $month >=1  &&  $month <=12))
        return false ;
        
        $thismonth = mktime(0,0,0,$month,1,date('Y'));
        $nowdate = time();

        $add= "select count(*) from {$this->RezervasyonTable} where time >= {$thismonth} and time <= {$nowdate}" ;
        
        try{
         $query = $this->db->query( $add ,  PDO::FETCH_ASSOC);
         
         if($query->rowCount()){
             foreach ($query as $value) {
                 return $value;
             }
         }
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

        $add= "select count(*) from {$this->RezervasyonTable} where time >= {$thisyear} and time <= {$nowdate}" ;
        
        try{
         $query = $this->db->query( $add ,  PDO::FETCH_ASSOC);
         
         if($query->rowCount()){
             foreach ($query as $value) {
                 return $value;
             }
         }
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
             return $result ;
         }
      }catch(PDOException $e){
          return array(
              'status'=>$e
          ) ;
      }
    }

    



    public function __destruct()
    {
        
    }
}