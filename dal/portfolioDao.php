<?php
namespace App\Dal;

use App\Model\Portfolio;
use App\Dal\Conn;

use \PDO;
use \Exception;
use PDOException;

abstract class PortfolioDao {

    public static function listar() {
        try {
            $pdo = Conn::getConn();
            $sql = $pdo->prepare("SELECT * FROM portfolio");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_CLASS, Portfolio::class);

        } catch (PDOException $e) {
            throw new Exception("Erro ao listar portfolios do banco de dados ". $e->getMessage());
        }catch (Exception $e) {
            throw new Exception("Ecorreu um erro inesperado ". $e->getMessage());
        }
    }

}
