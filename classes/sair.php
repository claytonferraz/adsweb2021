<?php
session_start();
//Destroi todas as vari�veis globais usadas para conex�o
session_unset();
//Destruindo a sess�o:
session_destroy();
header("Location: ../login.php");
?>