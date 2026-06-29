<?php
namespace Admin\Controller;

use Admin\Model\Comentario;
use Admin\View\ComentarioView as ComentView;
use Admin\Dal\ComentarioDao as ComentDao;
use Admin\Util\Functions as Util;

use Exception;

class ComentarioController {

    public static function criar() {
        if ($_SERVER["REQUEST_METHOD"] === "GET" && $_POST["imagem"]) {
            try{
            $comentario = comentario::criarComentario(
                nomeImagem:  Util::prepararTexto($_POST["imagem"]),
                autor: Util::prepararTexto($_POST["autor"]),
                texto: Util::prepararTexto($_POST["texto"]));

                ComentDao::cadastrar($comentario);
            }catch(Exception $e){
            }
        }
        header("Location: ./?p=coment");
    }

    public static function editar() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["texto"]) {
            try{

            }catch(Exception $e){
                $_SESSION["mensageErro"] = $e->getMessage();
            }
        
    }

    public static function formulario() {
        $comentario = null;
        $id = 0;
        try{
            if(isset($_GET["alt"])) $comentario = ComentDao::buscarPorId((int) $_GET["alt"]);
            if(isset($_GET["exc"])) $id = (int) $_GET["exc"];
            }catch(Exception $e){
                $_SESSION["mensageErro"] = $e->getMessage();
            }
            
            ComentView::formulario($comentario, $id);
        self::listarTodos();
    }

    public static function listarTodos() {

        try{
            ComentView::exibir(ComentDao::listar());
        }catch(Exception $e){
            $_SESSION["mensageErro"] = $e->getMessage();
        }
    }
    
    public static function deletar() {
        $id = (int) $_GET["excluir"] ?? "";

        ComentDao::excluir((string)$id);
        header("Location: ./?p=coment");
    }
}