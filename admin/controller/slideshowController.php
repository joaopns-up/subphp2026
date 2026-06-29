<?php

use Admin\Model\Slideshow as Slide;
use Admin\View\SlideshowView as SlideView;
use Admin\Dal\SlideshowDao as SlideDao;
use Admin\Util\Functions as Util;

namespace Exception;

class SlideshowController {

    public static function criar() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && $_FILES["imagem"]) {
            try{
            $slideshow = Slide::criarSlideshow(
                caminhoImagem: Upload::uploadImagem(
                    $_FILES["imagem"],
                    "slideshow"), 
                textoImagem: Util::prepararTexto($_POST["textoImagem"]), 
                titulo: Util::prepararTexto($_POST["titulo"]), 
                descricao: Util::prepararTexto($_POST["descricao"]));

                SlideDao::cadastrar($slideshow);
            }catch(Exception $e){
                $_SESSION["mensageErro"] = $e->getMessage();
            }
        }
        header("Location: ./?p=slide");
    }

    public static function editar() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["titulo"]) {
            try{
            $slideshow = Slide::criarSlideshow(
                id: (int) $_POST["id"], 
                textoImagem: Util::prepararTexto($_POST["textoImagem"]), 
                titulo: Util::prepararTexto($_POST["titulo"]), 
                descricao: Util::prepararTexto($_POST["descricao"]));

                SlideDao::editar($slideshow);
            }catch(Exception $e){
                $_SESSION["mensageErro"] = $e->getMessage();
            }
        }
        header("Location: ./?p=slide");
    }

    public static function formulario() {
        $slide = null;
        $id = 0;
        try{
            if(isset($_GET["alt"])) $slide = SlideDao::buscarPorId((int) $_GET["alt"]);
            if(isset($_GET["exc"])) $id = (int) $_GET["exc"];
            }catch(Exception $e){
                $_SESSION["mensageErro"] = $e->getMessage();
            }
            
            SlideView::formulario($slide, $id);
        self::listarTodos();
    }

    public static function listarTodos() {
        try{
            SlideView::exibir(SlideDao::listar());
        }catch(Exception $e){
            $_SESSION["mensageErro"] = $e->getMessage();
        }
    }
    
    public static function deletar() {
        $id = (int) $_GET["excluir"] ?? "";

        Upload::excluirImagem(SlideDao::buscarPorId($id)->caminhoImagem);

        SlideDao::excluir((int)$id);
        header("Location: ./?p=slide");
    }
}