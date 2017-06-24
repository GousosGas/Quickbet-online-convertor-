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

    public static function disconnect()
    {
        self::$connection = null;
    }


    public static function loadAnalitics()
    {
        $query = self::$connection->query("select * from users JOIN history_values on users.userID=history_values.userID");

        while ($row = $query->fetch()) {
            $userId = $row['userID'];
            $name = $row['name'];
            $value = $row['value'];
            echo $userId . ", " . $name . " has value " . $value . "<br>";

        }
    }



}