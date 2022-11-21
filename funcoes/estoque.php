<?php

session_start();
include("../db.php");
include("../funcoes.php");

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') { // deletar
    $input = file_get_contents('php://input');
    $inputJson = json_decode($input);

    echo deleta_produto($con, $inputJson->codigo);   

}

?>