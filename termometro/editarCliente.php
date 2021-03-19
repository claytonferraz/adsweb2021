<?php
require "../classes/verifica.php";
if($_SESSION['usuarioPermissao'] != "1")
    header("Location: ../dashboard.php");
$cnpj = $_GET['cnpj'];
require_once ('../classes/conexao.php');
$meunome = $_SESSION['usuarioNome'];
$sql = "SELECT cli.ie, cli.razao, cli.fantasia, cli.dono, cli.whatsapp, cli.fixo, cli.email, cli.cep, cli.estado, cli.cidade, cli.bairro, cli.rua, cli.numero, status.descricao AS situacao
FROM status_geral AS status INNER JOIN cliente AS cli ON cli.fk_status_geral_cod = status.cod
WHERE cli.cnpj='$cnpj'";
$resultado  = mysqli_query($con, $sql);
$row      = mysqli_fetch_assoc($resultado);

$ie         = $row ['ie'];
$razao      = $row ['razao'];
$fantasia   = $row ['fantasia'];
$dono       = $row ['dono'];
$whatsapp   = $row ['whatsapp'];
$fixo       = $row ['fixo'];
$email      = $row ['email'];
$cep        = $row ['cep'];
$estado     = $row ['estado'];
$cidade     = $row ['cidade'];
$bairro     = $row ['bairro'];
$rua        = $row ['rua'];
$numero     = $row ['numero'];
$situacao   = $row ['situacao'];
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
                <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="active">
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
                        <li><a href="statusTermometros.php"><i class="fas fa-thermometer-quarter"></i> Status Termômetros</a></li>
                        <li><a href="statusClientes.php"><i class="fas fa-users"></i> Status Clientes</a></li>
                        <li><a href="nivelAcesso.php"><i class="fas fa-file-contract"></i> Nível de Acesso</a></li>
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
                        <h2 class="display-4 titulo">Adicionar Cliente</h2>
                    </div>
                    <a href="listarClientes.php">
                        <div class="p-2">
                            <button class="btn btn-outline-info btn-sm">
                                Listar
                            </button>
                        </div>
                    </a>
                </div>
                <hr />
                <form action="editar/editCliente.php" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>
                                <span class="text-danger">*</span> Status
                            </label>
                            <select name="status" class="form-control">
                                <?php
                                $sql = "SELECT cod, descricao FROM status_geral";
                                $statusGeral = mysqli_query($con, $sql);
                                while($row = mysqli_fetch_assoc($statusGeral))
                                {
                                    $id_status = $row['cod'];
                                    if($situacao != $id_status)
                                    {
                                        echo '<option value="' . $id_status . '">' . $row['descricao'] . '</option>';
                                    }
                                    else
                                    {
                                        echo '<option selected value="' . $id_status . '">' . $row['descricao'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>CNPJ
                            </label>
                            <input readonly name="cnpj" type="text" class="form-control cnpj" id="cnpj" placeholder="Somente os números" value="<?php echo $cnpj?>" required onkeypress="$(this).mask('00.000.000/0000-00')" />
                        </div>
                        <div class="form-group col-md-6">
                            <label>Inscrição Estadual
                            </label>
                            <input name="ie" type="text" class="form-control" id="ie" placeholder="Somente os números" value="<?php echo $ie?>" required/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Razão Social
                            </label>
                            <input name="razao" type="text" class="form-control" id="razao" value="<?php echo $razao?>" required/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Nome Fantasia
                            </label>
                            <input name="fantasia" type="text" class="form-control" id="fantasia" value="<?php echo $fantasia?>" required/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label>Contato
                            </label>
                            <input name="contato" type="text" class="form-control" id="contato" placeholder="Ex. Maicon Gonzaga" value="<?php echo $dono?>" required/>
                        </div>
                        <div class="form-group col-md-4">
                            <label>WhatsApp
                            </label>
                            <input name="whats" type="text" class="form-control" id="whats" placeholder="Somente Números" value="<?php echo $whatsapp?>" onkeypress="$(this).mask('(00)00000-00009')" required/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>
                                Telefone Fixo
                            </label>
                            <input name="fixo" type="text" class="form-control" id="fixo" placeholder="Somente Números" value="<?php echo $fixo?>" onkeypress="$(this).mask('(00)0000-00009')" />
                        </div>
                        <div class="form-group col-md-8">
                            <label>Email
                            </label>
                            <input name="email" type="text" class="form-control" id="email" placeholder="exemplo@gmail.com" value="<?php echo $email?>" required/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label>CEP
                            </label>
                            <input name="cep" type="text" class="form-control" id="cep" placeholder="Apenas Números" onblur="pesquisacep(this.value);" value="<?php echo $cep?>" onkeypress="$(this).mask('00000-000')" required/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-1">
                            <label>UF
                            </label>
                            <input name="uf" type="text" class="form-control" id="uf" value="<?php echo $estado?>" required/>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Cidade
                            </label>
                            <input name="cidade" type="text" class="form-control" id="cidade" value="<?php echo $cidade?>" required/>
                        </div>
                        <div class="form-group col-md-5">
                            <label>Bairro
                            </label>
                            <input name="bairro" type="text" class="form-control" id="bairro" value="<?php echo $bairro?>" required/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-10">
                            <label>Rua
                            </label>
                            <input name="rua" type="text" class="form-control" id="rua" value="<?php echo $rua?>" required/>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Número
                            </label>
                            <input name="numero" type="text" class="form-control" id="numero" value="<?php echo $numero?>" required/>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Atualizar</button>
                </form>
            </div>
        </div>
        <!-- Fim da área de trabalho -->
    </div>
    <script src="../js/jquery-3.2.1.slim.min.js"></script>
    <script src="../js/jquery.mask.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/dashboard.js"></script>
</body>
</html>
