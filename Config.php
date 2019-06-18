<?php

if( !isset($_SESSION) )
   session_start();

require_once __DIR__ . '/database/connect.php' ;

use DATABASE\Database;

class WebRoot extends Database{

    /**
     * @param $queryString
     * @return string
     */
    public function query($queryString){
        $query = "select {$queryString} from site where id=1" ;
        $result = '';
        try {
            $query = $this->conn->query ( $query , PDO::FETCH_ASSOC );

            if ( $query->rowCount () ) {
                foreach ( $query as $val ) {

                    if ( !empty( $val[ $queryString ] ) ) {
                        $result = $val[ $queryString ];
                    }
                }
            }
            return $result;
        } catch ( PDOException $e ) {
            echo 'err';
        }
    }

    /**
     *return site name
     */
    public function name()
    {
        return $this->query('site_name');
    }


    /**
     * @return string
     */
    public function url (){
        return $this->query('site_url') ;
    }

    /**
     * @return string
     */
    public function description (){
        return $this->query('site_description');
    }

}