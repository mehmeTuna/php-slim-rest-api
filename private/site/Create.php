<?php
//site hakkinda kok dizin bigileri calismasi icin gerekli sartlar lazim
namespace Site ;

require_once __DIR__ . '/../../database/connect.php';

use DATABASE\Database ;

class create {
    private $name ='';
    private $description = '';
    private $createDate = ''; 
    private $url = '';
    private $online = '' ; 
    private $lisans = '' ;

    private $control = true ;
    private $db = '' ;

    private $queryData = '' ;  

    public function __construct()
    {
        $this->db = new Database();
        $this->db = $this->db->conn ; 
    }


    public function Name($val){
        $this->name = strip_tags(trim($val)) ;
        return $this;
    }

    public function Description($val){
     $this->description = strip_tags(trim($val)) ;
     return $this;
    }

    public function CreateDate($val){
        $this->createDate = strip_tags(trim($val)) ;
      return $this;
    }

    public function Url($val){
      $this->url = strip_tags(trim($val));
      return $this ;
    }

    public function Online($val){
       $this->online = strip_tags(trim($val));
       return $this;
    }

    public function Lisans($val){
      $this->lisans = strip_tags(trim($val)) ; 
      return $this ;
    }


    public function Control (){
  
        if($this->name != '')
            $this->queryData .= 'site_name="'.$this->name.'"';

        if($this->description != '')
           $this->queryData .= (($this->queryData != '') ? ',' : '').'site_description="'.$this->description.'"';

        if($this->createDate != '' )
           $this->queryData .= (($this->queryData != '') ? ',' : '').'site_create_date="'.$this->createDate.'"';

        if($this->url != '')
           $this->queryData  .= (($this->queryData != '') ? ',' : '').'site_url="'.$this->url.'"';

        if($this->online != '')
           $this->queryData  .= (($this->queryData != '') ? ',' : '').'site_online="'.$this->online.'"';

        if($this->lisans != '')
            $this->queryData  .=(($this->queryData != '') ? ',' : ''). 'site_lisans="'.$this->lisans.'"';

            return $this->queryData ; 

    }

    public function Run(){
        $query = 'update site set ' . $this->queryData;
        
        try{
          $statement = $this->db->prepare($query);
          $statement->execute();
          return ['status' => 'ok'];

        }catch(PDOException $e){
            return ['status' => $e] ;
        }
    }
}

/*
$deneme = new create();
$deneme->Name('localhost');
$deneme->Description('site aciklama ksimi demo 2 ');
$deneme->CreateDate('1559808638');
$deneme->Url('http://localhost:81');
$deneme->Online(1);
$deneme->Lisans(1);



echo $deneme->Control();
print_r($deneme->Run());
*/