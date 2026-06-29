<?php
namespace Admin\Dal;

use Admin\Model\Slideshow;
use Admin\Dal\Conn;

use \PDO;
use \Exception;
use PDOException;

abstract class SlideshowDao {

    public static function cadastrar(Slideshow $slideshow) {
        try {
            $pdo = Conn::getConn();
            $sql = $pdo->prepare("INSERT INTO slideshow (caminhoImagem, textoImagem, titulo, descricao) VALUES (?,?,?,?)");
            $sql->execute(
                [$slideshow->caminhoImagem,
                 $slideshow->textoImagem,
                 $slideshow->titulo,
                 $slideshow->descricao]);

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
            $sql = $pdo->prepare("SELECT * FROM slideshow");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_CLASS, Slideshow::class);

        } catch (PDOException $e) {
            throw new Exception("Erro ao listar slideshows do banco de dados ". $e->getMessage());
        }catch (Exception $e) {
            throw new Exception("Ecorreu um erro inesperado ". $e->getMessage());
        }
    }

    public static function buscarPorId($id) {
        try {
            $pdo = Conn::getConn();
            $sql = $pdo->prepare("SELECT * FROM slideshow WHERE id=:id");
            $sql->bindParam(":id", $id);
            $sql->execute();

            return $sql->fetchObject(Slideshow::class);

        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar slideshow no banco de dados ". $e->getMessage());
        }catch (Exception $e) {
            throw new Exception("Ecorreu um erro inesperado ". $e->getMessage());
        }
    }

    public static function editar(Slideshow $slideshow) {
        try {
            $pdo = Conn::getConn();
            $sql = $pdo->prepare("UPDATE slideshow SET textoImagem=?, titulo=?, descricao=? WHERE id=?");        
            $sql->execute(
                [$slideshow->textoImagem,
                 $slideshow->titulo,
                 $slideshow->descricao,
                 $slideshow->id]);

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
            $sql = $pdo->prepare("DELETE FROM slideshow WHERE id=:id");
            $sql->bindParam(":id", $id);
            $sql->execute();
 
        } catch (PDOException $e) {
            throw new Exception("Erro ao deletar". $e->getMessage());
        }catch (Exception $e) {
            throw new Exception("Ecorreu um erro inesperado ". $e->getMessage());
        }
    }
}
