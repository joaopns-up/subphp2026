<?php
namespace App\Dal;

use App\Model\Comentario;
use App\Dal\Conn;

use \PDO;
use \Exception;
use PDOException;

abstract class ComentarioDao {

    public static function listar() {
        try {
            $pdo = Conn::getConn();
            $sql = $pdo->prepare("SELECT * FROM comentario");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_CLASS, Comentario::class);

        } catch (PDOException $e) {
            throw new Exception("Erro ao listar comentarios do banco de dados ". $e->getMessage());
        }catch (Exception $e) {
            throw new Exception("Ecorreu um erro inesperado ". $e->getMessage());
        }
    }
}
