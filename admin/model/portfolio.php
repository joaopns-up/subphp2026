<?php

namespace Admin\Model;

class Portfolio {
    private ?int $id;
    private ?string $caminhoImagem;
    private string $textoImagem;

    public function __construct(){}

    public static function criarPortfolio(string $textoImagem, ?string $caminhoImagem = null, ?int $id = null): static {
        $portfolio = new static();
        $portfolio->id = $id;
        $portfolio->caminhoImagem = $caminhoImagem;
        $portfolio->textoImagem = $textoImagem;
        return $portfolio;
    }

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }
}