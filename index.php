<?php
namespace App;
use App\Controller\SlideshowController as Slide;
use App\Controller\PortfolioController as Portfolio;
use App\Controller\OrcamentoController as Orcamento;
use App\Controller\ComentarioController as Comentario;

if(isset($_GET["env"])) Orcamento::criar();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banner</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body  id="inicio">

    <?php 
        require_once("./template/header.php");
        echo "<main>";
        Slide::listarTodos();
        Portfolio::listarTodos();
        Orcamento::formulario();
        Comentario::listarTodos();
        echo "</main>";
        require_once("./template/footer.php");
    ?>

    <dialog id="login">
        <form action="./admin/" method="post">
            <h2 class="flex-p100">Login</h2>
            <label class="flex-p20" for="login"> E-mail:</label>
            <input class="flex-p70" type="text" name="login" id="login">
            <label class="flex-p20" for="senha"> Senha: </label>
            <input class="flex-p70" type="password" name="senha" id="senha">
            <button type="button" id="btnFechar">Sair</button>
            <button type="submit">Entrar</button>
        </form>
    </dialog>

    <script src="./assets/script.js"></script>
</body>
</html>