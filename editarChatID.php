//corrigido
<?php
require "classes/verifica.php";
require_once ('classes/conexao.php');
$meunome = $_SESSION['usuarioNome'];
$cnpj    = $_SESSION['usuarioCNPJ'];
$chat = $_GET['chat'];
$sql = "SELECT nome FROM telegram WHERE fk_cliente_cnpj='$cnpj' AND chat_id='$chat'";
$resultado = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($resultado)
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
                        <i class="fas fa-clock"></i> Hor??rios de Leituras
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
                        <i class="fas fa-users"></i> Usu??rios
                    </a><?php if($_SESSION['usuarioNivel'] == 1){ ?>
                    <ul class="list-unstyled collapse" id="usuarios">
                        <li><a href="addUsuario.php"><i class="fas fa-plus-square"></i> Adicionar</a></li>
                        <li><a href="listarUsuario.php"><i class="fas fa-clipboard-list"></i> Listar</a></li>
                    </ul><?php } ?>
                </li>
                <li class="active"><a href="#"><i class="fas fa-key"></i> Permiss??es</a></li>
                <li><a href="boletos.php"><i class="fas fa-file-invoice-dollar"></i> Boletos</a></li>
                <br />
                <li><a href="classes/sair.php"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
            </ul>
        </nav>
        <!-- Inicio da ??rea de trabalho -->
        <div class="content p-1">
            <div class="list-group-item">
                <div class="d-flex">
                    <div class="mr-auto p-2">
                        <h2 class="display-4 titulo">Editar Telegram</h2>
                    </div>
                    <div class="p-2">
                    <span class="d-none d-md-block">
                        <a href="listarTelegram.php" class="btn btn-outline-primary btn-sm">Listar</a>
                        <a href="apagar/excluirTelegram.php?chat=<?php echo $chat ?>" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#apagarRegistro">Apagar</a>
                    </span>
                    <div class="dropdown d-block d-md-none">
                        <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="acaoListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            A????o
                        </button>
                        <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="acaoListar">
                            <a class="dropdown-item" href="listarTelegram.php">Listar</a>
                            <a class="dropdown-item" href="apagar/excluirTelegram.php?chat=<?php echo $chat ?>" data-toggle="modal" data-target="#apagarRegistro">Apagar</a>
                        </div>
                    </div>
                </div>
                </div><hr />
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Chat ID</label>
                            <input name="cod" type="text" class="form-control" id="cod" required value="<?php echo $chat ?>" placeholder="Chat ID do Telegram" />
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nome</label>
                            <input name="alarme" type="text" class="form-control" id="alarme" required value="<?php echo $row['nome'] ?>" placeholder="Nome do Usu??rio do Telegram" />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Atualizar</button>
                </form>
            </div>
        </div>
        <!-- Fim da ??rea de trabalho -->
    </div>
    <!-- Mensagem de confirmar apagar -->
    <div class="modal fade" id="apagarRegistro" tabindex="-1" aria-labelledby="apagarRegistroLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel">EXCLUIR TELEGRAM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja excluir este Telegram?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">N??o</button>
                    <button type="button" class="btn btn-danger">Sim</button>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/dashboard.js"></script>
</body>
</html>
