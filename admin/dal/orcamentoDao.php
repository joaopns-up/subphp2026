<?php
namespace Admin\Dal;

use Admin\Model\Orcamento;
use Admin\Dal\Conn;

use \PDOException;
use \PDO;
use \Exception;

class OrcamentoDao {

    public static function cadastrar(Orcamento $orcamento) {
        try {
            $pdo = Conn::getConn();
            $sql = $pdo->prepare("INSERT INTO orcamento (nome, email, telefone, duracao, local, tipoEvento, impresso, qtdeFotos, observacoes) VALUES ");
            $sql->execute(
                [$orcamento->nome,
                 $orcamento->email,
                 $orcamento->telefone,
                 $orcamento->durcao,
                 $orcamento->local,
                 $orcamento->tipoEvento,
                 $orcamento->impresso,
                 $orcamento->qtdeFotos,
                 $orcamento->observacoes,
                ]);

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
            $sql = $pdo->prepare("SELECT * FROM orcamento");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_CLASS, Orcamento::class);

        } catch (PDOException $e) {
            throw new Exception("Erro ao listar orcamentos do banco de dados ". $e->getMessage());
        }catch (Exception $e) {
            throw new Exception("Ecorreu um erro inesperado ". $e->getMessage());
        }
    }

    public static function buscarPorId($id) {
        try {
            $pdo = Conn::getConn();
            $sql = $pdo->prepare("SELECT * FROM orcamento WHERE id=:id");
            $sql->bindParam(":id");
            $sql->execute();

            return $sql->fetchObject(Orcamento::class);

        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar orcamento no banco de dados ". $e->getMessage());
        }catch (Exception $e) {
            throw new Exception("Ecorreu um erro inesperado ". $e->getMessage());
        }
    }
}