<?php
include_once __DIR__ . "/../../Data/conexao.php";
if (!isset($_SESSION)) {
    session_start();
}

if(isset($_GET['id'])){
    if($_GET['id'] === "todos"){
        $PesqConta = $conexao->query("SELECT * FROM cadconta");
        $PesqConta = $PesqConta->fetch_all(MYSQLI_ASSOC);
        $retorno = array("Retorno" => "OK", "Dados" => $PesqConta);
    }else{
        $id= intval(limpar_texto($_GET['id']));
        $PesqConta = $conexao->query("SELECT * FROM cadconta WHERE idConta = $id");
        if($PesqConta->num_rows > 0){
            $PesqConta = $PesqConta->fetch_all(MYSQLI_ASSOC);
            $retorno = array("Retorno" => "OK", "Dados" => $PesqConta);  
        }else{
            $retorno = array("Retorno" => "ERRO", "Motivo" => "Nenhuma Conta Encontrada !");  
        }
    }
    echo json_encode($retorno);
    exit;
}else{
    $retorno = array("Retorno" => "ERRO", "Motivo" => "GET id não encontrado!");
    echo json_encode($retorno);
    exit;
}