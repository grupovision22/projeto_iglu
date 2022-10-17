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
                    <form action="telaInicial.php">
                        <div class="form-group form">
                            <input type="email" class="form-control inputLogin" placeholder="E-mail">
                        </div>
                        <br>
                        <div class="form-group form">
                            <input type="password" class="form-control inputLogin" placeholder="Senha">
                        </div>
                        <br>
                        <div class="form-group form">
                            <label class="form-check-label esqueciSenha" >Esqueci minha senha</label>
                            <button type="submit" class="loginBtn">LOGIN</button>
                        </div>
                    </form>
                </div>
            </div>  
        </div>
        <script src="estilo/bootstrap.bundle.min.js"></script>
    </body>
</html>