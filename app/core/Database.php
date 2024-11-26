<?php
class Database
{
    private static $pdo = null;
    public static function getPDO()
    {
        if (self::$pdo === null) {
            $db_config = require_once('db.config.php');
            try {
                $host = $db_config['host'];
                $username = $db_config['username'];
                $password = $db_config['password'];
                $database = $db_config['database'];
                $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ];
                self::$pdo = new PDO($dsn, $username, $password, $options);
            } catch (PDOException $e) {
                die("Could not connect to the database " . $e->getMessage());
            }
        }
        return self::$pdo;
    }

}