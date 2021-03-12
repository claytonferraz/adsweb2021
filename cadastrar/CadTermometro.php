<?php
require "../classes/verifica.php";
require_once ('../classes/conexao.php');

if(!empty($_POST['cod']) && !empty($_POST['t_minimo']) && !empty($_POST['t_maximo']) && !empty($_POST['descricao']))
{
    $cod        = $_POST['cod'];
    $t_minimo   = str_replace(',', '.', $_POST['t_minimo']);
    $t_maximo   = str_replace(',', '.', $_POST['t_maximo']);
    $u_minimo   = str_replace(',', '.', $_POST['u_minimo']);
    $u_maximo   = str_replace(',', '.', $_POST['u_maximo']);
    $descricao  = $_POST['descricao'];
    $cnpj       = $_SESSION['usuarioCNPJ'];

    if(empty($_POST['u_minimo']) && empty($_POST['u_maximo']))
    {
        $sql = "INSERT INTO termometro(cod, descricao, t_minimo, t_maximo, fk_cliente_cnpj, fk_status_termometro_cod) VALUES ('$cod','$descricao',$t_minimo,$t_maximo,'$cnpj',1)";

        if(mysqli_query($con, $sql))
        {
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://termonline.com.br/admin/addTermometro.php'>
            <script type='text/javascript'> alert('Termometro salva com sucesso!');
            </script>
            ";
        }
        else
        {
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://termonline.com.br/admin/addTermometro.php'>
            <script type='text/javascript'>
            alert('Erro ao salvar Termometro');
            </script>
            ";
        }
    }
    else if(!empty($_POST['u_minimo']) && !empty($_POST['u_maximo']))
    {
        $sql = "INSERT INTO termometro(cod, descricao, t_minimo, t_maximo, u_minimo, u_maximo, fk_cliente_cnpj, fk_status_termometro_cod) VALUES ('$cod','$descricao',$t_minimo,$t_maximo,$u_minimo,$u_maximo,'$cnpj',1)";
        
        if(mysqli_query($con, $sql))
        {
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://termonline.com.br/admin/addTermometro.php'>
            <script type='text/javascript'> alert('Termometro salva com sucesso!');
            </script>
            ";
        }
        else
        {
            echo "
            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://termonline.com.br/admin/addTermometro.php'>
            <script type='text/javascript'>
            alert('Erro ao salvar Termometro');
            </script>
            ";
        }
    }
    else
        echo "
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://termonline.com.br/admin/addTermometro.php'>
        <script type='text/javascript'>
        alert('Verifique se todos os campos foram preenchidos');
        </script>
        ";
}
else
    echo "
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://termonline.com.br/admin/addTermometro.php'>
        <script type='text/javascript'>
        alert('Verifique se todos os campos foram preenchidos');
        </script>
        ";
?>