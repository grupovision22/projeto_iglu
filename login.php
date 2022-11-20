<?php 

    session_start();
    include("db.php");
    include("funcoes.php");

    if (!empty($_POST['submit-login'])) {
        //Login
        //Obtendo dados do login
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
                        echo '<script type="text/javascript"> window.location.replace("telaInicial.php");</script>';
                        die;

                    }
                }

            }

            ?>
                <div class="alert alert-danger alert-dismissible fade show" style="position: absolute; z-index: 10; margin-left: 55%; margin-top: 38%; width: 39%;" role="alert">
                    <strong>Atenção!</strong> Email ou senha incorretos.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php

        }else{
             
            ?>
                <div class="alert alert-danger alert-dismissible fade show" style="position: absolute; z-index: 10; margin-left: 55%; margin-top: 38%; width: 39%;" role="alert">
                    <strong>Atenção!</strong> Email ou senha incorretos.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            
        }
     }
     if (!empty($_POST['submit-recuperar'])) {
        //Solicitar
        //Obtendo dados para recuperar senha
        $recuperarSenhaEmail = $_POST['recuperaEmail'];
        recupera_senha($con, $recuperarSenhaEmail);
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
        <div class="container d-flex">
            <div class="col metade p-2 flex-fill bd-highlight">
                <img src="estilo/imgs/Logo.png" alt="Logo" width="75" height="75">
                <br>
                <div class="text-center">
                    <img src="estilo/imgs/IGLU.png" alt="Logo" style="margin-top: 20%;">
                    <br>
                    <h3 class="font">OS MELHORES SORVETES PARA<br> OS MELHORES CLIENTES</h3>
                </div>
            </div>
            <div class="col metade p-2 flex-fill bd-highlight">
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
                        <div class="form-group form d-flex bd-highlight">
                            <!-- Ativar modal -->
                            <label class="form-check-label esqueciSenha p-2 flex-fill bd-highlight" data-bs-toggle="modal" data-bs-target="#recuperaModal">Esqueci minha senha</label>

                            <button type="submit" name="submit-login" value="Login" class="loginBtn p-2 flex-fill bd-highlight">LOGIN</button>
                        </div>
                    </form>

                    <!-- Modal Recuperar Senha-->
                            <div class="modal fade" id="recuperaModal" tabindex="-1" aria-labelledby="recuperaModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Recuperação de Senha</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                        </div>
                                        <form method="POST">
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">Insira seu e-mail:</label>
                                                    <input type="email" name="recuperaEmail" class="form-control" id="recuperaEmail">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                <button type="submit" name="submit-recuperar" value="Solicitar" class="btn btn-success">Solicitar Recuperação</button>
                                            </div>
                                        </form>
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