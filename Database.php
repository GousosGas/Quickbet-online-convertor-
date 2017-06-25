<?php


class Database
{
    private static $dbName = "quick-bet";
    private static $dbHost = "localhost";
    private static $dbUsername = "gas2";
    private static $dbPassword = "1111";

    private static $connection = null;

    public function __construct()
    {
        die("this is a static class and cant initialized");
    }

    /***
     * Database connection with PDO
     * @return null|PDO
     */
    public static function connect()
    {

        try {

            self::$connection = new PDO("mysql:host=" . self::$dbHost . ";" . "dbname=" . self::$dbName, self::$dbUsername, self::$dbPassword);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return self::$connection;

    }

    /**
     * Database close connection
     */
    public static function disconnect()
    {
        self::$connection = null;
    }


}