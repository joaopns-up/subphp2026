<?php
namespace Admin\Dal;

use Admin\Model\Comentario;
use Admin\Dal\Conn;

use \PDO;
use \Exception;
use PDOException;

abstract class ComentarioDao {

    public static function cadastrar(Comentario $comentario) {
        try {
            $pdo = Conn::getConn();
            $sql = $pdo->prepare("INSERT INTO comentario (nomeImagem, autor, texto) VALUES (?,?,?)");
            $sql->execute(
                [$comentario->nomeImagem,
                 $comentario->autor,
                 $comentario->texto]);

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
            $sql = $pdo->prepare("SELECT * FROM comentario");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_CLASS, Comentario::class);

        } catch (PDOException $e) {
            throw new Exception("Erro ao listar comentarios do banco de dados ". $e->getMessage());
        }catch (Exception $e) {
            throw new Exception("Ecorreu um erro inesperado ". $e->getMessage());
        }
    }


    public static function editar(Comentario $comentario) {
        try {
            $pdo = Conn::getConn();
            $sql = $pdo->prepare("UPDATE comentario SET nomeImagem=?, autor=?, texto=? WHERE id=?");        
            $sql->execute();

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
            $sql = $pdo->prepare("DELETE FROM comentario WHERE id=1");
            $sql->bindParam(":id", $id);
            $sql->execute();
 
        } catch (PDOException $e) {
            throw new Exception("Erro ao deletar". $e->getMessage());
        }catch (Exception $e) {
            throw new Exception("Ecorreu um erro inesperado ". $e->getMessage());
        }
    }
}
