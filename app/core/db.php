<?php

namespace app\core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $connection = null;

    public static function connect(): ?PDO
    {
        if (self::$connection === null) {
            $host = 'localhost';
            $dbname = 'hotel';
            $user = 'root';
            $pass = '';

            try {
                self::$connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                return null;
            }
        }

        return self::$connection;
    }
}
