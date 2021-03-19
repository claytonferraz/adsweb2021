<?php
require "../classes/verifica.php";
if($_SESSION['usuarioPermissao'] != "1")
    header("Location: ../dashboard.php");
require_once ('../classes/conexao.php');
$meunome = $_SESSION['usuarioNome'];
$cod = $_GET['id'];
$sql = "SELECT valor, cod_barras, vencimento, pago, fk_cliente_cnpj FROM boletos WHERE cod=$cod";
$resultado  = mysqli_query($con, $sql);

$row        = mysqli_fetch_assoc($resultado);
$valor      = $row ['valor'];
$barras     = $row ['cod_barras'];
$data       = $row ['vencimento'];
$pago       = $row ['pago'];
$cnpj       = $row ['fk_cliente_cnpj'];
$ano = substr($data,0,4);
$mes = substr($data,5,2);
$dia = substr($data,8,2);
$vencimento = $dia . '/' . $mes . '/' . $ano
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Administrativo</title>
    <meta name="description" content="Sistema automatizado para termometria. Tenha relatórios em poucos cliques e alertas em tempo real sobre problemas de temperatura." />
    <link rel="apple-touch-icon" href="../imagens/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="../imagens/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="../imagens/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="../imagens/favicons/manifest.json">
    <link rel="mask-icon" href="../imagens/favicons/safari-pinned-tab.svg" color="#563d7c">
    <link rel="icon" href="../imagens/favicons/favicon.ico">
    <meta name="msapplication-config" content="../imagens/favicons/browserconfig.xml">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/fontawesome.min.css">
    <script defer src="../js/all.min.js"></script>
    
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
                        <img class="rounded-circle" src="../imagens/usuario.png" width="20" height="20" />
                        &nbsp;<span class="d-none d-sm-inline"><?php echo $meunome ?></span>
                    </a>
                    <div class="dropdown-menu" dropdown-menu-lg-right aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" dropdown-menu-lg-right href="#"><i class="fas fa-user"></i> Perfil</a>
                        <a class="dropdown-item" dropdown-menu-lg-right href="../classes/sair.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="d-flex">
        <nav class="sidebar">
            <ul class="list-unstyled">
                <li class="active"><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li>
                    <a href="#cliente" data-toggle="collapse">
                        <i class="fas fa-users"></i> Clientes
                    </a>
                    <ul class="list-unstyled collapse" id="cliente">
                        <li><a href="addClientes.php"><i class="fas fa-plus-square"></i> Adicionar</a></li>
                        <li><a href="listarClientes.php"><i class="fas fa-clipboard-list"></i> Listar</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#financeiro" data-toggle="collapse">
                        <i class="fas fa-hand-holding-usd"></i> Financeiro
                    </a>
                    <ul class="list-unstyled collapse" id="financeiro">
                    <li><a href="addBoleto.php"><i class="fas fa-plus-square"></i> Adicionar</a></li>
                        <li><a href="listarBoletos.php"><i class="fas fa-clipboard-list"></i> Listar</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#contrato" data-toggle="collapse">
                        <i class="fas fa-file-contract"></i> Contratos
                    </a>
                    <ul class="list-unstyled collapse" id="contrato">
                        <li><a href="addContrato.php"><i class="fas fa-plus-square"></i> Adicionar</a></li>
                        <li><a href="listarContratos.php"><i class="fas fa-clipboard-list"></i> Listar</a></li>
                    </ul>
                </li>
                
                <li>
                    <a href="#usuario" data-toggle="collapse">
                        <i class="fas fa-user-shield"></i> Usuários
                    </a>
                    <ul class="list-unstyled collapse" id="usuario">
                        <li><a href="addUsuario.php"><i class="fas fa-plus-square"></i> Adicionar</a></li>
                        <li><a href="listarUsuario.php"><i class="fas fa-clipboard-list"></i> Listar</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#config" data-toggle="collapse">
                        <i class="fas fa-cogs"></i> Configurações
                    </a>
                    <ul class="list-unstyled collapse" id="config">
                        <li><a href="statusTermometros.php"><i class="fas fa-thermometer-quarter"></i> Status Termometros</a></li>
                        <li><a href="statusClientes.php"><i class="fas fa-users"></i> Status Clientes</a></li>
                        <li><a href="statusContrato.php"><i class="fas fa-file-contract"></i> Status Contrato</a></li>
                    </ul>
                </li>
                <br/>
                <li><a href="../classes/sair.php"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
            </ul>
        </nav>
        <!-- Inicio da área de trabalho -->
        <div class="content p-1">
            <div class="list-group-item">
                <div class="d-flex">
                    <div class="mr-auto p-2">
                        <h2 class="display-4 titulo">Editar Boleto</h2>
                    </div>
                    <a href="listarBoletos.php">
                        <div class="p-2">
                            <button class="btn btn-outline-info btn-sm">
                                Listar
                            </button>
                        </div>
                    </a>
                </div>
                <hr />
                <form action="editar/editBoleto.php?cod=<?php echo $cod ?>" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>
                                CNPJ
                            </label>
                            <input checked name="cnpj" type="text" class="form-control cnpj" id="cnpj" placeholder="Somente os números" value="<?php echo $cnpj ?>" required/>
                        </div>
                        <div class="form-group col-md-4">
                            <label>
                                Vencimento
                            </label>
                            <input checked name="vencimento" type="date" class="form-control" id="vencimento" value="<?php echo $data ?>" required/>
                        </div>
                        <div class="form-group col-md-4">
                            <label>
                                Situação
                            </label>
                            <select name="pago" class="form-control" required>
                            <option value="0" <?php if($pago == 0) echo 'selected'?>> Aguardando Pagamento</option>
                            <option value="1" <?php if($pago == 1) echo 'selected'?>> Pago</option>
                            </select>
                        </div>
                    </div>
                    <div class="
                            form-row" />
                        <div class="form-group col-md-3">
                            <label>
                                Valor
                            </label>
                            <input checked name="valor" type="text" class="form-control" id="valor" placeholder="Somente os números" value="<?php echo $valor ?>" required/>
                        </div>
                        <div class="form-group col-md-9">
                            <label>
                                Código de Barras
                            </label>
                            <input name="barras" type="text" class="form-control" id="barras" placeholder="Somente os números" value="<?php echo $barras ?>" required/>
                        </div>
                    </div>
                    <button name="cadBoleto" type="submit" class="btn btn-success">Salvar</button>
                </form>
            </div>
        </div>
        <!-- Fim da área de trabalho -->
    </div>
    <script src="../js/jquery-3.2.1.slim.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/dashboard.js"></script>
</body>
</html>
