<?php

    ?><style> <?php include 'estilo/paginas.css'; ?> </style><?php

    //Função que verifica se o usuário navegando entre as paginas está logado ou não, caso não esteja é redirecionado a tela de login.

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

    //Função usada pra gerar um número aleatório, fou implementada na recuperação de senha dos usuários.

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

    //Função da recuperação de senha em si, onde a mesma recebe o email digitado e compara com os emails cadastrados no banco, 
    //caso exista é enviado um e-mail contendo uma nova senha ao usuário.

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

    //Função chamada pelo javascript para deletar um funcionário.

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

    //Função chamada pelo modal de cadastro de funcionários, onde ao cadastrar o mesmo um e-mail é enviado contendo sua senha de primeiro acesso.

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

    //Funcão chamada para alterar os dados modificados do usuário no banco

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

    //Função responsável por carregar os dados do usuário logado na tela de configurações.

    function carrega_usuario($con){
        if(isset($_SESSION['idFunc'])){

            $id = $_SESSION['idFunc'];
            $query = "SELECT * FROM tbfunc WHERE idFunc = '$id'";
            $resultado = mysqli_query($con, $query);

            if($resultado){
                
                while($row = mysqli_fetch_array($resultado)){


                echo "
                <div class='modal-body'>
                    <input type='hidden' value='".$row['idFunc']."' name='idFunc' id='idFunc'>
                    <div class='row'>
                        <div class='col'>
                            <label for='recipient-name' class='col-form-label'>Nome:</label>
                            <input type='text' placeholder='Insira o nome completo' name='nomeFunc' value='".$row['nomeFunc']."' class='form-control' id='nomeFunc' disabled>
                        </div>
                        <div class='col-6'>
                            <label for='recipient-name' class='col-form-label'>E-mail:</label>
                            <input type='email' placeholder='Insira o e-mail' name='emailFunc' value='".$row['emailFunc']."' class='form-control' id='emailFunc' disabled>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col'>
                            <label for='recipient-name' class='col-form-label'>Gênero:</label>
                            <select class='form-select' name='geneFunc' id='geneFunc' aria-label='Default select example' disabled>
                                <option>Selecione o sexo</option>
                                <option ".funcF($row['generoFunc'])." value='F'>Feminino</option>
                                <option ".funcM($row['generoFunc'])." value='M'>Masculino</option>
                            </select>
                        </div>
                        <div class='col-3'>
                            <label for='recipient-name' class='col-form-label'>Naturalidade:</label>
                            <input type='text' placeholder='Insira a naturalidade' maxlength='2' name='naturaFunc' value='".$row['naturalidadeFunc']."' class='form-control' id='naturaFunc' disabled>
                        </div>
                        <div class='col'>
                            <label for='recipient-name' class='col-form-label'>R.G:</label>
                            <input type='text' placeholder='Insira o RG' maxlength='15' name='rgFunc' value='".$row['rgFunc']."' class='form-control' id='rgFunc' disabled>
                        </div>
                        <div class='col'>
                            <label for='recipient-name' class='col-form-label'>C.P.F:</label>
                            <input type='text' placeholder='Insira o CPF' maxlength='15' name='cpfFunc' value='".$row['cpfFunc']."' class='form-control' id='cpfFunc' disabled>
                        </div>
                    </div>
                    
                    <div class='row'>
                        <div class='col'>
                            <label for='recipient-name' class='col-form-label'>Cargo:</label>
                            <select class='form-select' name='cargoFunc' id='cargoFunc' aria-label='Default select example' disabled>
                                <option>Selecione o cargo</option>
                                <option ".funcC1($row['idCargo'])." value='1'>Administrador</option>
                                <option ".funcC2($row['idCargo'])." value='2'>Caixa</option>
                            </select>
                        </div>
                        <div class='col-3'>
                            <label for='recipient-name' class='col-form-label'>Telefone:</label>
                            <input type='text' placeholder='Insira um telefone' name='telefoneFunc' value='".$row['telFunc']."' class='form-control' id='telefoneFunc' disabled>
                        </div>
                        <div class='col-3'>
                            <label for='recipient-name' class='col-form-label'>Data de Nascimento:</label>
                            <input name='dataNascFunc' id='dataNascFunc' class='form-control' value='".$row['dataNascFunc']."' type='date' disabled/>
                        </div>
                        <div class='col-3'>
                            <label for='recipient-name' class='col-form-label'>Data de Admissão:</label>
                            <input name='dataAdmiFunc' id='dataAdmiFunc' class='form-control' value='".$row['dataContratoFunc']."' type='date' disabled/>
                        </div>
                    </div>
                    </div>
                ";
                }

            }
        }
    }

    function cargo_func($id){
        
        if($id == 1){
             return "Administrador";
        }else if($id == 2){
            return "Caixa";
        }
    }

    //Função responsável por listar os funcionários do sistema, assim como carregar um modal de edição individual para cada um dos mesmos e um botão de exclusão.

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
                        <td class='subtituloConteudo'>".$row['nomeFunc']."  </td>
                        <td class='subtituloConteudo'>".cargo_func($row['idCargo'])."</td>
                        <td class='subtituloConteudo'>".$row['emailFunc']."</td>
                        <td class='subtituloConteudo'>".$row['telFunc']."</td>
                        <td class='subtituloConteudo'><img class='sidebarIcons' data-bs-toggle='modal' data-bs-target='#editarFuncModal".$row['idFunc']."' src='estilo/icons/edit.png' width='18' height='18'> <img onclick='deletarFunc(".$row['idFunc'].")' class='sidebarIcons' src='estilo/icons/trash.png' width='18' height='18'></div></td>
                    </tr>
                    ";

                }
            }

        }
    }

    //Função chamada pelo modal de cadastro de fornecedores, onde é realizado o cadastro do mesmo no banco.


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

    //Função associada ao modal de ediçaõ de fornecedores, onde os dados atualizados são alterados no banco.

    function edita_fornecedores($con, $dadosForn){
        if(isset($_SESSION['idFunc'])){

            $query = "UPDATE tbfornecedor SET nomeEmpresaFornecedor = '".$dadosForn['nomeEmp']."', nomeFornecedor = '".$dadosForn['nomeForn']."', emailFornecedor = '".$dadosForn['email']."', telFornecedor = '".$dadosForn['telefone']."', cnpjFornecedor = '".$dadosForn['cnpj']."' WHERE idFornecedor = ".$dadosForn['id']."";


            if(mysqli_query($con, $query)){
                echo '<script type="text/javascript"> window.location.replace("fornecedores.php");</script>';
            }

        }
    }

    //Função chamada na listagem de fornecedores para deletar os mesmos.

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

    //Função responsável por listar os fornecedores do sistema, assim como carregar um modal de edição individual para cada um dos mesmos e um botão de exclusão.


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

    //Função responsável por listar o estoque de produtos

    function lista_fornecedor($con){
        if(isset($_SESSION['idFunc'])){
            $fornecedores = "SELECT * FROM tbfornecedor";
            $result = mysqli_query($con, $fornecedores);

            if($result){
                while($row = mysqli_fetch_array($result)){
                    echo "<option value='".$row['idFornecedor']."'>".$row['nomeEmpresaFornecedor']."</option>";
                }
            }
        }
    }

    //Função chamada pelo modal de cadastro de produtos, onde é realizado o cadastro dos mesmos no banco.

    function adiciona_produto($con, $dadosProd, $imgName, $imgTmp, $imgFolder){
        if(isset($_SESSION['idFunc'])){
            
            $query = "INSERT INTO tbproduto (idFornecedor , nomeProduto, descricaoProduto, imagemProduto, dataVencimentoProduto, dataFabricacaoProduto, qtdeProduto, precoProduto, loteProduto) 
            VALUES (".$dadosProd['FornecedorProd'].", '".$dadosProd['nomeProd']."', '".$dadosProd['descProd']."', '".$imgName."', '".$dadosProd['dataVenciProd']."', '".$dadosProd['dataFabriProd']."', ".$dadosProd['qntdProd'].", ".$dadosProd['precoProd'].", '".$dadosProd['loteProd']."')";

            $resultado = mysqli_query($con, $query);

            if($resultado){
                move_uploaded_file($imgTmp, $imgFolder);
                echo '<script type="text/javascript"> alert("'.$imgTmp.'");</script>';
                //echo '<script type="text/javascript"> window.location.replace("estoque.php");</script>';

            }


        }
    }

  //Funções responsáveis por listar os fornecedores nas guias de cadastro e edição de produtos.  

    function fornecedor_selected($id, $idForn){
        if ($id == $idForn){
            return "selected='selected'";
        }else{
            return "";
        }
    }

    function lista_fornecedor_selecionado($con, $id){
        if(isset($_SESSION['idFunc'])){
            $fornecedores = "SELECT * FROM tbfornecedor";
            $result = mysqli_query($con, $fornecedores);

            if($result){
                while($row = mysqli_fetch_array($result)){
                    echo "<option ".fornecedor_selected($id, $row['idFornecedor'])." value='".$row['idFornecedor']."'>".$row['nomeEmpresaFornecedor']."</option>";
                }
            }
        }
    }

    //Função associada ao modal de ediçaõ de produtos, onde os dados atualizados são alterados no banco.

    function edita_produtos($con, $dadosProd, $imgName, $imgTmp, $imgFolder){
        if(isset($_SESSION['idFunc'])){

            $query = "UPDATE tbproduto SET nomeProduto = '".$dadosProd['nomeProd']."', descricaoProduto = '".$dadosProd['descProd']."', imagemProduto = '".$imgName."', dataVencimentoProduto = '".$dadosProd['dataVenciProd']."', dataFabricacaoProduto = '".$dadosProd['dataFabriProd']."', qtdeProduto = ".$dadosProd['qntdProd'].", precoProduto = ".$dadosProd['precoProd'].", loteProduto = '".$dadosProd['loteProd']."' WHERE idProduto = ".$dadosProd['id']."";

            if(mysqli_query($con, $query)){
                if(move_uploaded_file($imgTmp, $imgFolder)){

                    echo '<script type="text/javascript"> window.location.replace("estoque.php");</script>';

                }
            }

        }
    }

    //Função chamada na listagem de produtos para deletar os mesmos.

    function deleta_produto($con, $id){
        if(isset($_SESSION['idFunc'])){
            $query = "DELETE FROM tbproduto WHERE idProduto = '$id'";

            if(mysqli_query($con, $query)){
                return true;
            }else {
                return false;
            }
            
        }
    }

    //Função responsável por listar os produtos do sistema, assim como carregar um modal de edição individual para cada um dos mesmos e um botão de exclusão.

    function carrega_produto($con){
        if(isset($_SESSION['idFunc'])){

            $query = "SELECT * FROM tbproduto";
            $resultado = mysqli_query($con, $query);

            if($resultado){

                while($row = mysqli_fetch_array($resultado)){

                    $fornecedor = "SELECT * FROM tbfornecedor INNER JOIN tbproduto ON tbfornecedor.idFornecedor = tbproduto.idFornecedor WHERE tbproduto.idFornecedor = ".$row['idFornecedor']."";
                    $query2 = mysqli_query($con, $fornecedor);

                    if($query2 = mysqli_fetch_array($query2)){

                        if (!empty($_POST['submit-editar'])) {
                        
                            $dadosProd['id'] = $_POST['idProd'];
    
                            $dadosProd['nomeProd'] = $_POST['nomeProd'];
                            $dadosProd['FornecedorProd'] = $_POST['FornecedorProd'];
                            $dadosProd['descProd'] = $_POST['descProd'];
                            $dadosProd['dataVenciProd'] = $_POST['dataVenciProd'];
                            $dadosProd['dataFabriProd'] = $_POST['dataFabriProd'];
                            $dadosProd['precoProd'] = floatval($_POST['precoProd']);
                            $dadosProd['qntdProd'] = $_POST['qntdProd'];
                            $dadosProd['loteProd'] = $_POST['loteProd'];

                            $ImgNameProd = $_FILES['fotoProd']['name'];
                            $ImgTmpNameProd = $_FILES['fotoProd']['tmp_name'];
                            $folderImgProd = 'estilo/imgs/Produtos/'.$ImgNameProd;
                    
                            edita_produtos($con, $dadosProd, $ImgNameProd, $ImgTmpNameProd, $folderImgProd);
                    
                        }

                        echo "
                        <div class='modal fade' id='editarProdModal".$row['idProduto']."' tabindex='-1' aria-labelledby='editaProdModalLabel".$row['idProduto']."' aria-hidden='true'>
                            <div class='modal-dialog modal-lg modal-dialog-centered'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='exampleModalLabel'>Edição de Produto</h5>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Fechar'></button>
                                    </div>
                                    <form method='POST' enctype='multipart/form-data'>
                                        <div class='modal-body'>
            
                                            <div class='row'>
                                                <input type='hidden' value='".$row['idProduto']."' name='idProd' id='idProd'>
                                                <h5 class='modal-title'>Dados do Produto</h5>
                                            </div>
                                            <div class='row'>
                                                <div class='col'>
                                                    <label for='recipient-name' class='col-form-label'>Nome do produto:</label>
                                                    <input type='text' value='".$row['nomeProduto']."' placeholder='Insira o nome completo' name='nomeProd' class='form-control' id='nomeForn' required>
                                                </div>
                                                <div class='col-6'>
                                                    
                                                    <label for='recipient-name' class='col-form-label'>Fornecedor:</label>
                                                    <select class='form-select' name='FornecedorProd' id='FornecedorProd' aria-label='Default select example' required>
                                                        <option>Selecione um fornecedor</option>";
                                                       echo lista_fornecedor_selecionado($con, $row['idProduto']);
                                                    echo "</select>
                                                </div>
                                            </div>
            
                                            <div class='row'>
                                                <div class='col'>
                                                    <label for='recipient-name' class='col-form-label'>Descrição do produto:</label>
                                                    <textarea class='form-control' placeholder='Insira uma descrição para o produto' name='descProd' id='descProd' rows='3'>".$row['descricaoProduto']."</textarea>
                                                </div>
                                            </div>
            
                                            <div class='row'>
                                                <div class='col-3'>
                                                    <label for='recipient-name' class='col-form-label'>Data de fabricação:</label>
                                                    <input value='".$row['dataFabricacaoProduto']."' name='dataFabriProd' id='dataFabriProd' class='form-control' type='date' required/>
                                                </div>
                                                <div class='col-3'>
                                                    <label for='recipient-name' class='col-form-label'>Data de vencimento:</label>
                                                    <input value='".$row['dataVencimentoProduto']."' name='dataVenciProd' id='dataVenciProd' class='form-control' type='date' required/>
                                                </div>
                                                <div class='col'>
                                                    <label for='recipient-name' class='col-form-label'>Foto do produto:</label>
                                                    <input value='".$row['imagemProduto']."' name='fotoProd' id='fotoProd' class='form-control' type='file' accept='image/png' required/>
                                                </div>
                                            </div>
            
                                            <div class='row'>
                                                <div class='col-3'>
                                                    <label for='recipient-name' class='col-form-label'>Preço do produto:</label>
                                                    <input value='".$row['precoProduto']."' name='precoProd' id='precoProd' class='form-control' type='text' required/>
                                                </div>
                                                <div class='col-3'>
                                                    <label for='recipient-name' class='col-form-label'>Quantidade do produto:</label>
                                                    <input value='".$row['qtdeProduto']."' name='qntdProd' id='qntdProd' class='form-control' type='number' min='1' step='any' required/>
                                                </div>
                                                <div class='col'>
                                                    <label for='recipient-name' class='col-form-label'>Lote do produto:</label>
                                                    <input  value='".$row['loteProduto']."' name='loteProd' id='loteProd' class='form-control' type='text' required/>
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
                        <div class='col-3'>
                            <div class='card'>
                                <br>
                                <div class='imgsCard divCard'>
                                    <img src='estilo/imgs/Produtos/".$row['imagemProduto']."' style='margin-top: 10%;' class='imgsCard' width='110'>
                                </div>
                                <div class='card-body'>
                                    <h5 class='card-title'>".$row['nomeProduto']."</h5>
                                    <div class='row'>
                                        <div class='col-6'>
                                            <h6>Quantidade:</h6>
                                        </div>
                                        <div class='col-6'>
                                            <p class='card-text'>".$row['qtdeProduto']."</p>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-6'>
                                            <h6>Preço:</h6>
                                        </div>
                                        <div class='col-6'>
                                            <p class='card-text'>R$ ".$row['precoProduto']."</p>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-6'>
                                            <h6>Fornecedor:</h6>
                                        </div>
                                        <div class='col-6'>
                                            <p class='card-text'>".$query2['nomeEmpresaFornecedor']."</p>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-6'>
                                            <img class='sidebarIcons imgsCard' data-bs-toggle='modal' data-bs-target='#editarProdModal".$row['idProduto']."' src='estilo/icons/edit.png' width='18' height='18'>
                                        </div>
                                        <div class='col-6'>
                                            <img onclick='deletarProd(".$row['idProduto'].")' class='sidebarIcons imgsCard' src='estilo/icons/trash.png' width='18' height='18'>
                                        </div>
                                    </div> 
                                </div>
                            </div>  
                        </div>
                        ";

                    }

                }
            }

        }
    }

    //Função usada na tela de configurações para realizar a alteração da senha, onde é comparada a senha cadastrada no banco com a inserida, 
    //e se as mesmas forem iguais é alterada para a nova senha no banco.

    function alterar_senha($con, $senhaAtual, $novaSenha){
        if(isset($_SESSION['idFunc'])){
            
            $query = "SELECT * FROM tbfunc WHERE idFunc = ".$_SESSION['idFunc']."";
            $resultado = mysqli_query($con, $query);

            if($resultado){
                if($resultado && mysqli_num_rows($resultado) > 0){

                    $dadosUsuario = mysqli_fetch_assoc($resultado);

                    if($dadosUsuario['senhaFunc'] === $senhaAtual){

                        $attSenha = "UPDATE tbfunc SET senhaFunc = '$novaSenha' WHERE idFunc = ".$_SESSION['idFunc']."";

                        mysqli_query($con, $attSenha);

                        $nomeCompleto = $dadosUsuario['nomeFunc'];
                        $nome = explode(" ", $nomeCompleto);

                        $to = $dadosUsuario['emailFunc'];
                        $subject = 'Alteração de Senha';
                        $message = "Olá $nome[0], tudo bem?\n\nSua senha foi alterado com sucesso.\n\n\nA sorveteria Iglu agradece!";
                        $headers = 'From: Sorveteria Iglu';

                        //Envia email
                        mail($to, $subject, $message, $headers);

                    }

                }
            }
        }
    }

    //Função usada na tela de configurações para realizar a alteração do e-mail, onde é comparado o e-mail cadastrado no banco com o inserido, 
    //e se os mesmos forem iguais é alterado para o novo e-mail no banco.

    function alterar_email($con, $emailAtual, $novoEmail){
        if(isset($_SESSION['idFunc'])){
            if(!empty($emailAtual) && !is_numeric($emailAtual) && !empty($novoEmail) && !is_numeric($novoEmail)){

                $query = "SELECT * FROM tbfunc WHERE emailFunc = '$emailAtual'";
                $resultado = mysqli_query($con, $query);

                if($resultado){
                    if($resultado && mysqli_num_rows($resultado) > 0){

                        $dadosUsuario = mysqli_fetch_assoc($resultado);

                        if($dadosUsuario['emailFunc'] === $emailAtual){

                            $attEmail = "UPDATE tbfunc SET emailFunc = '$novoEmail' WHERE idFunc = ".$_SESSION['idFunc']."";

                            mysqli_query($con, $attEmail);

                            $nomeCompleto = $dadosUsuario['nomeFunc'];
                            $nome = explode(" ", $nomeCompleto);

                            $to = $novoEmail;
                            $subject = 'Alteração de E-mail';
                            $message = "Olá $nome[0], tudo bem?\n\nSeu e-mail foi alterado com sucesso.\n\n\nA sorveteria Iglu agradece!";
                            $headers = 'From: Sorveteria Iglu';

                            //Envia email
                            mail($to, $subject, $message, $headers);

                        }

                    }
                }
            }
        }
    }

    //Função que carrega os produtos para adicionar na compra

    function carrega_produtos_venda($con){
        if(isset($_SESSION['idFunc'])){

            $query = "SELECT * FROM tbproduto";
            $resultado = mysqli_query($con, $query);

            if($resultado){

                while($row = mysqli_fetch_array($resultado)){

                    $fornecedor = "SELECT * FROM tbfornecedor INNER JOIN tbproduto ON tbfornecedor.idFornecedor = tbproduto.idFornecedor WHERE tbproduto.idFornecedor = ".$row['idFornecedor']."";
                    $query2 = mysqli_query($con, $fornecedor);

                    if($query2 = mysqli_fetch_array($query2)){

                        if (!empty($_POST['submit-calcular-total'])) {

                            global $dadosVenda;
                        
                            $dadosVenda['id'] = $_POST['idVenda'];
    
                            //$dadosVenda['nomeCliente'] = $_POST['nomeCliente'];
                            //$dadosVenda['telCliente'] = $_POST['telCliente'];
                            //$dadosVenda['statusPedido'] = $_POST['statusPedido'];
                            $dadosVenda['valorUnidade'] = $row['precoProduto'];
                            $dadosVenda['qntdPedido'] = $_POST['qntdVenda'];
                            $dadosVenda['valorPedido'] = floatval($dadosVenda['valorUnidade'] * $dadosVenda['qntdVenda']);
                            $dadosVenda['dataPedido'] = date("Y/m/d");
                            $dadosVenda['idFunc'] = $_SESSION['idFunc'];
                            $dadosVenda['idPagamento'] = $_POST['idPagamento'];
                            $dadosVenda['idProduto'] = $row['idProduto'];
                            
                            carrega_valor_venda();
                            //realiza_venda($con, $dadosVenda);
                    
                        } 

                        echo "
                        <div class='col-5'>
                            <div class='card'>
                                <br>
                                <div class='imgsCard divCard'>
                                    <img src='estilo/imgs/Produtos/".$row['imagemProduto']."' style='margin-top: 10%;' class='imgsCard' width='110'>
                                </div>
                                <div class='card-body'>
                                    <h5 class='card-title'>".$row['nomeProduto']."</h5>
                                    <div class='row'>
                                        <div class='col-7'>
                                            <h6>Quantidade:</h6>
                                        </div>
                                        <div class='col-5'>
                                            <p class='card-text'>".$row['qtdeProduto']."</p>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-6'>
                                            <h6>Preço:</h6>
                                        </div>
                                        <div class='col-6'>
                                            <p class='card-text'>R$ ".$row['precoProduto']."</p>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <label for='recipient-name' class='col-form-label'>Quantidade desejada:</label>
                                    </div>
                                    <form method='POST'>
                                    <div class='row'>
                                        <div class='col-8'>
                                            <input value='' name='qntdVenda' id='qntdVenda' class='form-control' type='number' min='1' step='any'/>
                                        </div>
                                        <div class='col-3'>
                                            <button type='submit-calcular-total' class='btn btn-success'>+</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>  
                        </div>
                        ";

                    }

                }
            }

        }
    }

    function carrega_valor_venda(){
        if(isset($_SESSION['idFunc'])){
            
            $len = isset($dadosVenda['valorPedido']) ? count($dadosVenda['valorPedido']) : 0;
            echo "<label class='col-form-label'>Total: ".$len."</label>";

            //echo '<script type="text/javascript"> alert("'.$len.'");</script>';

        }
    }

    function realiza_venda($con, $dadosVenda){

    }



?>