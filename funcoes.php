<?php

    ?><style> <?php include 'estilo/paginas.css'; ?> </style><?php

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

            $texto .= rand(0,6);
        }

        return $texto;

    }

    function recupera_senha($con ,$email){
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            //Obtendo dados para recuperar senha
            $recuperarSenhaEmail = $_POST['recuperaEmail'];

            if(!empty($email) && !is_numeric($email)){

                $query2 = "select * from tbfunc where emailFunc = '$email' limit 1";
                $resultado2 = mysqli_query($con, $query2);

                if($resultado2){

                    if($resultado2 && mysqli_num_rows($resultado2) > 0){

                        $dadosUsuario2 = mysqli_fetch_assoc($resultado2);

                        if($dadosUsuario2['emailFunc'] === $email){

                            $novaSenha = numero_randomico(10);
                            $attSenha = "UPDATE tbfunc SET senhaFunc = '$novaSenha' WHERE emailFunc = '$email'";

                            mysqli_query($con, $attSenha);

                            $nomeCompleto = $dadosUsuario2['nomeFunc'];
                            $nome = explode(" ", $nomeCompleto);

                            $to = $email;
                            $subject = 'Recuperação de Senha';
                            $message = "Olá $nome[0], tudo bem?\n\nVocê solicitou a recuperação de sua senha, segue sua nova senha de acesso: $novaSenha\nRecomendamos que altere essa senha na guia de configurações após realizar seu login.\n\nA sorveteria Iglu agradece!";
                            $headers = 'From: Sorveteria Iglu';

                            //Envia email
                            mail($to, $subject, $message, $headers);

                        }
                    }

                }

            }

        }

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
        }

    }

    function deleta_funcionario($con, $id){
        if(isset($_SESSION['idFunc'])){
            $query = "DELETE FROM tbfunc WHERE idFunc = '$id'";

            if(mysqli_query($con, $query)){
                return true;
            }else {
                return false;
            }
            
        }
    }

    function adiciona_funcionario($con, $dadosFunc){
        if(isset($_SESSION['idFunc'])){
            
            $senha = numero_randomico(10);

            $query = "INSERT INTO tbfunc (cpfFunc, rgFunc, nomeFunc, generoFunc, dataNascFunc, dataContratoFunc, naturalidadeFunc, emailFunc, telFunc, senhaFunc, logradouroEndereco, numeroEndereco, complementoEndereco, bairroEndereco, cidadeEndereco, ufEndereco, cepEndereco, idCargo) 
            VALUES ('".$dadosFunc['cpf']."', '".$dadosFunc['rg']."', '".$dadosFunc['nome']."', '".$dadosFunc['genero']."', '".$dadosFunc['dataNasc']."', '".$dadosFunc['dataAdmi']."', '".$dadosFunc['naturalidade']."', '".$dadosFunc['email']."', '".$dadosFunc['telefone']."', '".$senha."', '".$dadosFunc['logradouro']."', ".$dadosFunc['numeroResidencia'].", '".$dadosFunc['complemento']."', '".$dadosFunc['bairro']."', '".$dadosFunc['cidade']."', '".$dadosFunc['uf']."', '".$dadosFunc['cep']."', ".$dadosFunc['cargo'].")";

            $resultado = mysqli_query($con, $query);

            if($resultado){

                $nome = explode(" ", $dadosFunc['nome']);

                $to = $dadosFunc['email'];
                $subject = 'Cadastrado com Sucesso';
                $message = "Olá $nome[0], tudo bem?\n\nO seu cadastro na Sorveteria Iglu foi realizado com sucesso, segue sua senha de acesso: $senha\nRecomendamos que altere essa senha na guia de configurações após realizar seu primeiro login.\n\nA sorveteria Iglu agradece!";
                $headers = 'From: Sorveteria Iglu';

                //Envia email após o cadastro
                mail($to, $subject, $message, $headers);

            }


        }
    }

    function edita_funcionario($con, $dadosFunc){
        if(isset($_SESSION['idFunc'])){

            $query = "UPDATE tbfunc SET cpfFunc = '".$dadosFunc['cpf']."', rgFunc = '".$dadosFunc['rg']."', nomeFunc = '".$dadosFunc['nome']."', generoFunc = '".$dadosFunc['genero']."', dataNascFunc = '".$dadosFunc['dataNasc']."', dataContratoFunc = '".$dadosFunc['dataAdmi']."',
             naturalidadeFunc = '".$dadosFunc['naturalidade']."', emailFunc = '".$dadosFunc['email']."', telFunc = '".$dadosFunc['telefone']."', logradouroEndereco = '".$dadosFunc['logradouro']."', numeroEndereco = ".$dadosFunc['numeroResidencia'].", complementoEndereco = '".$dadosFunc['complemento']."',
              bairroEndereco = '".$dadosFunc['bairro']."', cidadeEndereco = '".$dadosFunc['cidade']."', ufEndereco = '".$dadosFunc['uf']."', cepEndereco = '".$dadosFunc['cep']."', idCargo = ".$dadosFunc['cargo']." WHERE idFunc = ".$dadosFunc['id']."";


            if(mysqli_query($con, $query)){
                echo '<script type="text/javascript"> window.location.replace("funcionarios.php");</script>';
            }

        }
    }

    function funcF($genero){
        if($genero == 'F'){
           return "selected='selected'";
        }
    }
    function funcM($genero){
        if ($genero == 'M'){
            return "selected='selected'";
        }
    }

    function funcC1($id){
        if($id == 1){
           return "selected='selected'";
        }
    }
    function funcC2($id){
        if ($id == 2){
            return "selected='selected'";
        }
    }

    function carrega_funcionarios($con){
        if(isset($_SESSION['idFunc'])){

            $id = $_SESSION['idFunc'];
            $query = "SELECT * FROM tbfunc WHERE idFunc != '$id'";
            $resultado = mysqli_query($con, $query);

            if($resultado){

                while($row = mysqli_fetch_array($resultado)){

                    if (!empty($_POST['submit-editar'])) {
                        
                        $dadosFunc['id'] = $_POST['idFunc'];
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
                
                        edita_funcionario($con, $dadosFunc);
                
                    }

                    echo "
                    <div class='modal fade' data-backdrop='false' id='editarFuncModal".$row['idFunc']."' tabindex='-1' aria-labelledby='editaFuncModalLabel".$row['idFunc']."' aria-hidden='true'>
                        <div class='modal-dialog modal-lg modal-dialog-centered'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='exampleModalLabel'>Edição de Funcionário</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Fechar'></button>
                                </div>
                                <form method='POST'>
                                    <div class='modal-body'>

                                        <div class='row'>
                                            <h5 class='modal-title'>Dados do Funcionário</h5>
                                            <input type='hidden' value='".$row['idFunc']."' name='idFunc' id='idFunc'>
                                        </div>
                                        <div class='row'>
                                            <div class='col'>
                                                <label for='recipient-name' class='col-form-label'>Nome:</label>
                                                <input type='text' placeholder='Insira o nome completo' name='nomeFunc' value='".$row['nomeFunc']."' class='form-control' id='nomeFunc' required>
                                            </div>
                                            <div class='col-6'>
                                                <label for='recipient-name' class='col-form-label'>E-mail:</label>
                                                <input type='email' placeholder='Insira o e-mail' name='emailFunc' value='".$row['emailFunc']."' class='form-control' id='emailFunc' required>
                                            </div>
                                        </div>

                                        <div class='row'>
                                            <div class='col'>
                                                <label for='recipient-name' class='col-form-label'>Gênero:</label>
                                                <select class='form-select' name='geneFunc' id='geneFunc' aria-label='Default select example' required>
                                                    <option>Selecione o sexo</option>
                                                    <option ".funcF($row['generoFunc'])." value='F'>Feminino</option>
                                                    <option ".funcM($row['generoFunc'])." value='M'>Masculino</option>
                                                </select>
                                            </div>
                                            <div class='col-3'>
                                                <label for='recipient-name' class='col-form-label'>Naturalidade:</label>
                                                <input type='text' placeholder='Insira a naturalidade' maxlength='2' name='naturaFunc' value='".$row['naturalidadeFunc']."' class='form-control' id='naturaFunc' required>
                                            </div>
                                            <div class='col'>
                                                <label for='recipient-name' class='col-form-label'>R.G:</label>
                                                <input type='text' placeholder='Insira o RG' maxlength='15' name='rgFunc' value='".$row['rgFunc']."' class='form-control' id='rgFunc' required>
                                            </div>
                                            <div class='col'>
                                                <label for='recipient-name' class='col-form-label'>C.P.F:</label>
                                                <input type='text' placeholder='Insira o CPF' maxlength='15' name='cpfFunc' value='".$row['cpfFunc']."' class='form-control' id='cpfFunc' required>
                                            </div>
                                        </div>
                                        
                                        <div class='row'>
                                            <div class='col'>
                                                <label for='recipient-name' class='col-form-label'>Cargo:</label>
                                                <select class='form-select' name='cargoFunc' id='cargoFunc' aria-label='Default select example' required>
                                                    <option>Selecione o cargo</option>
                                                    <option ".funcC1($row['idCargo'])." value='1'>Administrador</option>
                                                    <option ".funcC2($row['idCargo'])." value='2'>Caixa</option>
                                                </select>
                                            </div>
                                            <div class='col-3'>
                                                <label for='recipient-name' class='col-form-label'>Telefone:</label>
                                                <input type='text' placeholder='Insira um telefone' name='telefoneFunc' value='".$row['telFunc']."' class='form-control' id='telefoneFunc' required>
                                            </div>
                                            <div class='col-3'>
                                                <label for='recipient-name' class='col-form-label'>Data de Nascimento:</label>
                                                <input name='dataNascFunc' id='dataNascFunc' class='form-control' value='".$row['dataNascFunc']."' type='date' required/>
                                            </div>
                                            <div class='col-3'>
                                                <label for='recipient-name' class='col-form-label'>Data de Admissão:</label>
                                                <input name='dataAdmiFunc' id='dataAdmiFunc' class='form-control' value='".$row['dataContratoFunc']."' type='date' required/>
                                            </div>
                                        </div>
                                        <br>
                                        <div class='row'>
                                            <h5 class='modal-title'>Endereço do Funcionário</h5>
                                        </div>

                                        <div class='row'>
                                            <div class='col'>
                                                <label for='recipient-name' class='col-form-label'>Logradouro:</label>
                                                <input type='text' placeholder='Insira o endereço do funcionário' name='lograFunc' value='".$row['logradouroEndereco']."' class='form-control' id='lograFunc' required>
                                            </div>
                                        </div>

                                        <div class='row'>
                                            <div class='col'>
                                                <label for='recipient-name' class='col-form-label'>Bairro:</label>
                                                <input type='text' placeholder='Insira o bairro' name='bairroFunc' value='".$row['bairroEndereco']."' class='form-control' id='bairroFunc' required>
                                            </div>
                                            <div class='col-3'>
                                                <label for='recipient-name' class='col-form-label'>Número:</label>
                                                <input type='text' placeholder='Insira o número' name='numeroResiFunc' value='".$row['numeroEndereco']."' class='form-control' id='numeroResiFunc' required>
                                            </div>
                                            <div class='col-3'>
                                                <label for='recipient-name' class='col-form-label'>Complemento:</label>
                                                <input type='text' placeholder='Insira o complemento' name='complementoFunc' value='".$row['complementoEndereco']."' class='form-control' id='complementoFunc'>
                                            </div>
                                        </div>

                                        <div class='row'>
                                            <div class='col'>
                                                <label for='recipient-name' class='col-form-label'>Cidade:</label>
                                                <input type='text' placeholder='Insira a cidade' name='cidadeFunc' value='".$row['cidadeEndereco']."' class='form-control' id='cidadeFunc' required>
                                            </div>
                                            <div class='col-3'>
                                                <label for='recipient-name' class='col-form-label'>U.F:</label>
                                                <input type='text' placeholder='Insira a UF' maxlength='2' name='ufFunc' value='".$row['ufEndereco']."' class='form-control' id='ufFunc' required>
                                            </div>
                                            <div class='col-3'>
                                                <label for='recipient-name' class='col-form-label'>C.E.P:</label>
                                                <input type='text' placeholder='Insira o CEP' name='cepFunc' value='".$row['cepEndereco']."' class='form-control' id='cepFunc'>
                                            </div>
                                        </div>

                                    </div>
                                    
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fechar</button>
                                        <button type='submit' name='submit-editar' value='Alterar' class='btn btn-success'>Alterar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    ";

                    echo "
                    <tr>
                        <td class='subtituloConteudo'>".$row['idFunc']."</td>
                        <td class='subtituloConteudo'>".$row['nomeFunc']."</td>
                        <td class='subtituloConteudo'>".$row['emailFunc']."</td>
                        <td class='subtituloConteudo'>".$row['telFunc']."</td>
                        <td class='subtituloConteudo'><img class='sidebarIcons' data-bs-toggle='modal' data-bs-target='#editarFuncModal".$row['idFunc']."' src='estilo/icons/edit.png' width='18' height='18'> <img onclick='deletarFunc(".$row['idFunc'].")' class='sidebarIcons' src='estilo/icons/trash.png' width='18' height='18'></div></td>
                    </tr>
                    ";

                }
            }

        }
    }

    function adiciona_fornecedor($con, $dadosForn){
        if(isset($_SESSION['idFunc'])){
            
            $query = "INSERT INTO tbfornecedor (nomeEmpresaFornecedor, nomeFornecedor, emailFornecedor, telFornecedor, cnpjFornecedor) 
            VALUES ('".$dadosForn['nomeEmp']."', '".$dadosForn['nomeForn']."', '".$dadosForn['email']."', '".$dadosForn['telefone']."', '".$dadosForn['cnpj']."')";

            $resultado = mysqli_query($con, $query);

            if($resultado){

                echo '<script type="text/javascript"> window.location.replace("fornecedores.php");</script>';

            }


        }
    }

    function edita_fornecedores($con, $dadosForn){
        if(isset($_SESSION['idFunc'])){

            $query = "UPDATE tbfornecedor SET nomeEmpresaFornecedor = '".$dadosForn['nomeEmp']."', nomeFornecedor = '".$dadosForn['nomeForn']."', emailFornecedor = '".$dadosForn['email']."', telFornecedor = '".$dadosForn['telefone']."', cnpjFornecedor = '".$dadosForn['cnpj']."' WHERE idFornecedor = ".$dadosForn['id']."";


            if(mysqli_query($con, $query)){
                echo '<script type="text/javascript"> window.location.replace("fornecedores.php");</script>';
            }

        }
    }

    function deleta_fornecedor($con, $id){
        if(isset($_SESSION['idFunc'])){
            $query = "DELETE FROM tbfornecedor WHERE idFornecedor = '$id'";

            if(mysqli_query($con, $query)){
                return true;
            }else {
                return false;
            }
            
        }
    }

    function carrega_fornecedores($con){
        if(isset($_SESSION['idFunc'])){

            $query = "SELECT * FROM tbfornecedor";
            $resultado = mysqli_query($con, $query);

            if($resultado){

                while($row = mysqli_fetch_array($resultado)){

                    if (!empty($_POST['submit-editar'])) {
                        
                        $dadosForn['id'] = $_POST['idForn'];

                        $dadosForn['nomeForn'] = $_POST['nomeForn'];
                        $dadosForn['nomeEmp'] = $_POST['nomeEmpForn'];
                        $dadosForn['email'] = $_POST['emailForn'];
                        $dadosForn['telefone'] = $_POST['telefoneForn'];
                        $dadosForn['cnpj'] = $_POST['cnpjForn'];
                
                        edita_fornecedores($con, $dadosForn);
                
                    }

                    echo "
                    <div class='modal fade' id='editarFornModal".$row['idFornecedor']."' tabindex='-1' aria-labelledby='editarFornModalLabel".$row['idFornecedor']."' aria-hidden='true'>
                        <div class='modal-dialog modal-lg modal-dialog-centered'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='exampleModalLabel'>Cadastro de Fornecedor</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Fechar'></button>
                                </div>
                                <form method='POST'>
                                    <div class='modal-body'>

                                        <div class='row'>
                                            <h5 class='modal-title'>Dados do Fornecedor</h5>
                                            <input type='hidden' value='".$row['idFornecedor']."' name='idForn' id='idForn'>
                                        </div>
                                        <div class='row'>
                                            <div class='col'>
                                                <label for='recipient-name' class='col-form-label'>Nome do fornecedor:</label>
                                                <input type='text' value='".$row['nomeFornecedor']."' placeholder='Insira o nome completo' name='nomeForn' class='form-control' id='nomeForn' required>
                                            </div>
                                            <div class='col-6'>
                                                <label for='recipient-name' class='col-form-label'>Nome da empresa:</label>
                                                <input type='text' value='".$row['nomeEmpresaFornecedor']."' place holder='Insira o nome completo' name='nomeEmpForn' class='form-control' id='nomeEmpForn' required>
                                            </div>
                                            
                                        </div>

                                        <div class='row'>
                                            <div class='col'>
                                                <label for='recipient-name' class='col-form-label'>E-mail:</label>
                                                <input type='email' value='".$row['emailFornecedor']."' placeholder='Insira o e-mail' name='emailForn' class='form-control' id='emailForn' required>
                                            </div>
                                        </div>

                                        <div class='row'>
                                            <div class='col'>
                                                <label for='recipient-name' class='col-form-label'>Telefone:</label>
                                                <input type='text' value='".$row['telFornecedor']."' placeholder='Insira um telefone' maxlength='20' name='telefoneForn' class='form-control' id='telefoneForn' required>
                                            </div>
                                            <div class='col-6'>
                                                <label for='recipient-name' class='col-form-label'>CNPJ:</label>
                                                <input type='text' value='".$row['cnpjFornecedor']."' placeholder='Insira o CNPJ'  maxlength='20' name='cnpjForn' class='form-control' id='cnpjForn' required>
                                            </div>
                                        </div>

                                    </div>
                                    
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fechar</button>
                                        <button type='submit' name='submit-editar' value='Alterar' class='btn btn-success'>Alterar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    ";

                    echo "
                    <tr>
                        <td class='subtituloConteudo'>".$row['idFornecedor']."</td>
                        <td class='subtituloConteudo'>".$row['nomeEmpresaFornecedor']."</td>
                        <td class='subtituloConteudo'>".$row['nomeFornecedor']."</td>
                        <td class='subtituloConteudo'>".$row['emailFornecedor']."</td>
                        <td class='subtituloConteudo'>".$row['telFornecedor']."</td>
                        <td class='subtituloConteudo'><img class='sidebarIcons' data-bs-toggle='modal' data-bs-target='#editarFornModal".$row['idFornecedor']."' src='estilo/icons/edit.png' width='18' height='18'> <img onclick='deletarForn(".$row['idFornecedor'].")' class='sidebarIcons' src='estilo/icons/trash.png' width='18' height='18'></div></td>
                    </tr>
                    ";

                }
            }

        }
    }

?>