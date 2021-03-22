<?php

require_once ('Classes/Conexao.php');
$termometro = $_GET['maquina'];
$temperatura = $_GET['temperatura'];
//checa se veio alguma informa��o do termometro
if($termometro != '' & $temperatura != '')
{
    //pega a descri��o do termometro e a temperatura de alarme
    $result_maquina = "SELECT descricao_termometro, alarme FROM program2_termometro.termometros WHERE id_termometro = $termometro";
    $resultado_maquina = mysqli_query($con, $result_maquina);
    while($row_maquina = mysqli_fetch_assoc($resultado_maquina))
    {
        $maquina = $row_maquina['descricao_termometro'];
        $alarme = $row_maquina['alarme'];
    }
    $maquina = preg_replace("/[�����]/", "A", $maquina);
    $maquina = preg_replace("/[�����]/", "A", $maquina);
    $maquina = preg_replace("/[���]/", "E", $maquina);
    $maquina = preg_replace("/[���]/", "E", $maquina);
    $maquina = preg_replace("/[��]/", "I", $maquina);
    $maquina = preg_replace("/[��]/", "I", $maquina);
    $maquina = preg_replace("/[�����]/", "O", $maquina);
    $maquina = preg_replace("/[�����]/", "O", $maquina);
    $maquina = preg_replace("/[���]/", "U", $maquina);
    $maquina = preg_replace("/[���]/", "U", $maquina);
    $maquina = preg_replace("/[�]/", "C", $maquina);
    $maquina = preg_replace("/[�]/", "C", $maquina);
    $maquina = preg_replace("/[�]/", "N", $maquina);
    $maquina = preg_replace("/[�]/", "N", $maquina);
    $maquina = preg_replace("/[a]/", "A", $maquina);
    $maquina = preg_replace("/[b]/", "B", $maquina);
    $maquina = preg_replace("/[c]/", "C", $maquina);
    $maquina = preg_replace("/[d]/", "D", $maquina);
    $maquina = preg_replace("/[e]/", "E", $maquina);
    $maquina = preg_replace("/[f]/", "F", $maquina);
    $maquina = preg_replace("/[g]/", "G", $maquina);
    $maquina = preg_replace("/[h]/", "H", $maquina);
    $maquina = preg_replace("/[i]/", "I", $maquina);
    $maquina = preg_replace("/[j]/", "J", $maquina);
    $maquina = preg_replace("/[k]/", "K", $maquina);
    $maquina = preg_replace("/[l]/", "L", $maquina);
    $maquina = preg_replace("/[m]/", "M", $maquina);
    $maquina = preg_replace("/[n]/", "N", $maquina);
    $maquina = preg_replace("/[o]/", "O", $maquina);
    $maquina = preg_replace("/[p]/", "P", $maquina);
    $maquina = preg_replace("/[q]/", "Q", $maquina);
    $maquina = preg_replace("/[r]/", "R", $maquina);
    $maquina = preg_replace("/[s]/", "S", $maquina);
    $maquina = preg_replace("/[t]/", "T", $maquina);
    $maquina = preg_replace("/[u]/", "U", $maquina);
    $maquina = preg_replace("/[v]/", "V", $maquina);
    $maquina = preg_replace("/[y]/", "Y", $maquina);
    $maquina = preg_replace("/[z]/", "Z", $maquina);
    $maquina = preg_replace("/[x]/", "X", $maquina);
    //echo "Temperatura: ".$temperatura;
    //echo "<br>Maquina: ".$maquina;
    //echo "<br>Temp Alarme: ".$alarme;
    //checa se a temperatura est� igual ou maior que o alarme
    if($alarme <= $temperatura)
    {
        $result_telegram = "SELECT token, chat_id FROM program2_termometro.telegran";
        $resultado_telegram = mysqli_query($con, $result_telegram);
        while($row_telegram = mysqli_fetch_assoc($resultado_telegram))
        {
            $token = $row_telegram['token'];
            $chat_id = $row_telegram['chat_id'];
            $mensagem="Ola! Eu sou o termometro, {$maquina}. Fiz uma leitura de {$temperatura}C e isso me fez deduzir que algo pode estar errado, recomendo que alguma pessoa venha identificar o motivo.";
            $url = "https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chat_id."&text=".$mensagem;
            $retorno = file_get_contents($url);
            //echo "<br>Mensagem Enviada com Sucesso! ".$retorno;
        }
    }
    else
    {
        echo "Voc� n�o tem permiss�o de acessar essa p�gina";
    }
}
else
{
    echo "Voc� n�o tem permiss�o de acessar essa p�gina";
}

?>

