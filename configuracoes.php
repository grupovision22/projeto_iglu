<?php 

    session_start();
    include("db.php");
    include("funcoes.php");

    $dadosUsuario = verifica_login($con);

    if (!empty($_POST['submit-alterar-senha'])) {

        $senhaAtual = $_POST['senhaAtual'];
        $novaSenha = $_POST['novaSenha'];

        alterar_senha($con, $senhaAtual, $novaSenha);

    }

    if (!empty($_POST['submit-alterar-email'])) {

        $emailAtual = $_POST['emailAtual'];
        $novoEmail = $_POST['novoEmail'];

        alterar_email($con, $emailAtual, $novoEmail);        

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
        <title>IGLU - Configurações</title>
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
                            <a href='configuracoes.php' class='nav-link selecionado'>
                            <img class='sidebarIcons' src='estilo/icons/settingsSelected.png' width='16' height='16'>
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
                            <a href='configuracoes.php' class='nav-link selecionado'>
                            <img class='sidebarIcons' src='estilo/icons/settingsSelected.png' width='16' height='16'>
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

            <!-- Modal Altera Senha-->
            <div class="modal fade" id="alteraSenhaModal" tabindex="-1" aria-labelledby="alteraSenhaModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Alterar Senha</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                            </div>
                            <form method="POST">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="recipient-name" class="col-form-label">Senha atual:</label>
                                            <input type="password" name="senhaAtual" class="form-control" id="senhaAtual">
                                        </div>
                                        <div class="col-6">
                                            <label for="recipient-name" class="col-form-label">Nova senha:</label>
                                            <input type="password" name="novaSenha" class="form-control" id="novaSenha">
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    <button type="submit" name="submit-alterar-senha" value="Alterar" class="btn btn-success">Alterar</button>
                                </div>
                            </form>
                         </div>
                    </div>
                </div>
                <!-- Fim Modal Altera Senha-->

                <!-- Modal Altera Email-->
            <div class="modal fade" id="alteraEmailModal" tabindex="-1" aria-labelledby="alteraEmailModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Alterar E-mail</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                            </div>
                            <form method="POST">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col">
                                            <label for="recipient-name" class="col-form-label">E-mail atual:</label>
                                            <input type="email" name="emailAtual" class="form-control" id="senhaAtual">
                                        </div>
                                        <div class="col">
                                            <label for="recipient-name" class="col-form-label">Novo e-mail:</label>
                                            <input type="email" name="novoEmail" class="form-control" id="novaSenha">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    <button type="submit" name="submit-alterar-email" value="Alterar" class="btn btn-success">Alterar</button>
                                </div>
                            </form>
                         </div>
                    </div>
                </div>
                <!-- Fim Modal Altera Email-->

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

                

                <div class="container-fluid">
                    <div class="d-flex bd-highlight">
                        <div class="p-2 flex-fill bd-highlight">
                            <h5 class="tituloConteudo2">Informações</h5>
                        </div>

                    </div>

                    <div class="container-fluid" >
                        <div class="listaDados2">
                            <div class="row row-cols-1 row-cols-md-3 g-3">

                                <?php carrega_usuario($con); ?>

                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex bd-highlight">
                        <div class="p-2 flex-fill bd-highlight">
                            <h5 class="tituloConteudo2">Configurações</h5>
                        </div>

                    </div>
                    <br>
                    <div class="container-fluid" >

                            <div class="row row-cols-1 row-cols-md-3 g-3">

                                <div >
                                    <div class="row">

                                        <div class="col-7 p-2 flex-fill bd-highlight" style="text-align: center;">
                                            <label id="altera_senha" class="form-check-label btnTelas" data-bs-toggle="modal" data-bs-target="#alteraSenhaModal">
                                                Alterar senha
                                            </label>
                                        </div>
                                        <div class="col-1 p-2 flex-fill bd-highlight" style="text-align: center;">
                                            <label class="form-check-label btnTelas" data-bs-toggle="modal" data-bs-target="#alteraEmailModal">
                                                Alterar e-mail
                                            </label>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>


                </div>

            </div>
        </div>

        <script src="estilo/bootstrap.bundle.min.js"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
    </body>
</html>