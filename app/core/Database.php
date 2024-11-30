<?php
class Database
{
    private static $pdo = null;

    /**
     * Using the singleton pattern to create a single instance of the PDO object.
     * So that we don't have to pass/store the PDO object around (except inside Model classes).
     */
    public static function getPDO()
    {
        if (self::$pdo === null) {
            $db_config = require_once('db.config.php');
            try {
                $host = $db_config['app']['host'];
                $username = $db_config['app']['username'];
                $password = $db_config['app']['password'];
                $database = $db_config['app']['dbname'];
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