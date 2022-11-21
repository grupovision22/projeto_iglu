<?php 


    session_start();
    include("db.php");
    include("funcoes.php");

    $dadosUsuario = verifica_login($con);

    if (!empty($_POST['submit-cadastrar'])) {

        $dadosForn['nomeForn'] = $_POST['nomeForn'];
        $dadosForn['nomeEmp'] = $_POST['nomeEmpForn'];
        $dadosForn['email'] = $_POST['emailForn'];
        $dadosForn['telefone'] = $_POST['telefoneForn'];
        $dadosForn['cnpj'] = $_POST['cnpjForn'];

        adiciona_fornecedor($con, $dadosForn);

    }

?>

<html>
    <head>
    <style>
            
            /* ESTILO BARRA DE SCROLL */

            ::-webkit-scrollbar {
                width: 5px;
                border-radius: 20px;
            }

            ::-webkit-scrollbar-track {
                background: transparent;
            }
            
            ::-webkit-scrollbar-thumb {
                background: #843B3B;
                border-radius: 20px;

            }

            /* FIM ESTILO BARRA DE SCROLL */

        </style>
        <link rel="stylesheet" href="estilo/bootstrap.min.css">
        <link rel="stylesheet" href="estilo/paginas.css">
        <link rel="icon" type="image/x-icon" href="estilo/imgs/Logo.ico">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IGLU - Fornecedores</title>
    </head>
    <body>
        <div class="container container-fluid">
            <!-- INÍCIO SIDEBAR -->
            <div class="d-flex flex-column flex-shrink-0 p-3 sidebar">
                <div class="text-center">
                    <img src="estilo/imgs/Logo2.png" alt="Logo" width="75" height="75">
                    <br>
                    <span class="fs-4 tituloSidebar">I G L U</span>
                    <br>
                </div>
                <hr class="divisao1">
                <ul class="nav nav-pills flex-column mb-auto">

                <?php 

                    if(isset($_SESSION['idFunc']))
                    {
                    
                        $id = $_SESSION['idFunc'];
                        $query = "select idCargo from tbfunc where idFunc = '$id' limit 1";

                        $resultado = mysqli_query($con, $query);
                        $row = mysqli_fetch_array($resultado);

                        if($row[0] == "1"){

                            echo "<li class='nav-item'>
                                <a href='telaInicial.php' class='nav-link opcao'>
                                <img class='sidebarIcons' src='estilo/icons/home.png' width='16' height='16'>
                                Tela Inicial
                            </a>
                        </li>
                        <li>
                            <a href='estoque.php' class='nav-link opcao' aria-current='page'>
                            <img class='sidebarIcons' src='estilo/icons/box.png' width='16' height='16'>
                            Estoque
                            </a>
                        </li>
                        <li>
                            <a href='funcionarios.php' class='nav-link opcao'>
                            <img class='sidebarIcons' src='estilo/icons/people.png' width='16' height='16'>
                            Funcionários
                            </a>
                        </li>
                        <li>
                            <a href='fornecedores.php' class='nav-link selecionado'>
                            <img class='sidebarIcons' src='estilo/icons/truckSelected.png' width='16' height='16'>
                            Fornecedores
                            </a>
                        </li>
                        <li>
                            <a href='vendas.php' class='nav-link opcao'>
                            <img class='sidebarIcons' src='estilo/icons/wallet.png' width='16' height='16'>
                            Vendas
                            </a>
                        </li>
                        <li>
                            <a href='configuracoes.php' class='nav-link opcao'>
                            <img class='sidebarIcons' src='estilo/icons/settings.png' width='16' height='16'>
                            Configurações
                            </a>
                        </li>";

                        }
                        else{

                            echo "<li class='nav-item'>
                            <a href='telaInicial.php' class='nav-link opcao'>
                                <img class='sidebarIcons' src='estilo/icons/home.png' width='16' height='16'>
                                Tela Inicial
                            </a>
                        </li>
                        <li>
                            <a href='estoque.php' class='nav-link opcao' aria-current='page'>
                            <img class='sidebarIcons' src='estilo/icons/box.png' width='16' height='16'>
                            Estoque
                            </a>
                        </li>
                        <li>
                            <a href='fornecedores.php' class='nav-link selecionado'>
                            <img class='sidebarIcons' src='estilo/icons/truckSelected.png' width='16' height='16'>
                            Fornecedores
                            </a>
                        </li>
                        <li>
                            <a href='vendas.php' class='nav-link opcao'>
                            <img class='sidebarIcons' src='estilo/icons/wallet.png' width='16' height='16'>
                            Vendas
                            </a>
                        </li>
                        <li>
                            <a href='configuracoes.php' class='nav-link opcao'>
                            <img class='sidebarIcons' src='estilo/icons/settings.png' width='16' height='16'>
                            Configurações
                            </a>
                        </li>";

                        }
                    }

                ?>

                <hr class="divisao2">
                </ul>
                <div class="dropdown">
                    <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link bg-danger deslogar" aria-current="page">
                        <img class="sidebarIcons deslogarContent" src="estilo/icons/logout.png" width="16" height="16">
                        Deslogar
                        </a>
                    </li>
                </div>
            </div>
            <!-- FIM SIDEBAR -->

            <!-- Modal Cadastra Fornecedor -->
            <div class="modal fade" id="cadastraFornModal" tabindex="-1" aria-labelledby="cadastraFornModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cadastro de Fornecedor</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <form method="POST">
                            <div class="modal-body">

                                <div class="row">
                                    <h5 class="modal-title">Dados do Fornecedor</h5>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="recipient-name" class="col-form-label">Nome do fornecedor:</label>
                                        <input type="text" placeholder="Insira o nome completo" name="nomeForn" class="form-control" id="nomeForn" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="recipient-name" class="col-form-label">Nome da empresa:</label>
                                        <input type="text" place holder="Insira o nome completo" name="nomeEmpForn" class="form-control" id="nomeEmpForn" required>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label for="recipient-name" class="col-form-label">E-mail:</label>
                                        <input type="email" placeholder="Insira o e-mail" name="emailForn" class="form-control" id="emailForn" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label for="recipient-name" class="col-form-label">Telefone:</label>
                                        <input type="text" placeholder="Insira um telefone" maxlength="20" name="telefoneForn" class="form-control" id="telefoneForn" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="recipient-name" class="col-form-label">CNPJ:</label>
                                        <input type="text" placeholder="Insira o CNPJ"  maxlength="20" name="cnpjForn" class="form-control" id="cnpjForn" required>
                                    </div>
                                </div>

                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" name="submit-cadastrar" value="Cadastrar" class="btn btn-success">Cadastrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Fim Modal Cadastra Fornecedor -->

            <div class="conteudo container-fluid">

                <div class="areaUsuario">
                    <div class="areaPerfil">
                        <img class="position-absolute top-0 start-50 translate-middle-x iconeUsuario" src="estilo/icons/user2.png" width="30" height="30">
                    </div>
                    <div>
                        <?php
                            $nomeCompleto = $dadosUsuario['nomeFunc'];
                            $nome = explode(" ", $nomeCompleto);
                        ?>
                        <h5 class="position-absolute top-0 translate-middle-x nomeUsuario"><?php echo($nome[0]) ?></h5>
                    </div>
                </div>

                <div class="container-fluid marginBtnTelas">
                    <div class="d-flex bd-highlight">
                        <div class="p-2 flex-fill bd-highlight">
                            <h5 class="tituloConteudo">Fornecedores</h5>
                        </div>
                        <div class="p-2 flex-fill bd-highlight">

                        </div>
                        <div class="p-2 flex-fill bd-highlight">

                            <label class="form-check-label btnTelas" data-bs-toggle="modal" data-bs-target="#cadastraFornModal">
                                <img class="sidebarIcons imgBtnTelas" src="estilo/icons/add.png" width="18" height="18">
                                Cadastrar fornecedor
                            </label>

                        </div>
                        <div class="p-2 flex-fill bd-highlight">
                            <div class="btnTelas">
                                <a href="relatorio_forn.php" class="relatorio">
                                <img class="sidebarIcons imgBtnTelas" src="estilo/icons/add.png" width="18" height="18">
                                Gerar relatório
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid marginBtnTelas" >
                        <div class="listaDados">
                            
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th class="subtituloConteudo p-2 flex-fill bd-highlight" scope="col">ID</th>
                                        <th class="subtituloConteudo p-2 flex-fill bd-highlight" scope="col">Empresa</th>
                                        <th class="subtituloConteudo p-2 flex-fill bd-highlight" scope="col">Fornecedor</th>
                                        <th class="subtituloConteudo p-2 flex-fill bd-highlight" scope="col">E-mail</th>
                                        <th class="subtituloConteudo p-2 flex-fill bd-highlight" scope="col">Telefone</th>
                                        <th class="subtituloConteudo p-2 flex-fill bd-highlight" scope="col">Opções</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php carrega_fornecedores($con); ?>

                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div> 

            </div>
        </div>

        <script src="estilo/bootstrap.bundle.min.js"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
    </body>
    <script src="js/fornecedor.js"> </script>
</html>