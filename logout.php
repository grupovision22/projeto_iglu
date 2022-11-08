<?php

    session_start();

    if(isset($_SESSION['idFunc'])){

        unset($_SESSION['idFunc']);

    }

    header("Location: login.php");
    die;

?>