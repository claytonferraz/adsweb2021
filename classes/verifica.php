<?php
if (session_status() !== PHP_SESSION_ACTIVE)
{
    session_cache_expire(60);
    session_start();
}

// Se não existir os dados da sessão de login
if(!isset($_SESSION['usuarioCPF']) && !isset($_SESSION['usuarioNome']) && !isset($_SESSION['usuarioPermissao']) && !isset($_SESSION['usuarioNivelAcesso']) && !isset($_SESSION['usuarioCNPJ']))
{
    // Usuário não logado! Redireciona para a página de login
    header("Location: https://termonline.com.br/admin/login.php");
    exit;
}
?>
