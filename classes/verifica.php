<?php
if (session_status() !== PHP_SESSION_ACTIVE)
{
    session_cache_expire(60);
    session_start();
}

// Se n�o existir os dados da sess�o de login
if(!isset($_SESSION['usuarioCPF']) && !isset($_SESSION['usuarioNome']) && !isset($_SESSION['usuarioPermissao']) && !isset($_SESSION['usuarioNivelAcesso']) && !isset($_SESSION['usuarioCNPJ']))
{
    // Usu�rio n�o logado! Redireciona para a p�gina de login
    header("Location: https://termonline.com.br/admin/login.php");
    exit;
}
?>
