<?php
    require "../classes/verifica.php";
    require_once ('../classes/conexao.php');

    if(isset($_POST['termometro']) && (isset($_POST['hora'])) && (isset($_POST['minuto'])))
    {
        $termometro = $_POST['termometro'];
        $hora       = $_POST['hora'] . ":" . $_POST['minuto'] . ":00";
        $cnpj       = $_SESSION['usuarioCNPJ'];

        $sql = "SELECT id_horario FROM horarios WHERE horario='$hora' AND fk_termometro_cod='$termometro' AND fk_cliente_cnpj='$cnpj'";
        $resultado   = mysqli_query($con, $sql);
        $row         = mysqli_fetch_assoc($resultado);
        $temHorario  = $row ['id_horario'];
        if($temHorario == NULL)
        {
            $sql = "INSERT INTO horarios(horario, fk_termometro_cod, fk_cliente_cnpj) VALUES ('$hora','$termometro','$cnpj')";

            if(mysqli_query($con, $sql))
            {
                echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://termonline.com.br/admin/addHorarios.php'>
                <script type='text/javascript'> alert('Horario salva com sucesso!');
                </script>
                ";
            }
            else
            {
                echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://termonline.com.br/admin/addHorarios.php'>
                <script type='text/javascript'>
                alert('Erro ao salvar horario');
                </script>
                ";
            }
        }
        else
        {
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://termonline.com.br/admin/addHorarios.php'>
            <script type='text/javascript'>
            alert('O horario escolhido ja esta cadastrado para esse termometro');
            </script>
            ";
        }

    }
    else
    {
        echo "
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://termonline.com.br/admin/addTermometro.php'>
        <script type='text/javascript'>
        alert('Todos os campos obrigatorios precisam ser preencidos');
        </script>
        ";
    }

?>