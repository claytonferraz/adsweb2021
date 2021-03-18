<?php
//Iniciando a sessão:
require "../classes/verifica.php";
require_once ('../classes/conexao.php');
$cnpj       = $_SESSION['usuarioCNPJ'];

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $sql = "DELETE FROM usuarios WHERE cpf='$id' AND fk_cliente_cnpj='$cnpj'";
    if(mysqli_query($con, $sql))
    {
        header("Location: http://localhost/admin/listarUsuario.php");
    }
    else
    {
        echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/admin/listarUsuario.php'>
            <script type='text/javascript'>
            alert('Erro ao tentar excluir usuario');
            </script>
            ";
    }

}
else
{
    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/admin/listarUsuario.php'>
            <script type='text/javascript'>
            alert('Erro ao tentar excluir usuario');
            </script>
            ";
}


?>