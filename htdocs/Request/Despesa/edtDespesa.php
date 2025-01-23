<?php
include_once __DIR__ . "/../../Data/conexao.php";
if (!isset($_SESSION)) {
    session_start();
}

if(isset($_GET['id'])){
    try {
        $id = limpar_texto($_GET['id']);
        $confimado = $_GET['Confirmado'];
        $update = $conexao->query("UPDATE cp_lancamentos SET Confirmada = '$confimado' WHERE idCR = $id");
        $retorno = array("Retorno"=> "OK", "Motivo"=> "Alterado com sucesso!");
    } catch (\Throwable $th) {
        $retorno = array("Retorno"=> "ERRO", "Motivo"=> $th->getMessage());
    }

    echo json_encode($retorno);
    exit;
}