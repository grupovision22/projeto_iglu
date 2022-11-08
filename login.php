<?php 

    session_start();
    include("db.php");
    include("funcoes.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $emailFunc = $_POST['emailFunc'];
        $senhaFunc = $_POST['senhaFunc'];

        if(!empty($emailFunc) && !empty($senhaFunc) && !is_numeric($emailFunc)){

            //Busca no banco de dados
            $query = "select * from tbfunc where emailFunc = '$emailFunc' limit 1";
            $resultado = mysqli_query($con, $query);

            if($resultado){

                if($resultado && mysqli_num_rows($resultado) > 0){

                    $dadosUsuario = mysqli_fetch_assoc($resultado);

                    if($dadosUsuario['senhaFunc'] === $senhaFunc){

                        $_SESSION['idFunc'] = $dadosUsuario['idFunc'];
                        header("Location: telaInicial.php");
                        die;

                    }
                }

            }

            ?>
                <script type="text/javascript">alert('Informações Inválidas');</script>
            <?php

        }else{
             
            ?>
                <script type="text/javascript">alert('Informações Inválidas');</script>
            <?php
            
        }

    }

?>

<html>
    <head>
        <link rel="stylesheet" href="estilo/bootstrap.min.css">
        <link rel="stylesheet" href="estilo/paginas.css">
        <link rel="icon" type="image/x-icon" href="estilo/imgs/Logo.ico">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IGLU - Login</title>
    </head>
    <body>
        <div class="container">
            <div class="col metade">
                <img src="estilo/imgs/Logo.png" alt="Logo" width="75" height="75">
                <br>
                <div class="text-center">
                    <img src="estilo/imgs/IGLU.png" alt="Logo" style="margin-top: 20%;">
                    <br>
                    <h3 class="font">OS MELHORES SORVETES PARA<br> OS MELHORES CLIENTES</h3>
                </div>
            </div>
            <div class="col metade">
                <div class="formDiv">
                    <h1 class="titulo" style="margin-top: 33%;">SEJA BEM-VINDO(A)</h1>
                    <h3 class="font2">Logue em sua conta para continuar</h3>

                    <form method="POST">
                        <div class="form-group form">
                            <input type="email" name="emailFunc" class="form-control inputLogin" placeholder="E-mail">
                        </div>
                        <br>
                        <div class="form-group form">
                            <input type="password" name="senhaFunc" class="form-control inputLogin" placeholder="Senha">
                        </div>
                        <br>
                        <div class="form-group form">
                            <label class="form-check-label esqueciSenha" >Esqueci minha senha</label>
                            <button type="submit" value="Login" class="loginBtn">LOGIN</button>
                        </div>
                    </form>

                </div>
            </div>  
        </div>
        <script src="estilo/bootstrap.bundle.min.js"></script>
    </body>
</html>