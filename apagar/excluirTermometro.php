<?php
//Iniciando a sessão:
require "../classes/verifica.php";
require_once ('../classes/conexao.php');
$cnpj       = $_SESSION['usuarioCNPJ'];

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $sql = "DELETE FROM termometro WHERE cod='$id' AND fk_cliente_cnpj='$cnpj'";
    if(mysqli_query($con, $sql))
    {
        header("Location: https://localhost/admin/listarTermometro.php");
    }
    else
    {
        echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://localhost/admin/listarTermometro.php'>
            <script type='text/javascript'>
            alert('Erro ao tentar excluir um termometro');
            </script>
            ";
    }

}
else
{
    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://localhost/admin/listarTermometro.php'>
            <script type='text/javascript'>
            alert('Erro ao tentar excluir um termometro');
            </script>
            ";
}


?>