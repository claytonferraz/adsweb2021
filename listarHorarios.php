<?php
require "classes/verifica.php";
require_once ('classes/conexao.php');
//Verifica se o usuário está passando o número da página, se não, ele coloca a primeira página
$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
//echo "Página: " . $pagina . "<br>";
$cnpj = $_SESSION['usuarioCNPJ'];
$meunome = $_SESSION['usuarioNome'];
//para contar a quantidade de registros
$sql = "SELECT hora.id_horario, hora.horario, termo.descricao
            FROM termometro AS termo INNER JOIN horarios AS hora ON termo.cod = hora.fk_termometro_cod
            WHERE hora.fk_cliente_cnpj='$cnpj' ORDER BY hora.id_horario ASC";
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
                        <h2 class="display-4 titulo">Listar Horários</h2>
                    </div>
                    <a href="addHorarios.php">
                        <div class="p-2">
                            <button class="btn btn-outline-success btn-sm">
                                Cadastrar
                            </button>
                        </div>
                    </a>
                </div><!--
                <div class="alert alert-success" role="alert">
                    Horário apagado com sucesso!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>-->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Hora</th><!-- class="d-nome d-sm-table-cell" (usado para sumir quando visto de smathfone)-->
                                <th>Termômetro</th>
                                <th class="text-center">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            while($row = mysqli_fetch_assoc($resultado))
                            {?>
                                <tr>
                                    <td><?php echo $row['horario'] ?></td>
                                    <td><?php echo $row['descricao'] ?></td>
                                    <td class="text-center">
                                        <span class="d-none d-md-block">
                                            <a href="editarHorario.php?id=<?php $id = $row['id_horario']; echo $id ?>" class="btn btn-outline-primary btn-sm">Editar</a>
                                            <a href="apagar/excluirHorario.php?id=<?php echo $id ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Tem certeza da exclusão deste horário?')">Apagar</a>
                                        </span>
                                        <div class="dropdown d-block d-md-none">
                                            <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="acaoListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Ação
                                            </button>
                                            <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="acaoListar">
                                                <a class="dropdown-item" href="editarHorario.php?id=<?php echo $id ?>">Editar</a>
                                                <a class="dropdown-item" href="apagar/excluirHorario.php?id=<?php echo $id ?>" onclick="return confirm('Tem certeza da exclusão deste horário?')" >Apagar</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr><?php
                            }
                        ?>
                        </tbody>
                    </table><!--
                    <nav aria-label="paginacao">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Próxima</a>
                            </li>
                        </ul>
                    </nav>-->
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