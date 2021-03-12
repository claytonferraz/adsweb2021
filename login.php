<?php//a merda do login
if (session_status() !== PHP_SESSION_ACTIVE)
{
    session_cache_expire(60);
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">        
        <title>Administrativo - Termonline</title>
        <meta name="description" content="Sistema automatizado para termometria. Tenha relatórios em poucos cliques e alertas em tempo real sobre problemas de temperatura." />
        <link rel="apple-touch-icon" href="imagens/favicons/apple-touch-icon.png" sizes="180x180">
        <link rel="icon" href="imagens/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
        <link rel="icon" href="imagens/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
        <link rel="manifest" href="imagens/favicons/manifest.json">
        <link rel="mask-icon" href="imagens/favicons/safari-pinned-tab.svg" color="#563d7c">
        <link rel="icon" href="imagens/favicons/favicon.ico">
        <meta name="msapplication-config" content="imagens/favicons/browserconfig.xml">
        <meta name="theme-color" content="#563d7c">
        
        <style>
            .bd-placeholder-img 
            {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            }

            @media (min-width: 768px) 
            {
            .bd-placeholder-img-lg 
            {
                font-size: 3.5rem;
            }
            }
        </style>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/signin.css">
    </head>
    <body class="text-center">
        <form class="form-signin" method="POST" action="classes/valida.php">
            <img class="mb-4" src="imagens/logo.svg" alt="Termometro" width="200" height="200">
            <h1 class="h3 mb-3 font-weight-normal">Área Restrita</h1>

            <div class="form-group">
                <input name="login" type="text" class="form-control" placeholder="Digite o usuário" required onkeypress="$(this).mask('000.000.000-00');">               
            </div>
            <div class="
                    form-group" />
                <input name="senha" type="password" class="form-control" placeholder="Digite a senha" required>
            </div>
            <button class="btn btn-lg btn-info btn-block" type="submit">Acessar</button>
            <!-- <p class="text-center">Esqueceu a senha?</p> -->
            <p class="text-center text-danger">
            <?php
            //Recuperando o valor da variável global, os erro de login.
                if(isset($_SESSION['loginErro']))
                {
                    echo $_SESSION['loginErro'];
                    unset($_SESSION['loginErro']);
                }
            ?>
            </p>
            <p class="text-center text-success">
            <?php 
			    //Recuperando o valor da variável global, deslogado com sucesso.
                if(isset($_SESSION['logindeslogado']))
                {
                    echo $_SESSION['logindeslogado'];
                    unset($_SESSION['logindeslogado']);
                }
            ?>
        </form>
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/jquery.mask.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/dashboard.js"></script>
    </body>
</html>
