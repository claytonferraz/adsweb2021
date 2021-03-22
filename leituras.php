<?php
    require "classes/verifica.php";
    require_once ('classes/conexao.php');
    $cnpj = $_SESSION['usuarioCNPJ'];
    $meunome = $_SESSION['usuarioNome'];
    $hoje = date('Y-m-d');
    $hoje = $hoje . ' 00:00:00';
    $sql = "SELECT leit.temperatura, leit.umidade, leit.data, termo.descricao
            FROM termometro AS termo INNER JOIN leituras AS leit ON termo.cod = leit.fk_termometro_cod
            WHERE leit.fk_cliente_cnpj='$cnpj' AND leit.data>='$hoje' ORDER BY leit.data DESC";//leit.volt, 
    $resultado = mysqli_query($con, $sql);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Administrativo</title>
    <link rel="apple-touch-icon" href="imagens/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="imagens/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="imagens/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="imagens/favicons/manifest.json">
    <link rel="mask-icon" href="imagens/favicons/safari-pinned-tab.svg" color="#563d7c">
    <link rel="icon" href="imagens/favicons/favicon.ico">
    <meta name="msapplication-config" content="imagens/favicons/browserconfig.xml">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <script defer src="js/all.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <a class="sidebar-toggle text-lith mr-3">
            <span class="navbar-toggler-icon"></span>
        </a>
        <a class="navbar-brand" href="#">Termonmetro Inteligente - ADMIN</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown">
                        <img class="rounded-circle" src="imagens/usuario.png" width="20" height="20" />
                        &nbsp;<span class="d-none d-sm-inline"><?php echo $meunome ?></span>
                    </a>
                    <div class="dropdown-menu" dropdown-menu-lg-right aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" dropdown-menu-lg-right href="editarPerfil.php?id=<?php echo $_SESSION['usuarioCPF'] ?>">
                            <i class="fas fa-user"></i> Perfil
                        </a>
                        <a class="dropdown-item" dropdown-menu-lg-right href="classes/sair.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="d-flex">
        <nav class="sidebar">
            <ul class="list-unstyled">
                <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li>
                    <a href="#termometro" data-toggle="collapse">
                        <i class="fas fa-temperature-low"></i> Termometros
                    </a>
                    <ul class="list-unstyled collapse" id="termometro">
                        <li><a href="addTermometro.php"><i class="fas fa-plus-square"></i> Adicionar</a></li>
                        <li><a href="listarTermometro.php"><i class="fas fa-clipboard-list"></i> Listar</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#horario" data-toggle="collapse">
                        <i class="fas fa-clock"></i> Horários de Leituras
                    </a>
                    <ul class="list-unstyled collapse" id="horario">
                        <li><a href="addHorarios.php"><i class="fas fa-plus-square"></i> Adicionar</a></li>
                        <li><a href="listarHorarios.php"><i class="fas fa-clipboard-list"></i> Listar</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#telegram" data-toggle="collapse">
                    <i class="fab fa-telegram-plane"></i> Telegram
                    </a>
                    <ul class="list-unstyled collapse" id="telegram">
                        <li><a href="addChaID.php"><i class="fas fa-plus-square"></i> Adicionar</a></li>
                        <li><a href="listarTelegram.php"><i class="fas fa-clipboard-list"></i> Listar</a></li>
                    </ul>
                </li>
                
                <li><a href="leituras.php"><i class="far fa-clipboard"></i> Leituras</a></li>
                <li>
                    <a href="#usuarios" data-toggle="collapse">
                        <i class="fas fa-users"></i> Usuários
                    </a><?php if($_SESSION['usuarioNivel'] == 1){ ?>
                    <ul class="list-unstyled collapse" id="usuarios">
                        <li><a href="addUsuario.php"><i class="fas fa-plus-square"></i> Adicionar</a></li>
                        <li><a href="listarUsuario.php"><i class="fas fa-clipboard-list"></i> Listar</a></li>
                    </ul><?php } ?>
                </li>
                <li class="active"><a href="#"><i class="fas fa-key"></i> Permissões</a></li>
                <li><a href="boletos.php"><i class="fas fa-file-invoice-dollar"></i> Boletos</a></li>
                <br />
                <li><a href="classes/sair.php"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
            </ul>
        </nav>
        <!-- Inicio da área de trabalho -->
        <div class="content p-1">
            <div class="list-group-item">
                <div class="d-flex">
                    <div class="mr-auto p-2">
                        <form action="relatorio/Relatorio.php" method="post" target="_blank">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>
                                        Data Inicial
                                    </label>
                                    <input name="data1" type="date" class="form-control" required />
                                </div>
                                <div class="form-group col-md-4">
                                    <label>
                                        Data Final
                                    </label>
                                    <input name="data2" type="date" class="form-control" required />
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Termômetro</label>
                                    <select name="termometro" class="form-control" required>
                                        <option value="TODOS" selected>Todos</option>
                                        <?php
                                        $cnpj = $_SESSION['usuarioCNPJ'];
                                        $sql2 = "SELECT cod, descricao FROM termometro WHERE fk_cliente_cnpj = '$cnpj'";
                                        $termometros = mysqli_query($con, $sql2);
                                        while($row = mysqli_fetch_assoc($termometros))
                                        {
                                            echo '<option value="' . $row['cod'] . '">' . $row['descricao'] . '</option>';
                                        }
                                        ?>
                                    </select>
                        </div>
                            </div>
                            <button type="submit" class="btn btn-success">Gerar Relatório</button>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="d-nome d-sm-table-cell">Termômetro</th>
                                <th>Temperatura</th>
                                <th>Umidade</th>
                                <!--<th>Voltagem</th>-->
                                <th>Data/Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row = mysqli_fetch_assoc($resultado))
                                {
                                    $umid = $row['umidade'];
                                    $data = $row['data'];
                                    //$volt = $row['volt'];
                                    $ano = substr($data,0,4);
                                    $mes = substr($data,5,2);
                                    $dia = substr($data,8,2);
                                    $hora = substr($data,-8);
                                    echo '<tr><td>' . $row['descricao'] . '</td>';
                                    echo '<td>' . $row['temperatura'] . '°C</td>';
                                    if($umid == '') echo '<td>' . '--</td>';
                                    else echo '<td>' . $umid . '%</td>';
                                    /*if($volt != '')echo '<td>' . $volt . 'V</td>';
                                    else echo '<td>' . '--</td>';*/
                                    echo '<td>' . $dia . '/' . $mes . '/' . $ano . ' ' . $hora . '</td>' . '</td></tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Fim da área de trabalho -->
    </div>
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/dashboard.js"></script>
</body>
</html>