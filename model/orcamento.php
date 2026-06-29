<?php
namespace App\Model;

class Orcamento {
    private ?int $id;
    private int $qtdeFotos, $duracao;
    private string $nome, $email, $local, $observacoes, $telefone, $tipoEvento;
    private bool $impresso;

    public function __construct(){}

    public static function criarOrcamento(string $nome,  string $email, string $telefone, int $duracao, string $local, string $tipoEvento, bool $impresso, int $qtdeFotos, string $observacoes,  ?int $id = null): static {
        $orcamento = new static();
        $orcamento->id = $id;
        $orcamento->nome = $nome;
        $orcamento->email = $email;
        $orcamento->telefone = $telefone;
        $orcamento->duracao = $duracao;
        $orcamento->local = $local;
        $orcamento->tipoEvento = $tipoEvento;
        $orcamento->impresso = $impresso;
        $orcamento->qtdeFotos = $qtdeFotos;
        $orcamento->observacoes = $observacoes;

        return $orcamento;
    }

    public function __get($atributo){
        return $this->$atributo;
    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
}