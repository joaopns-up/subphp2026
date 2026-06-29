<?php
namespace App\Dal;

use App\Model\Orcamento;
use App\Dal\Conn;

use \PDOException;
use \Exception;

class OrcamentoDao {

    public static function cadastrar(Orcamento $orcamento) {
        try {
            $pdo = Conn::getConn();
            $sql = $pdo->prepare("INSERT INTO orcamento (nome, email, telefone, duracao, local, tipoEvento, impresso, qtdeFotos, observacoes) VALUES (?,?,?,?,?,?,?,?,?)");
            $sql->execute(
                [$orcamento->nome,
                 $orcamento->email,
                 $orcamento->telefone,
                 $orcamento->duracao,
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
}