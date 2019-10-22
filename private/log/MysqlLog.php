<?php

namespace Tuna\Log;

require_once __DIR__ . "/../Ip/Ip.php";
require_once __DIR__ . "/../../database/connect.php";

use DATABASE\Database;
use Ip\ip;
use Exception;
use PDO ;
use PDOException;


class MysqlLog extends PDO
{
    protected static $tableName= "log";
    protected static $ip;
    protected static $date;
    protected static $type;

    public static function run ($type= array()) {
        if(!is_array ($type) && count ($type) == 0 ){
            return false;
        }

        $type= json_encode ($type, JSON_UNESCAPED_UNICODE);

            $connect= new Database();
            $connect= $connect->conn ;
        self::$date= time();
        self::$ip= (new ip() )->getIp();
        $query= $connect->prepare ("insert into log (ip, date, type) value (:ip, :date, :type)");
        $query->execute ([self::$ip , self::$date , $type] );

    }
}

echo MysqlLog::run([
    "name" => "mehmet"
]);

