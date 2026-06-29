<?php
namespace App\Controller;

use App\Template\View\SlideshowView as SlideView;
use App\Dal\SlideshowDao as SlideDao;

use Exception;

class SlideshowController {

    public static function listarTodos() {
        try{
            SlideView::exibir(SlideDao::listar());
        }catch(Exception $e){
            $_SESSION["mensageErro"] = $e->getMessage();
        }
    }
}