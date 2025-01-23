<?php
include_once __DIR__ . "/../../Data/conexao.php";
if (!isset($_SESSION)) {
    session_start();
}

if(isset($_POST['Descricao'])){
    if(!empty($_POST['Descricao'])){
        echo"asdasd";
        die();
    }
}