<?php

session_start();
include("../db.php");
include("../funcoes.php");

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') { // deletar
    $input = file_get_contents('php://input');
    $inputJson = json_decode($input);

    echo deleta_funcionario($con, $inputJson->codigo);   

}

if ($_SERVER['REQUEST_METHOD'] === 'PUT') { // editar
    $input = file_get_contents('php://input');
    $inputJson = json_decode($input);

    //echo modal_edita_funcionario($con, $inputJson->codigo);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') { // listar
    // The request is using the POST method
}

?>