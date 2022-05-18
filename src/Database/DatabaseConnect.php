<?php

namespace Thangphu\CarForRent\Database;

use PDO;
use PDOException;

class DatabaseConnect
{
    private static $connection;

    public static function getConnection()
    {
        $servername = "localhost";
        $username = "root";
        $password = "Qt@05100809";
        $dbname = "carforrent";
        if(!self::$connection)
        {
            try {
                self::$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Connected successfully";
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
        return self::$connection;
    }
}