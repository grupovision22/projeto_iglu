<?php 

    session_start();
    include("db.php");
    include("funcoes.php");

    $dadosUsuario = verifica_login($con);

    if (!empty($_POST['submit-cadastrar'])) {

        $dadosFunc['nome'] = $_POST['nomeFunc'];
        $dadosFunc['email'] = $_POST['emailFunc'];
        $dadosFunc['genero'] = $_POST['geneFunc'];
        $dadosFunc['naturalidade'] = $_POST['naturaFunc'];
        $dadosFunc['rg'] = $_POST['rgFunc'];
        $dadosFunc['cpf'] = $_POST['cpfFunc'];
        $dadosFunc['cargo'] = $_POST['cargoFunc'];
        $dadosFunc['telefone'] = $_POST['telefoneFunc'];
        $dadosFunc['dataNasc'] = $_POST['dataNascFunc'];
        $dadosFunc['dataAdmi'] = $_POST['dataAdmiFunc'];

        $dadosFunc['logradouro'] = $_POST['lograFunc'];
        $dadosFunc['bairro'] = $_POST['bairroFunc'];
        $dadosFunc['numeroResidencia'] = $_POST['numeroResiFunc'];
        $dadosFunc['complemento'] = $_POST['complementoFunc'];
        $dadosFunc['cidade'] = $_POST['cidadeFunc'];
        $dadosFunc['uf'] = $_POST['ufFunc'];
        $dadosFunc['cep'] = $_POST['cepFunc'];

        adiciona_funcionario($con, $dadosFunc);

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
        <title>IGLU - Funcionários</title>
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
                            <a href='funcionarios.php' class='nav-link selecionado'>
                            <img class='sidebarIcons' src='estilo/icons/peopleSelected.png' width='16' height='16'>
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

                            unset($_SESSION['idFunc']);
                            header("Location: login.php");
                            die;

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

            <!-- Modal Cadastra Funcionário -->
            <div class="modal fade" id="cadastraFuncModal" tabindex="-1" aria-labelledby="cadastraFuncModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cadastro de Funcionário</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <form method="POST">
                            <div class="modal-body">

                                <div class="row">
                                    <h5 class="modal-title">Dados do Funcionário</h5>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="recipient-name" class="col-form-label">Nome:</label>
                                        <input type="text" placeholder="Insira o nome completo" name="nomeFunc" class="form-control" id="nomeFunc" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="recipient-name" class="col-form-label">E-mail:</label>
                                        <input type="email" placeholder="Insira o e-mail" name="emailFunc" class="form-control" id="emailFunc" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label for="recipient-name" class="col-form-label">Gênero:</label>
                                        <select class="form-select" name="geneFunc" id="geneFunc" aria-label="Default select example" required>
                                            <option selected>Selecione o sexo</option>
                                            <option value="F">Feminino</option>
                                            <option value="M">Masculino</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="recipient-name" class="col-form-label">Naturalidade:</label>
                                        <input type="text" placeholder="Insira a naturalidade"  maxlength="2" name="naturaFunc" class="form-control" id="naturaFunc" required>
                                    </div>
                                    <div class="col">
                                        <label for="recipient-name" class="col-form-label">R.G:</label>
                                        <input type="text" placeholder="Insira o RG" maxlength="15" name="rgFunc" class="form-control" id="rgFunc" required>
                                    </div>
                                    <div class="col">
                                        <label for="recipient-name" class="col-form-label">C.P.F:</label>
                                        <input type="text" placeholder="Insira o CPF" maxlength="15" name="cpfFunc" class="form-control" id="cpfFunc" required>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col">
                                        <label for="recipient-name" class="col-form-label">Cargo:</label>
                                        <select class="form-select" name="cargoFunc" id="cargoFunc" aria-label="Default select example" required>
                                            <option selected>Selecione o cargo</option>
                                            <option value="1">Administrador</option>
                                            <option value="2">Caixa</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="recipient-name" class="col-form-label">Telefone:</label>
                                        <input type="text" placeholder="Insira um telefone" name="telefoneFunc" class="form-control" id="telefoneFunc" required>
                                    </div>
                                    <div class="col-3">
                                        <label for="recipient-name" class="col-form-label">Data de Nascimento:</label>
                                        <input name="dataNascFunc" id="dataNascFunc" class="form-control" type="date" required/>
                                    </div>
                                    <div class="col-3">
                                        <label for="recipient-name" class="col-form-label">Data de Admissão:</label>
                                        <input name="dataAdmiFunc" id="dataAdmiFunc" class="form-control" type="date" required/>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <h5 class="modal-title">Endereço do Funcionário</h5>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label for="recipient-name" class="col-form-label">Logradouro:</label>
                                        <input type="text" placeholder="Insira o endereço do funcionário" name="lograFunc" class="form-control" id="lograFunc" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label for="recipient-name" class="col-form-label">Bairro:</label>
                                        <input type="text" placeholder="Insira o bairro" name="bairroFunc" class="form-control" id="bairroFunc" required>
                                    </div>
                                    <div class="col-3">
                                        <label for="recipient-name" class="col-form-label">Número:</label>
                                        <input type="text" placeholder="Insira o número" name="numeroResiFunc" class="form-control" id="numeroResiFunc" required>
                                    </div>
                                    <div class="col-3">
                                        <label for="recipient-name" class="col-form-label">Complemento:</label>
                                        <input type="text" placeholder="Insira o complemento" name="complementoFunc" class="form-control" id="complementoFunc">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label for="recipient-name" class="col-form-label">Cidade:</label>
                                        <input type="text" placeholder="Insira a cidade" name="cidadeFunc" class="form-control" id="cidadeFunc" required>
                                    </div>
                                    <div class="col-3">
                                        <label for="recipient-name" class="col-form-label">U.F:</label>
                                        <input type="text" placeholder="Insira a UF" maxlength="2" name="ufFunc" class="form-control" id="ufFunc" required>
                                    </div>
                                    <div class="col-3">
                                        <label for="recipient-name" class="col-form-label">C.E.P:</label>
                                        <input type="text" placeholder="Insira o CEP" name="cepFunc" class="form-control" id="cepFunc">
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
            <!-- Fim Modal Cadastra Funcionário -->

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
                            <h5 class="tituloConteudo">Funcionários</h5>
                        </div>
                        <div class="p-2 flex-fill bd-highlight">

                        </div>
                        <div class="p-2 flex-fill bd-highlight">

                            <label class="form-check-label btnTelas" data-bs-toggle="modal" data-bs-target="#cadastraFuncModal">
                                <img class="sidebarIcons imgBtnTelas" src="estilo/icons/add.png" width="18" height="18">
                                Cadastrar funcionário
                            </label>

                        </div>
                        <div class="p-2 flex-fill bd-highlight">
                            <div class="btnTelas">
                                <a href="relatorio_func.php" class="relatorio">
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
                                        <th class="subtituloConteudo p-2 flex-fill bd-highlight" scope="col">Nome</th>
                                        <th class="subtituloConteudo p-2 flex-fill bd-highlight" scope="col">Cargo</th>
                                        <th class="subtituloConteudo p-2 flex-fill bd-highlight" scope="col">E-mail</th>
                                        <th class="subtituloConteudo p-2 flex-fill bd-highlight" scope="col">Telefone</th>
                                        <th class="subtituloConteudo p-2 flex-fill bd-highlight" scope="col">Opções</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php carrega_funcionarios($con); ?>

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
    <script src="js/funcionario.js"> </script>
</html>