<?php 


    session_start();
    include("db.php");
    include("funcoes.php");

    $dadosUsuario = verifica_login($con);

?>

<html>
    <head>
        <link rel="stylesheet" href="estilo/bootstrap.min.css">
        <link rel="stylesheet" href="estilo/paginas.css">
        <link rel="icon" type="image/x-icon" href="estilo/imgs/Logo.ico">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IGLU - Tela Inicial</title>
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
                                <img class='sidebarIcons' src='estilo/icons/home.png' width='15' height='15'>
                                Tela Inicial
                            </a>
                        </li>
                        <li>
                            <a href='estoque.php' class='nav-link opcao' aria-current='page'>
                            <img class='sidebarIcons' src='estilo/icons/box.png' width='15' height='15'>
                            Estoque
                            </a>
                        </li>
                        <li>
                            <a href='funcionarios.php' class='nav-link opcao'>
                            <img class='sidebarIcons' src='estilo/icons/people.png' width='15' height='15'>
                            Funcionários
                            </a>
                        </li>
                        <li>
                            <a href='fornecedores.php' class='nav-link selecionado'>
                            <img class='sidebarIcons' src='estilo/icons/truckSelected.png' width='15' height='15'>
                            Fornecedores
                            </a>
                        </li>
                        <li>
                            <a href='vendas.php' class='nav-link opcao'>
                            <img class='sidebarIcons' src='estilo/icons/wallet.png' width='15' height='15'>
                            Vendas
                            </a>
                        </li>
                        <li>
                            <a href='configuracoes.php' class='nav-link opcao'>
                            <img class='sidebarIcons' src='estilo/icons/settings.png' width='15' height='15'>
                            Configurações
                            </a>
                        </li>";

                        }
                        else{

                            echo "<li class='nav-item'>
                            <a href='telaInicial.php' class='nav-link opcao'>
                                <img class='sidebarIcons' src='estilo/icons/home.png' width='15' height='15'>
                                Tela Inicial
                            </a>
                        </li>
                        <li>
                            <a href='estoque.php' class='nav-link opcao' aria-current='page'>
                            <img class='sidebarIcons' src='estilo/icons/box.png' width='15' height='15'>
                            Estoque
                            </a>
                        </li>
                        <li>
                            <a href='fornecedores.php' class='nav-link selecionado'>
                            <img class='sidebarIcons' src='estilo/icons/truckSelected.png' width='15' height='15'>
                            Fornecedores
                            </a>
                        </li>
                        <li>
                            <a href='vendas.php' class='nav-link opcao'>
                            <img class='sidebarIcons' src='estilo/icons/wallet.png' width='15' height='15'>
                            Vendas
                            </a>
                        </li>
                        <li>
                            <a href='configuracoes.php' class='nav-link opcao'>
                            <img class='sidebarIcons' src='estilo/icons/settings.png' width='15' height='15'>
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
                        <img class="sidebarIcons deslogarContent" src="estilo/icons/logout.png" width="15" height="15">
                        Deslogar
                        </a>
                    </li>
                </div>
            </div>
            <!-- FIM SIDEBAR -->

            <div class="conteudo">
            </div>
        </div>
    </body>
</html>