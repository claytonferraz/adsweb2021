<?php
//Iniciando a sessão:
require "../classes/verifica.php";
require_once ('../classes/conexao.php');
$cnpj = $_SESSION['usuarioCNPJ'];
if(isset($_POST['cpf']) && (isset($_POST['nome'])) && (isset($_POST['confirma'])))
{
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $nivel = $_POST['nivel'];
    $senha = $_POST['senha'];
    $senha2 = $_POST['confirma'];

    if ($senha != $senha2)
    {
        echo "
            <meta http-equiv=REFRESH content='0;URL=http://localhost/admin/listarUsuario.php' />
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
            $sql = "UPDATE usuarios SET senha='$senha', nome='$nome',sobrenome='$sobrenome', fk_nivel_acesso_cod=$nivel WHERE cpf='$cpf' AND fk_cliente_cnpj='$cnpj'";
            if(mysqli_query($con, $sql))
            {
                header("Location: ../listarUsuario.php");
            }
            else
            {
                echo "
                    <meta http-equiv=REFRESH content='0;URL=http://localhost/admin/listarUsuario.php' />
                    <script type='text/javascript'>
                                alert('Erro ao atualizar usuario');
                    </script>
                    ";
            }
        }
        else
        {
            $sql = "UPDATE usuarios SET nome='$nome',sobrenome='$sobrenome', fk_nivel_acesso_cod=$nivel WHERE cpf='$cpf' AND fk_cliente_cnpj='$cnpj'";
            if(mysqli_query($con, $sql))
            {
                header("Location: ../listarUsuario.php");
            }
            else
            {
                echo "
                    <meta http-equiv=REFRESH content='0;URL=http://localhost/admin/listarUsuario.php' />
                    <script type='text/javascript'>
                                alert('Erro ao atualizar usuario');
                    </script>
                    ";
            }
        }
    }



}
else
{
    echo "
        <meta http-equiv=REFRESH content='0;URL=http://localhost/admin/listarUsuario.php' />
        <script type='text/javascript'>
                alert('Todos os campos obrigatórios precisam ser preencidos');
        </script>
        ";
}
?>