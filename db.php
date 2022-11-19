<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "iglu";

//Cria conexão

$con = mysqli_connect($serverName, $userName, $password, $dbName);

if(mysqli_connect_errno()){
   // echo "Falha para conectar!";
   
    exit();
}
//echo "Conexão realizada com sucesso!"

?>