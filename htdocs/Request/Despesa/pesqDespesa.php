<?php
include_once __DIR__ . "/../../Data/conexao.php";
if (!isset($_SESSION)) {
    session_start();
}

if(isset($_POST['DataInicial']) && isset($_POST['DataFinal'])){
    if(!empty($_POST[''])){

    }else if(!empty($_POST[''])){

    }else if(!empty($_POST[''])){

    }else if(!empty($_POST[''])){

    }
}else{
    $retorno = array("Retorno"=> "ERRO", "Motivo"=> "Nao encontrada POST");
    echo json_encode($retorno);
    exit;
}