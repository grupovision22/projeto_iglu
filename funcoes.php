<?php

?>
<style>
    <?php include 'estilo/paginas.css'; ?>
</style>
<?php

    function verifica_login($con){

        if(isset($_SESSION['idFunc']))
        {
            $id = $_SESSION['idFunc'];
            $query = "select * from tbfunc where idFunc = '$id' limit 1";

            $resultado = mysqli_query($con, $query);
            if($resultado && mysqli_num_rows($resultado) > 0){

                $dadosUsuario = mysqli_fetch_assoc($resultado);
                return $dadosUsuario;
            }
        }

        // Redireciona ao login
        header("Location: login.php");
        die;

    }

    function numero_randomico($tamanho){

        $texto = "";
        if($tamanho < 5){
            $tamanho = 5;
        }

        $len = rand(4, $tamanho);
        for($i = 0; $i < $len; $i++){

            $texto .= rand(0,9);
        }

        return $texto;

    }

    function carrega_menu($con){

        if(isset($_SESSION['idFunc']))
        {
           
            $id = $_SESSION['idFunc'];
            $query = "select idCargo from tbfunc where idFunc = '$id' limit 1";

            $resultado = mysqli_query($con, $query);

            if($resultado == "1"){

                echo "<li class='nav-item'>
                <a href='#' class='nav-link selecionado' aria-current='page'>
                <img class='sidebarIcons' src='estilo/icons/homeSelected.png' width='15' height='15'>
                Tela Inicial
                </a>
            </li>
            <li>
                <a href='estoque.php' class='nav-link opcao'>
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
                <a href='fornecedores.php' class='nav-link opcao'>
                <img class='sidebarIcons' src='estilo/icons/truck.png' width='15' height='15'>
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
                <a href='#' class='nav-link selecionado' aria-current='page'>
                <img class='sidebarIcons' src='estilo/icons/homeSelected.png' width='15' height='15'>
                Tela Inicial
                </a>
            </li>
            <li>
                <a href='estoque.php' class='nav-link opcao'>
                <img class='sidebarIcons' src='estilo/icons/box.png' width='15' height='15'>
                Estoque
                </a>
            </li>
            <li>
                <a href='fornecedores.php' class='nav-link opcao'>
                <img class='sidebarIcons' src='estilo/icons/truck.png' width='15' height='15'>
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

    }

?>