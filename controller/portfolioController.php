<?php
namespace App\Controller;

use App\Template\View\PortfolioView as PortView;
use App\Dal\PortfolioDao as PortDao;

use Exception;

class PortfolioController {

    public static function listarTodos() {
        try{
            PortView::exibir(PortDao::listar());
        }catch(Exception $e){
            $_SESSION["mensageErro"] = $e->getMessage();
        }
    }

}