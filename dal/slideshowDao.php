<?php
namespace App\Dal;

use App\Model\Slideshow;
use App\Dal\Conn;

use \PDO;
use \Exception;
use PDOException;

abstract class SlideshowDao {

    public static function listar() {
        try {
            $pdo = Conn::getConn();
            $sql = $pdo->prepare("SELECT * FROM slideshow");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_CLASS, Slideshow::class);

        } catch (PDOException $e) {
            throw new Exception("Erro ao listar slideshows do banco de dados ". $e->getMessage());
        }catch (Exception $e) {
            throw new Exception("Ecorreu um erro inesperado ". $e->getMessage());
        }
    }
}
