<?php
namespace App\Model;

class Slideshow {

    private ?int $id;
    private ?string $caminhoImagem;
    private string $textoImagem, $titulo, $descricao;

    public function __construct(){}

    public static function criarSlideshow(string $textoImagem, string $titulo, string $descricao, ?string $caminhoImagem = null, ?int $id = null): static {
        $slideShow = new static();
        $slideShow->id = $id;
        $slideShow->caminhoImagem = $caminhoImagem;
        $slideShow->textoImagem = $textoImagem;
        $slideShow->titulo = $titulo;
        $slideShow->descricao = $descricao;
        return $slideShow;
    }

    public function __get($atributo){
        return $this->$atributo;
    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
}