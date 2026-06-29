<?php
namespace App\Model;

class Comentario {
    private ?int $id;
    private string $nomeImagem,$autor, $texto;

    public function __construct(){}

    public static function criarComentario(string $autor, string $texto, string $nomeImagem, ?int $id = null, ): static {
        $comentario = new static();
        $comentario->id = $id;
        $comentario->nomeImagem = $nomeImagem;
        $comentario->autor = $autor;
        $comentario->texto = $texto;
        return $comentario;
    }

    public function __get($atributo){
        return $this->$atributo;
    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
}