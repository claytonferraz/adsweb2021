<?php
session_start();
//Destroi todas as variáveis globais usadas para conexão
session_unset();
//Destruindo a sessão:
session_destroy();
header("Location: ../login.php");
?>