<?php
namespace Admin\Model;

class Usuario {
    private ?int $id;
    private string $email, $senha, $nome;

    public function __construct(){}

    public static function criarUsuario(string $nome, string $email, string $senha, ?int $id = null): static {
        $usuario = new static();
        $usuario->id = $id;
        $usuario->nome = $nome;
        $usuario->email = $email;
        $usuario->senha = $senha;
        return $usuario;
    }

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }
}