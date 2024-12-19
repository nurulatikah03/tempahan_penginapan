<?php

class DBConnection {
    private static $conn;

    public static function getConnection() {
        if (!self::$conn) {
            self::$conn = new mysqli('localhost', 'root', '', 'tempahan_penginapan');
            if (self::$conn->connect_error) {
                die("Connection failed: " . self::$conn->connect_error);
            }
        }
        return self::$conn;
    }

    public static function closeConnection() {
        if (self::$conn) {
            self::$conn->close();
            self::$conn = null;
        }
    }
}