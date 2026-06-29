<?php
namespace Admin\Dal;

use Admin\Model\Portfolio;
use Admin\Dal\Conn;

use \PDO;
use \Exception;
use PDOException;

abstract class PortfolioDao {

    public static function cadastrar(Portfolio $portfolio) {
        try {
            $pdo = Conn::getConn();
            $sql = $pdo->exec("INSERT INTO portfolio (caminhoImagem, textoImagem) VALUES (?,?)");
            $sql->execute(
                [$portfolio->caminhoImagem,
                 $portfolio->textoImagem]);

            return $pdo->lastInsertId();
        }catch (PDOException $e) {
            throw new Exception("Erro ao salvar no banco de dados ". $e->getMessage());
        }catch (Exception $e) {
            throw new Exception("Ecorreu um erro inesperado ". $e->getMessage());
        }
    }
    
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

    public static function buscarPorId($id) {
        try {
            $pdo = Conn::getConn();
            $sql = $pdo->prepare("SELECT * FROM portfolio WHERE id=:id");
            $sql->bindParam(":id", $id);
            $sql->execute();

            return $sql->fetchObject(Portfolio::class);

        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar portfolios no banco de dados ". $e->getMessage());
        }catch (Exception $e) {
            throw new Exception("Ecorreu um erro inesperado ". $e->getMessage());
        }
    }

    public static function editar(Portfolio $portfolio) {
        try {
            $pdo = Conn::getConn();
            $sql = $pdo->prepare("UPDATE portfolio SET textoImagem=? WHERE id=?");        
            $sql->execute(
                [$portfolio->textoImagem,
                 $portfolio->id]);

            if($sql->rowCount() !== 1){
                throw new Exception("Nenhum registro foi encontrado");
            }
        } catch (PDOException $e) {
            throw new Exception("Erro ao editar". $e->getMessage());
        }catch (Exception $e) {
            throw new Exception("Ecorreu um erro inesperado ". $e->getMessage());
        }
    }

    public static function excluir(int $id) {
        try {
            $pdo = Conn::getConn();
            $sql = $pdo->prepare("DELETE FROM portfolio WHERE id=:id");
            $sql->bindParam(":id", $id);
            $sql->execute();
 
        } catch (PDOException $e) {
            throw new Exception("Erro ao deletar". $e->getMessage());
        }catch (Exception $e) {
            throw new Exception("Ecorreu um erro inesperado ". $e->getMessage());
        }
    }
}
