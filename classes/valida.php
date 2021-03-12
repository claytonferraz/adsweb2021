<?php
if (session_status() !== PHP_SESSION_ACTIVE)
{
    //session_cache_expire(60);
    session_start();
}

//Incluindo a conexão com banco de dados
include_once("conexao.php");
if(isset($_POST['login']) && (isset($_POST['senha'])))
{
    //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
    $usuario = mysqli_real_escape_string($con, $_POST['login']);
    $senha   = mysqli_real_escape_string($con, $_POST['senha']);
    $senha   = md5($senha);

    //Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
    $sql        = "SELECT cpf, nome, sobrenome, fk_cliente_cnpj, fk_permissao_cod, fk_nivel_acesso_cod FROM usuarios WHERE cpf = '$usuario' && senha = '$senha' LIMIT 1";
    $comando    = mysqli_query($con, $sql);
    $resultado  = mysqli_fetch_assoc($comando);

    //Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
    if(isset($resultado))
    {
        $cpf         = $resultado['cpf'];
        $nome        = $resultado['nome'];
        $sobrenome   = $resultado['sobrenome'];
        $cnpj        = $resultado['fk_cliente_cnpj'];
        $permissao   = $resultado['fk_permissao_cod'];
        $nivel       = $resultado['fk_nivel_acesso_cod'];

        //verifica o status do cnpj
        $sql        = "SELECT fk_status_geral_cod AS blok FROM cliente WHERE cnpj='$cnpj'";
        $comando    = mysqli_query($con, $sql);
        $row  = mysqli_fetch_assoc($comando);
        $bloqueio = $row['blok'];
        //verifica o se é um cliente ou um Administrador do sistema que está logando
        if($permissao == 1)
        {
            $_SESSION['usuarioCPF']         = $cpf;
            $_SESSION['usuarioNome']        = $nome;
            $_SESSION['usuarioSobreNome']   = $sobrenome;
            $_SESSION['usuarioPermissao']   = $permissao;
            $_SESSION['usuarioNivel']       = $nivel;
            $_SESSION['usuarioCNPJ']        = $cnpj;
            header("Location: ../master/dashboard.php");
        }
        elseif($permissao == 2 && $bloqueio != 2)
        {
            if($nivel != 3)
            {
                $_SESSION['usuarioCPF']         = $cpf;
                $_SESSION['usuarioNome']        = $nome;
                $_SESSION['usuarioSobreNome']   = $sobrenome;
                $_SESSION['usuarioCNPJ']        = $cnpj;
                $_SESSION['usuarioPermissao']   = $permissao;
                $_SESSION['usuarioNivel']       = $nivel;
                header("Location: ../dashboard.php");
            }
            else
            {
                $_SESSION['loginErro'] = "Voce esta temporariamente sem permissao";
                header("Location: ../login.php");
            }
        }
        else
        {
            //Váriavel global recebendo a mensagem de erro
            $_SESSION['loginErro'] = "Voce esta temporariamente sem permissao";
            header("Location: ../login.php");
        }
    }
    else
    {
        //Váriavel global recebendo a mensagem de erro
        $_SESSION['loginErro'] = "Usuario ou senha Invalido";
        header("Location: ../login.php");
    }

}
else
{
    $_SESSION['loginErro'] = "Usuario ou senha invalido";
    header("Location: ../login.php");
}
?>
