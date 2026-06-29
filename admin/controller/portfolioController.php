<?php

use Portfolio;
use PortfolioView as PortView;
use PortfolioDao as PortDao;
use Functions as Util;

use Exception;

class PortfolioController {

    public static function criar() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && $_FILES["imagem"]) {
            try{
            $portfolio = portfolio::criarPortfolio(
                caminhoImagem: Upload::uploadImagem(
                    $_FILES["imagem"],
                    "portfolio"), 
                textoImagem: Util::prepararTexto($_POST["textoImagem"]));

                PortDao::cadastrar($portfolio);
            }catch(Exception $e){
                $_SESSION["mensageErro"] = $e->getMessage();
            }
        }
        header("Location: ./?p=port");
    }

    public static function editar() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["textoImagem"]) {
            try{
            $portfolio = Portfolio::criarPortfolio(
                id: (int) $_POST["id"], 
                textoImagem: Util::prepararTexto($_POST["textoImagem"]));

                PortDao::editar($portfolio);
            }catch(Exception $e){
                $_SESSION["mensageErro"] = $e->getMessage();
            }
        }
        header("Location: ./?p=port");
    }

    public static function formulario() {
        $portfolio = null;
        $id = 0;
        try{
            if(isset($_GET["alt"])) $portfolio = PortDao::buscarPorId((int) $_GET["alt"]);
            if(isset($_GET["exc"])) $id = (int) $_GET["exc"];
            }catch(Exception $e){
                $_SESSION["mensageErro"] = $e->getMessage();
            }
            
            PortView::formulario($portfolio, $id);
        self::listarTodos();
    }

    public static function listarTodos() {
        try{
            PortView::exibir(PortDao::listar());
        }catch(Exception $e){
            $_SESSION["mensageErro"] = $e->getMessage();
        }
    }
    
    public static function deletar() {
        $id = (int) $_GET["excluir"] ?? "";

        Upload::excluirImagem(PortDao::buscarPorId($id)->caminhoImagem);

        PortDao::excluir((int)$id);
        header("Location: ./?p=port");
    }
}