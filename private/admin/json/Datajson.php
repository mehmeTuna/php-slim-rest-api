<?php



namespace Admin\Data ;

require_once __DIR__ . '/../../time/timestammp.php';

use formattimestamp\Ttime ;

class Json{

    public $response ;


    public function __construct()
    {
        
    }

    public function getTime(){
        $this->write(
            array(
                'nowDate'=>Ttime::getTime()
            )
        );
    }

    public function write($val = []){
        if($val == [])
          return json_encode(
              array(
                  'val' =>'null'
              ) ,JSON_UNESCAPED_UNICODE
          );
        return json_encode( $val, JSON_UNESCAPED_UNICODE);
    }

    public function __destruct()
    {
        
    }
}


