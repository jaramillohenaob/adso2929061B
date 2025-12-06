<?php 

abstract class Database {
    protected static $conn = null;

    public static function connect() {
        if (self::$conn === null) {
            try {
                $host = 'localhost';
                $dbnm   = 'pokeadso';
                $user = "root";
                $pass = "";

                self::$conn = new PDO("mysql:host=$host;dbname=$dbnm", $user, $pass);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}