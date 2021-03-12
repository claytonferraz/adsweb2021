<?php
    require "../classes/verifica.php";
    require_once ('../classes/conexao.php');
/*
    echo $_POST['cpf'] . "<br>";
    echo $_POST['senha'] . "<br>";
    echo $_POST['confima'] . "<br>";
    echo $_POST['nome'] . "<br>";
    echo $_POST['sobrenome'] . "<br>";
    echo $_POST['permissao'] . "<br>";
    echo $_SESSION['usuarioCNPJ'] . "<br>";
    */
    if(isset($_POST['id']) && isset($_POST['nome']))
    {
        $chatId  = $_POST['id'];
        $nome    = $_POST['nome'];
        $cnpj    = $_SESSION['usuarioCNPJ'];

        $sql = "INSERT INTO telegram(chat_id, nome, fk_cliente_cnpj)
                VALUES ('$chatId','$nome','ADMIN')";

        if(mysqli_query($con, $sql))
        {
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://localhost/admin/addChaID.php'>
        <script type='text/javascript'> alert('ChatID cadastrado com sucesso!');
        </script>
        ";
        }
        else
        {
            echo "
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://localhost/admin/addChaID.php'>
        <script type='text/javascript'>
        alert('Um erro foi encontrado ao tentar salvar o ChatID');
        </script>
        ";
        }
    }
    else
    {
        echo "
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://localhost/admin/addChaID.php'>
        <script type='text/javascript'>
        alert('Todos os campos obrigatorios precisam ser preencidos');
        </script>
        ";
    }
?>