<?php 

    session_start();
    include("db.php");
    include("funcoes.php");

    $dadosUsuario = verifica_login($con);

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
        <title>IGLU - Tela Inicial</title>
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
                            <a href='vendas.php' class='nav-link selecionado'>
                            <img class='sidebarIcons' src='estilo/icons/walletSelected.png' width='16' height='16'>
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
                            <a href='fornecedores.php' class='nav-link opcao'>
                            <img class='sidebarIcons' src='estilo/icons/truck.png' width='16' height='16'>
                            Fornecedores
                            </a>
                        </li>
                        <li>
                            <a href='vendas.php' class='nav-link selecionado'>
                            <img class='sidebarIcons' src='estilo/icons/walletSelected.png' width='16' height='16'>
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

            <div class="conteudo2 container-fluid">

                
                <div class="container-fluid" style="margin-top: 23%;">
                    <div class="d-flex bd-highlight">
                        <div class="p-2 flex-fill bd-highlight">
                            <h5 class="tituloConteudo2">Realizar Venda</h5>
                        </div>
                    </div>

                    <div class="container-fluid" >
                        <div class="listaDados3">
                            <div class="row row-cols-1 row-cols-md-3 g-3">

                                <?php carrega_produtos_venda($con); ?>

                            </div>   
                        </div>
                    </div>

                </div>

            </div>
            <div class="conteudo3 container-fluid">
            <div class="areaUsuario2">

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

                <div class="d-flex bd-highlight" style="margin-top: 9%;">

                        <div class="p-2 flex-fill bd-highlight">
                            <div class="btnTelas">
                                <a href="" class="relatorio">
                                    <img class="sidebarIcons imgBtnTelas" src="estilo/icons/add.png" width="18" height="18">
                                    Gerar relatório
                                </a>
                            </div>
                        </div>
                    </div>

                <div class="container-fluid">
                    <div class="d-flex bd-highlight">
                        <div class="p-2 flex-fill bd-highlight">
                            <h5 class="tituloConteudo2">Detalhes do Pedido</h5>
                        </div>
                    </div>

                    <div class="container-fluid" >
                        <div class="listaDados3">
                            <div class="row row-cols-1 g-3" style="padding-right: 15px; padding-left: 15px;">

                                <form method="POST">
                                    <div class='row'>
                                        <label for='recipient-name' class='col-form-label'>Nome do cliente:</label>
                                        <input type='text' value='' placeholder='Insira o nome do cliente' name='nomeCli' class='form-control' id='nomeCli' required>
                                    </div>
                                    <div class='row'>
                                        <label for='recipient-name' class='col-form-label'>Telefone cliente:</label>
                                        <input type='text' value='' placeholder='Insira um telefone' maxlength='20' name='telefoneCli' class='form-control' id='telefoneCli' required>
                                    </div>
                                    <div class='row'>      
                                        <label for='recipient-name' class='col-form-label'>Status:</label>
                                        <select class='form-select' name='statusPedido' id='statusPedido' aria-label='Default select example' required>
                                            <option selected>Selecione um status</option>
                                            <option value="Entregue">Entregue</option>
                                            <option value="Preparando">Preparando</option>
                                            <option value="Cancelado">Cancelado</option>
                                        </select>
                                    </div>
                                    <hr class="divisao2">
                                    <div class="row">
                                        <?php carrega_valor_venda(); ?>
                                    </div>
                                    <hr class="divisao2">
                                    <div class='row'>      
                                        <select class='form-select' name='statusPedido' id='statusPedido' aria-label='Default select example' required>
                                            <option selected>Método de pagamento</option>
                                            <option value="1">Débito</option>
                                            <option value="2">Crédito</option>
                                            <option value="3">Pix</option>
                                            <option value="4">Dinheiro</option>
                                        </select>
                                    </div>
                                    <div class="row" style="padding-top: 8px;">
                                        <button type="submit-venda" class="btn btn-success">Finalizar compra</button>
                                    </div>
                                </form>

                            </div>   
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </body>
</html>