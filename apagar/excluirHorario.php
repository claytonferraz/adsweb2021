<?php

require "../classes/verifica.php";
require_once ('../classes/conexao.php');
$cnpj       = $_SESSION['usuarioCNPJ'];

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $sql = "DELETE FROM horarios WHERE id_horario=$id AND fk_cliente_cnpj='$cnpj'";

    if(mysqli_query($con, $sql))
    {
        header("Location: ../listarHorarios.php");
    }
    else
    {
        echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/admin/listarTermometro.php'>
            <script type='text/javascript'>
            alert('Erro ao tentar excluir um horario');
            </script>
            ";
    }

}
else
{
    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/admin/listarTermometro.php'>
            <script type='text/javascript'>
            alert('Erro ao tentar excluir um horario');
            </script>
            ";
}


?>
