<?php
//Iniciando a sessão:
require "../classes/verifica.php";
require_once ('../classes/conexao.php');
$cnpj = $_SESSION['usuarioCNPJ'];
if(!empty($_POST['cod']) && !empty($_POST['t_minimo']) && !empty($_POST['t_maximo']) && !empty($_POST['descricao']) && !empty($_POST['status']))
{
    $cod        = $_POST['cod'];
    $t_minimo   = str_replace(',', '.', $_POST['t_minimo']);
    $t_maximo   = str_replace(',', '.', $_POST['t_maximo']);
    $u_minimo   = str_replace(',', '.', $_POST['u_minimo']);
    $u_maximo   = str_replace(',', '.', $_POST['u_maximo']);
    $descricao  = $_POST['descricao'];
    $status     = $_POST['status'];

    //se não tiver temperatura
    if(empty($_POST['u_minimo']) && empty($_POST['u_maximo']))
    {
        $sql = "UPDATE termometro SET descricao='$descricao',t_minimo=$t_minimo,t_maximo=$t_maximo,fk_status_termometro_cod=$status
                WHERE fk_cliente_cnpj='$cnpj' AND cod='$cod'";

        if(mysqli_query($con, $sql))
        {
            header("Location: ../listarTermometro.php");
        }
        else
        {
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/admin/editarTermometro.php'>
                <script type='text/javascript'>
                alert('Erro ao editar Termometro');
                </script>";
        }
    }
    //se houver temperatura
    else if(!empty($_POST['u_minimo']) && !empty($_POST['u_maximo']))
    {
        $sql = "UPDATE termometro SET descricao='$descricao',t_minimo=$t_minimo,t_maximo=$t_maximo,u_minimo=$u_minimo,u_maximo=$u_maximo,fk_status_termometro_cod=$status
                WHERE fk_cliente_cnpj='$cnpj' AND cod='$cod'";

        if(mysqli_query($con, $sql))
        {
            header("Location: ../listarTermometro.php");
        }
        else
        {
            echo "
                <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/admin/editarTermometro.php'>
                <script type='text/javascript'>
                alert('Erro ao editar Termometro');
                </script>";
        }
    }
    else
        echo "
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/admin/editarTermometro.php'>
        <script type='text/javascript'>
        alert('Verifique se todos os campos foram preenchidos');
        </script>
        ";
}
else
{
    echo "
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/admin/editarTermometro.php'>
        <script type='text/javascript'>
        alert('Verifique se todos os campos foram preenchidos');
        </script>
        ";
}
?>