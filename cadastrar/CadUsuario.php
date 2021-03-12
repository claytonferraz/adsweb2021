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
    if(isset($_POST['cpf']) && (isset($_POST['senha'])) && (isset($_POST['confima'])) && (isset($_POST['nome'])) && (isset($_POST['permissao'])))
    {
        $cpf            = $_POST['cpf'];
        $senha          = $_POST['senha'];
        $confirmaSenha  = $_POST['confima'];
        $nome           = $_POST['nome'];
        $sobreNome      = $_POST['sobrenome'];
        $permissao      = $_POST['permissao'];
        $cnpj = $_SESSION['usuarioCNPJ'];

        if($senha != $confirmaSenha)
        {
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://localhost/admin/addUsuario.php'>
            <script type='text/javascript'> alert('Sua senha deve ser igual a confirmada!');
            </script>
            ";
        }
        else
        {
            $senha = md5($senha);
            $sql = "INSERT INTO usuarios(cpf, senha, nome, sobrenome, fk_cliente_cnpj, fk_permissao_cod, fk_nivel_acesso_cod)
                    VALUES ('$cpf','$senha','$nome','$sobreNome','$cnpj',2,$permissao)";

            if(mysqli_query($con, $sql))
            {
                echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://localhost/admin/addUsuario.php'>
            <script type='text/javascript'> alert('Usuario salva com sucesso!');
            </script>
            ";
            }
            else
            {
                echo "
            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://localhost/admin/addUsuario.php'>
            <script type='text/javascript'>
            alert('Erro ao salvar usuario');
            </script>
            ";
            }
        }
    }
    else
    {
        echo "
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://localhost/admin/addUsuario.php'>
        <script type='text/javascript'>
        alert('Todos os campos obrigatorios precisam ser preencidos');
        </script>
        ";
    }
?>