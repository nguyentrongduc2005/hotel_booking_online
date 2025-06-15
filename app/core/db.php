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
            $host = Registry::getInstance()->config['host'];
            $dbname = Registry::getInstance()->config['dbname'];
            $user = Registry::getInstance()->config['user'];
            $pass = Registry::getInstance()->config['pass'];

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





    public static function getAll($sql)
    {
        $stmt = self::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
  [id => value]
  sql : select * from table where id = :id 
  */

    public static function getOne($sql, $param = [])
    {
        $sql = "$sql WHERE id = :id";
        $stmt = self::connect()->prepare($sql);
        $stmt->execute($param);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * insert into table(col,col2..) values(:col,:col2..)
     * 
     * params = [
     *   'col' => 'value',
     *  'col2' => 'value2',
     * ]     */
    public static function insert($tableName, $params = [])
    {
        $keys = array_keys($params);
        $columns = implode(',', $keys);
        $placeholders = implode(',:', $params);
        $placeholders = ':' . $placeholders;
        $sql = "INSERT INTO $tableName ($columns) VALUES ($placeholders)";

        $stmt = self::connect()->prepare($sql);
        $stmt->execute($params);
        return self::connect()->lastInsertId();
    }
    /**
     * 
     * update table set col = :col, col2 = :col2 where id = :id
     * 
     * params = [ col => value, col2 => value2 ]
     * codition  = 1;
     * 
     */

    public static function update($tableName, $params = [], $codition)
    {
        $keys = array_keys($params);
        $clause = '';
        foreach ($keys as $key) {
            $clause .= "$key = :$key, ";
        }
        $clause = rtrim($clause, ', ');
        $sql = "UPDATE $tableName SET $clause WHERE id = $codition";
        $stmt = self::connect()->prepare($sql);
        $stmt->execute($params);
        return $stmt->rowCount();
    }


    public static function delete($tableName, $codition)
    {
        $sql = "DELETE FROM $tableName WHERE id =  $codition";
        $stmt = self::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
