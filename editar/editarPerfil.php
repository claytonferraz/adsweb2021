<?php
//Iniciando a sess�o:
require "../classes/verifica.php";
require_once ('../classes/conexao.php');
$cnpj = $_SESSION['usuarioCNPJ'];
if(isset($_POST['cpf']) && (isset($_POST['nome'])) && (isset($_POST['confirma'])))
{
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $senha = $_POST['senha'];
    $senha2 = $_POST['confirma'];

    if ($senha != $senha2)
    {
        echo "
            <meta http-equiv=REFRESH content='0;URL=https://localhost/admin/listarUsuario.php' />
            <script type='text/javascript'>
                    alert('O campo de confirmacao possui uma senha diferente');
            </script>
            ";
    }
    else
    {
        if($senha != NULL)
        {
            $senha = md5($senha);
            $sql = "UPDATE usuarios SET senha='$senha', nome='$nome',sobrenome='$sobrenome' WHERE cpf='$cpf' AND fk_cliente_cnpj='$cnpj'";
            if(mysqli_query($con, $sql))
            {
                header("Location: ../dashboard.php");
            }
            else
            {
                echo "
                    <meta http-equiv=REFRESH content='0;URL=https://localhost/admin/dashboard.php' />
                    <script type='text/javascript'>
                                alert('Erro ao atualizar seu perfil');
                    </script>
                    ";
            }
        }
        else
        {
            $sql = "UPDATE usuarios SET nome='$nome',sobrenome='$sobrenome' WHERE cpf='$cpf' AND fk_cliente_cnpj='$cnpj'";
            if(mysqli_query($con, $sql))
            {
                header("Location: ../dashboard.php");
            }
            else
            {
                echo "
                    <meta http-equiv=REFRESH content='0;URL=https://localhost/admin/dashboard.php' />
                    <script type='text/javascript'>
                                alert('Erro ao atualizar seu perfil');
                    </script>
                    ";
            }
        }
    }



}
else
{
    echo "
        <meta http-equiv=REFRESH content='0;URL=https://localhost/admin/listarUsuario.php' />
        <script type='text/javascript'>
                alert('Todos os campos obrigat�rios precisam ser preencidos');
        </script>
        ";
}
?>