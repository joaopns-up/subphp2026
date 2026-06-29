<?php
namespace Admin\Dal;
use \PDO;
use PDOException;

abstract class Conn {

    private static $conn;
    private static $host = "localhost";
    private static $dbname = "prova";
    private static $usuario = "root";
    private static $senha = "root";

    public static function getConn() {
        try {
            if(!isset(self::$conn)){
                self:: $conn = new PDO("mysql:host=". self::$host ."; dbname=". self::$dbname , self::$usuario, self::$senha);
            }
            return self::$conn;
        } catch (PDOException $e) {
            die("Erro ao conectar ao banco: " . $e->getMessage());
        }
    }
}