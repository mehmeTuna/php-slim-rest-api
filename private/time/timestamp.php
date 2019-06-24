<?php

namespace formattimestamp ;


date_default_timezone_set('Europe/Istanbul');

class Ttime {
  public function __construct(){

  }


    /**
     * @return int
     */
    public function gettime(){
      return time();
  }


  public function __destruct(){

  }
}
