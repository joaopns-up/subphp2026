<?php
    namespace Admin;
    
    use Admin\Controller\SlideshowController as Slide; 
    use Admin\Controller\UsuarioController as User; 
    use Admin\Controller\PortfolioController as Port; 
    use Admin\Controller\ComentarioController as Coment; 
    use Admin\Controller\OrcamentoController as Orcam; 


    session_regenerate_id();

    require_once("./autoload.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["login"] != "") {
       // User::login();
       vardump($_POST);
    }

    if (!isset($_SESSION["usuario"])) {
       // header("Location: ../");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Administrativa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./assets/style.css">

</head>
<body class="flex">
<?php
    require_once("./menu.php");
    require_once("./header.php");
    
    echo "<main>";

    match ($_GET["p"] ?? "orcam") {
        "user" => User::formulario(),
        "cadUser" => User::criar(),
        "altUser" => User::editar(),
        "delUser" => User::deletar(),
        "logout" => User::logout(),

        "port" => Port::formulario(),
        "cadPort" => Port::criar(),
        "altPort" => Port::editar(),
        "delPort" => Port::deletar(),

        "coment" => Coment::formulario(),
        "cadComent" => Coment::criar(),
        "altComent" => Coment::editar(),
        "delComent" => Coment::deletar(),

        "orcam" => Orcam::formulario(),
        "cadorcam" => Orcam::criar(),

        "slide" => Slide::formulario(),
        "cadSlide" => Slide::criar(),
        "altSlide" => Slide::editar(),
        "delSlide" => Slide::deletar(),

        default => "",
    };

    echo "</main>";

    require_once("./footer.php");
?>
<script src="./assets/script.js"></script>

</body>
</html>
