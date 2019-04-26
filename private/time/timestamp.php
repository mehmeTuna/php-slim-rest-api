<?php

namespace formattimestamp ;

use \Datetime;
date_default_timezone_set('Europe/Istanbul');


class Ttime {
  public function __construct(){

  }


  public function gettime(){
    $date = new DateTime(date("y-m-d H:i:s")) ;
    return $date->getTimestamp();
  }


  public function __destruct(){

  }
}
