<?php
namespace Admin\Controller;

use Admin\Model\Usuario;
use Admin\Dal\usuarioDao as UserDao;
use Admin\Util\Functions as Util;
use Admin\View\UsuarioView as UserView;

use \Exception;

class usuarioController {

    public static function criar() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["nome"]) {
            try{
                $email = Util::prepararTexto($_POST["email"]);
                $senha = Util::prepararTexto($_POST["senha"]);
                $confSenha = Util::prepararTexto($_POST["confSenha"]);

                if (strlen($senha) < 5) {
                    throw new Exception("Senha precisa ter no mínimo 5 caracteres!");  
                }

                if($senha != $confSenha){
                    throw new Exception("Senhas não conferem!");  
                }
                
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new Exception("E-mail inválido!");
                }

                if (UserDao::buscarPorEmail($email)) {
                    throw new Exception("E-mail já cadastrado!"); 
                }

                $usuario = Usuario::criarUsuario(
                    nome: Util::prepararTexto($_POST["nome"]),
                    email: $email,
                    senha: password_hash($senha, PASSWORD_ARGON2I)
                );
                
                UserDao::cadastrar($usuario);

            }catch(Exception $e){
                $_SESSION["mensageErro"] = $e->getMessage();
            }
        }
        header("Location: ./?p=user");
    }

    public static function editar() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["nome"]) {
            try{
                if(isset($_POST["senha"]) && $_POST["senha"] != $_POST["confSenha"]){
                    throw new Exception("Senhas não conferem");  
                }

                $usuario = Usuario::criarUsuario(
                    id: (int) $_POST["id"],
                    nome: Util::prepararTexto($_POST["nome"]),
                    email: Util::prepararTexto($_POST["email"]),
                    senha: password_hash(Util::prepararTexto($_POST["senha"]), PASSWORD_ARGON2I)
                );

                UserDao::editar($usuario);
            }catch(Exception $e){
                $_SESSION["mensageErro"] = $e->getMessage();
            }
        }
        header("Location: ./?p=user");
    }

    public static function formulario() {
        $usuario = null;
        $id = 0;
        try{
            if(isset($_GET["alt"])) $usuario = UserDao::buscarPorId((int) $_GET["alt"]);
            if(isset($_GET["exc"])) $id = (int) $_GET["exc"];
            }catch(Exception $e){
                $_SESSION["mensageErro"] = $e->getMessage();
            }
            
            UserView::formulario($usuario, $id);
        self::listarTodos();
    }

    public static function listarTodos() {
        try{
            UserView::exibir(UserDao::listar());
        }catch(Exception $e){
            $_SESSION["mensageErro"] = $e->getMessage();
        }
    }
    
    public static function deletar() {
        $id = (int) $_GET["excluir"] ?? "";

        UserDao::excluir((int)$id);
        header("Location: ./?p=user");
    }

    public static function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["login"] != "") {
            try {
                $email = Util::prepararTexto($_POST["login"]);
                $senha = Util::prepararTexto($_POST["senha"]);
                
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new Exception("E-mail inválido!");
                }
                
                $usuario = UserDao::buscarPorEmail($_POST["login"]);
                
                if (!password_verify($senha, $usuario->senha)) {
                    throw new Exception("não foi possível realizar o login"); 
                }

                $_SESSION["usuario"] = $usuario->nome;
                        
            } catch (Exception $e) {
                $_SESSION["mensageErro"] = $e->getMessage();

            }
        }
    }

    public static function logout() {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            try {
                session_destroy();
                header("Location: ../");
                        
            } catch (Exception $e) {
                $_SESSION["mensageErro"] = $e->getMessage();
            }
        }
    }

}