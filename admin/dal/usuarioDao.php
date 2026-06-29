<?php
namespace  Admin\Dal;

use Admin\Model\Usuario;
use \PDOException;
use \Exception;
use \PDO;

class usuarioDao {
    
    public static function cadastrar(Usuario $usuario) {
        try {
            $pdo = Conn::getConn();
            $sql = $pdo->prepare("INSERT INTO usuario (nome, email, senha) VALUES (?,?,?)");
            $sql->execute(
                [$usuario->nome,
                 $usuario->email,
                 $usuario->senha]);

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
            $sql = $pdo->prepare("SELECT * FROM usuario");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_CLASS, Usuario::class);

        } catch (PDOException $e) {
            throw new Exception("Erro ao listar usuarios do banco de dados ". $e->getMessage());
        }catch (Exception $e) {
            throw new Exception("Ecorreu um erro inesperado ". $e->getMessage());
        }
    }

    public static function buscarPorId($id) {
        try {
            $pdo = Conn::getConn();
            $sql = $pdo->prepare("SELECT * FROM usuario WHERE id=:id");
            $sql->bindParam(":id", $id);
            $sql->execute();

            return $sql->fetchObject(Usuario::class);

        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar usuario no banco de dados ". $e->getMessage());
        }catch (Exception $e) {
            throw new Exception("Ecorreu um erro inesperado ". $e->getMessage());
        }
    }

    public static function buscarPorEmail($email) {
        try {
            $pdo = Conn::getConn();
            $sql = $pdo->prepare("SELECT * FROM usuario WHERE email=:email");
            $sql->bindParam(":email", $email);
            $sql->execute();

            return $sql->fetchObject(Usuario::class);

        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar cliente no banco de dados ". $e->getMessage());
        }catch (Exception $e) {
            throw new Exception("Ecorreu um erro inesperado ". $e->getMessage());
        }
    }

    public static function editar(Usuario $usuario) {
        try {
            $pdo = Conn::getConn();
            $sql = $pdo->prepare("UPDATE usuario SET nome=?, email=?, senha=? WHERE id=?");        
            $sql->execute(
                [$usuario->nome,
                 $usuario->email,
                 $usuario->senha,
                 $usuario->id]);

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
            $sql = $pdo->prepare("DELETE FROM usuario WHERE id=:id");
            $sql->bindParam(":id", $id);
            $sql->execute();
 
        } catch (PDOException $e) {
            throw new Exception("Erro ao deletar". $e->getMessage());
        }catch (Exception $e) {
            throw new Exception("Ecorreu um erro inesperado ". $e->getMessage());
        }
    }
}
