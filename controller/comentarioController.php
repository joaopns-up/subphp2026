<?php
namespace App\Controller;

use App\Template\View\ComentarioView as ComentView;
use App\Dal\ComentarioDao as ComentDao;

use Exception;

class ComentarioController {

    public static function listarTodos() {

        try{
            ComentView::exibir(ComentDao::listar());
        }catch(Exception $e){
            $_SESSION["mensageErro"] = $e->getMessage();
        }
    }

}