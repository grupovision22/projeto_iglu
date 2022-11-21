<?php 

    session_start();
    include("db.php");
    include("funcoes.php");

    $dadosUsuario = verifica_login($con);

    if (!empty($_POST['submit-cadastrar'])) {

        $dadosProd['nomeProd'] = $_POST['nomeProd'];
        $dadosProd['FornecedorProd'] = $_POST['FornecedorProd'];
        $dadosProd['descProd'] = $_POST['descProd'];
        $dadosProd['dataVenciProd'] = $_POST['dataVenciProd'];
        $dadosProd['dataFabriProd'] = $_POST['dataFabriProd'];
        $dadosProd['precoProd'] = doubleval($_POST['precoProd']);
        $dadosProd['qntdProd'] = $_POST['qntdProd'];
        $dadosProd['loteProd'] = $_POST['loteProd'];

        $ImgNameProd = $_FILES['fotoProd']['name'];
        $ImgTmpNameProd = $_FILES['fotoProd']['tmp_name'];
        $folderImgProd = 'estilo/imgs/Produtos/'.$ImgNameProd;

        if(isset($_SESSION['idFunc'])){
            
            $query = "INSERT INTO tbproduto (idFornecedor , nomeProduto, descricaoProduto, imagemProduto, dataVencimentoProduto, dataFabricacaoProduto, qtdeProduto, precoProduto, loteProduto) 
            VALUES (".$dadosProd['FornecedorProd'].", '".$dadosProd['nomeProd']."', '".$dadosProd['descProd']."', '".$ImgNameProd."', '".$dadosProd['dataVenciProd']."', '".$dadosProd['dataFabriProd']."', ".$dadosProd['qntdProd'].", ".$dadosProd['precoProd'].", '".$dadosProd['loteProd']."')";

            $resultado = mysqli_query($con, $query);

            if($resultado){
                if(move_uploaded_file($_FILES['fotoProd']['tmp_name'], $folderImgProd)){

                    echo '<script type="text/javascript"> window.location.replace("estoque.php");</script>';

                }

            }

        }

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
        <title>IGLU - Estoque</title>
    </head>
    <body>
        <div class="container">
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
                            <a href='estoque.php' class='nav-link selecionado' aria-current='page'>
                            <img class='sidebarIcons' src='estilo/icons/boxSelected.png' width='16' height='16'>
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
                            <a href='fornecedores.php' class='nav-link opcao'>
                            <img class='sidebarIcons' src='estilo/icons/truck.png' width='16' height='16'>
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
                            <a href='estoque.php' class='nav-link selecionado' aria-current='page'>
                            <img class='sidebarIcons' src='estilo/icons/boxSelected.png' width='16' height='16'>
                            Estoque
                            </a>
                        </li>
                        <li>
                            <a href='fornecedores.php' class='nav-link opcao'>
                            <img class='sidebarIcons' src='estilo/icons/truck.png' width='16' height='16'>
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

            <!-- Modal Cadastra produto -->
            <div class="modal fade" id="cadastraProdModal" tabindex="-1" aria-labelledby="cadastraProdModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cadastro de Produto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="modal-body">

                                <div class="row">
                                    <h5 class="modal-title">Dados do Produto</h5>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="recipient-name" class="col-form-label">Nome do produto:</label>
                                        <input type="text" placeholder="Insira o nome completo" name="nomeProd" class="form-control" id="nomeForn" required>
                                    </div>
                                    <div class="col-6">
                                        
                                        <label for="recipient-name" class="col-form-label">Fornecedor:</label>
                                        <select class="form-select" name="FornecedorProd" id="FornecedorProd" aria-label="Default select example" required>
                                            <option selected>Selecione um fornecedor</option>
                                            <?php lista_fornecedor($con) ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label for="recipient-name" class="col-form-label">Descrição do produto:</label>
                                        <textarea class="form-control" placeholder="Insira uma descrição para o produto" name="descProd" id="descProd" rows="3"></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-3">
                                        <label for="recipient-name" class="col-form-label">Data de fabricação:</label>
                                        <input name="dataFabriProd" id="dataFabriProd" class="form-control" type="date" required/>
                                    </div>
                                    <div class="col-3">
                                        <label for="recipient-name" class="col-form-label">Data de vencimento:</label>
                                        <input name="dataVenciProd" id="dataVenciProd" class="form-control" type="date" required/>
                                    </div>
                                    <div class="col">
                                        <label for="recipient-name" class="col-form-label">Foto do produto:</label>
                                        <input name="fotoProd" id="fotoProd" class="form-control" type="file" accept="image/png" required/>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-3">
                                        <label for="recipient-name" class="col-form-label">Preço do produto:</label>
                                        <input name="precoProd" id="precoProd" class="form-control" type="text" required/>
                                    </div>
                                    <div class="col-3">
                                        <label for="recipient-name" class="col-form-label">Quantidade do produto:</label>
                                        <input name="qntdProd" id="qntdProd" class="form-control" type="number" min="1" step="any" required/>
                                    </div>
                                    <div class="col">
                                        <label for="recipient-name" class="col-form-label">Lote do produto:</label>
                                        <input name="loteProd" id="loteProd" class="form-control" type="text" required/>
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
            <!-- Fim Modal Cadastra produto -->

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
                            <h5 class="tituloConteudo">Produtos</h5>
                        </div>
                        <div class="p-2 flex-fill bd-highlight">

                        </div>
                        <div class="p-2 flex-fill bd-highlight">

                            <label class="form-check-label btnTelas" data-bs-toggle="modal" data-bs-target="#cadastraProdModal">
                                <img class="sidebarIcons imgBtnTelas" src="estilo/icons/add.png" width="18" height="18">
                                Cadastrar produto
                            </label>

                        </div>
                        <div class="p-2 flex-fill bd-highlight">
                            <div class="btnTelas">
                                <a href="relatorio_estoque.php" class="relatorio">
                                <img class="sidebarIcons imgBtnTelas" src="estilo/icons/add.png" width="18" height="18">
                                Gerar relatório
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid marginBtnTelas" >
                        <div class="listaDados">
                            <div class="row row-cols-1 row-cols-md-3 g-3">

                                <?php carrega_produto($con); ?>

                        </div>
                    </div>
                </div> 

            </div>

        </div>

        <script src="estilo/bootstrap.bundle.min.js"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
    </body>
    <script src="js/estoque.js"> </script>
</html>