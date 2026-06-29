<?php
namespace Admin\Controller;

use Admin\Model\Orcamento;
use Admin\View\OrcamentoView as OrcamView;
use Admin\Dal\OrcamentoDao as OrcamDao;
use Admin\Util\Functions as Util;

use Exception;

class OrcamentoController {

    public static function criar() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["nome"]) {
            if{
                $orcamento = Orcamento::criarOrcamento(
                nome:  Util::prepararTexto($_POST["nome"]),
                email: Util::prepararTexto($_POST["email"]),
                telefone: Util::prepararTexto($_POST["telefone"]),
                duracao: Util::prepararTexto($_POST["duracao"]),
                local: Util::prepararTexto($_POST["local"]),
                tipoEvento: Util::prepararTexto($_POST["tipoEvento"]),
                impresso: Util::prepararTexto($_POST["impresso"]),
                qtdeFotos: Util::prepararTexto($_POST["qtdeFotos"]),
                observacoes: Util::prepararTexto($_POST["observacoes"]),      
                );

                OrcamDao::cadastrar($orcamento);
            }catch(Exception $e){
                $_SESSION["mensageErro"] = $e->getMessage();
            }
        }
        header("Location: ./?p=orcam");
    }

    public static function formulario() {
        try{
            if(isset($_GET["ver"])){
                $orcamento = OrcamDao::buscarPorId((int) $_GET["ver"]);
                OrcamView::detalhes($orcamento);
            } 

        }catch(Exception $e){
            $_SESSION["mensageErro"] = $e->getMessage();
        }
        self::listarTodos();
    }

    public static function listarTodos() {

        try{
            OrcamView::exibir(OrcamDao::listar());
        }catch(Exception $e){
            $_SESSION["mensageErro"] = $e->getMessage();
        }
    }   
}