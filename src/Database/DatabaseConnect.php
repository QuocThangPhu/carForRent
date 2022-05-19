<?php

namespace Thangphu\CarForRent\Database;

use PDO;
use PDOException;
use Dotenv\Dotenv;

class DatabaseConnect
{
    private static $connection;
    protected static $dotenv;

    public static function getConnection()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
        self::$dotenv = $dotenv->load();
        if (!self::$connection) {
            $servername = $_ENV['HOST'];
            $username = $_ENV['USERNAME'];
            $password = $_ENV['PASSWORD'];
            $dbname = $_ENV['DB_NAME'];
            try {
                self::$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
        return self::$connection;
    }
}
