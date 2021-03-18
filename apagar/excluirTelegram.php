<?php
//Iniciando a sessão:
require "../classes/verifica.php";
require_once ('../classes/conexao.php');
$cnpj       = $_SESSION['usuarioCNPJ'];

if(isset($_GET['chat']))
{
    $chat = $_GET['chat'];
    $sql = "DELETE FROM telegram WHERE chat_id='$chat' AND fk_cliente_cnpj='$cnpj'";
    if(mysqli_query($con, $sql))
    {
        header("Location: http://localhost/admin/listarTelegram.php");
    }
    else
    {
        echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/admin/listarTelegram.php'>
            <script type='text/javascript'>
            alert('Erro ao tentar excluir um telegram');
            </script>
            ";
    }

}
else
{
    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/admin/listarTelegram.php'>
            <script type='text/javascript'>
            alert('Erro ao tentar excluir um telegram');
            </script>
            ";
}


?>