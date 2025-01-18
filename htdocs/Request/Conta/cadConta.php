<?php
include_once __DIR__ . "/../../Data/conexao.php";
if (!isset($_SESSION)) {
    session_start();
}

if(isset($_POST['DescricaoConta'])){
    if(!empty($_POST['DescricaoConta'])){
        try {
            $Cad = $conexao->prepare("INSERT INTO  cadconta (DescricaoConta, SaldoConta) VALUES (?,?)");
            $Cad->bind_param("sd", $_POST['DescricaoConta'], $_POST['SaldoConta']);
            $Cad->execute();
            $retorno = array("Retorno" => "OK", "Motivo" => "Cadastrado com sucesso!");
        } catch (\Throwable $th) {
            $retorno = array("Retorno" => "ERRO", "Motivo" => $th->getMessage());
        }
        echo json_encode($retorno);
    }else{
        $retorno = array("Retorno" => "ERRO", "Motivo" => "Campo Nome nao pode estar vazio");
        echo json_encode($retorno);
    }
}else{
    $retorno = array("Retorno" => "ERRO", "Motivo" => "GET DescricaoConta Não encontrado");
    echo json_encode($retorno);
}