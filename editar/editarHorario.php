<?php
require "../classes/verifica.php";
require_once ('../classes/conexao.php');
$cnpj = $_SESSION['usuarioCNPJ'];
if((isset($_POST['hora'])) && (isset($_POST['termometro'])) && (isset($_POST['minuto'])) && (isset($_GET['id'])))
{
    $id         = $_GET['id'];
    $termometro = $_POST['termometro'];
    $hora       = $_POST['hora'];
    $minuto     = $_POST['minuto'];
    $horario    = $hora . ":" . $minuto . ":00";

    $sql = "UPDATE horarios SET horario='$horario', fk_termometro_cod='$termometro'
            WHERE id_horario=$id AND fk_cliente_cnpj='$cnpj'";

    if(mysqli_query($con, $sql))
    {
        header("Location: ../listarHorarios.php");
    }
    else
    {
        echo "
            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/admin/listarHorarios.php?id=. $id .'>
            <script type='text/javascript'>
            alert('Erro ao atualizar horario');
            </script>
            ";
    }

}
else
{
    echo "
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/admin/listarHorarios.php'>
        <script type='text/javascript'>
        alert('Todos os campos obrigatorios precisam ser preencidos');
        </script>
        ";
}
?>
