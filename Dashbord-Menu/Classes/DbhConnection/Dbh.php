<?php

class Dbh {
    protected static $conn;

    public static function connect() 
    {
        if (!self::$conn) {
            $host = "localhost";
            $dbname = "restaurant";
            $username = "root";
            $password = "";
            
            try 
            {
                self::$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $e) 
            {
                echo "Connection failed: " . $e->getMessage();
            }
        }
        return self::$conn;
    }
}