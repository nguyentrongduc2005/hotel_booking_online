<?php

namespace app\core;

use PDO;
use PDOException;

class db
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
    public static function selectAll(string $sql, array $params = []): array
    {
        $stmt = self::connect()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    
    public static function selectOne(string $sql, array $params = []): array|false
    {
        $stmt = self::connect()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch();
    }

    
    public static function execute(string $sql, array $params = []): bool
    {
        $stmt = self::connect()->prepare($sql);
        return $stmt->execute($params);
    }

    
    public static function insertAndGetId(string $sql, array $params = []): int|false
    {
        $stmt = self::connect()->prepare($sql);
        if ($stmt->execute($params)) {
            return self::connect()->lastInsertId();
        }
        return false;
    }
}
