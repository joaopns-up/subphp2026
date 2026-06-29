<?php
namespace App\Controller;

use App\Model\Orcamento;
use App\Template\View\OrcamentoView as OrcamView;
use App\Dal\OrcamentoDao as OrcamDao;
use App\Util\Functions as Util;

use Exception;

class OrcamentoController {

    public static function criar() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["nome"]) {

            }catch(Exception $e){
                $_SESSION["mensageErro"] = $e->getMessage();
            }
        }
        header("Location: ./");
    }

    public static function formulario() {
       OrcamView::formulario();
    }

}