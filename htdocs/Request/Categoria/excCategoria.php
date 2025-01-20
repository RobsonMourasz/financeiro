<?php
include_once __DIR__ . "/../../Data/conexao.php";
if (!isset($_SESSION)) {
    session_start();
}

if(isset($_GET['id'])){
    if(!empty($_GET['id'])){
        try {
            $id = intval(limpar_texto($_GET['id']));
            $delete = $conexao->query("DELETE FROM cadcategoria WHERE idCat = $id");
            $retorno = array("Retorno" => "OK", "Motivo" => "Excluido com sucesso!");
        } catch (\Throwable $th) {
            $retorno = array("Retorno" => "ERRO", "Motivo" => $th->getMessage());
        }
        echo json_encode($retorno);
    }else{
        $retorno = array("Retorno" => "ERRO", "Motivo" => "Id Vazio");
        echo json_encode($retorno);
    }
}else{
    $retorno = array("Retorno" => "ERRO", "Motivo" => "GET id não encontrado!");
    echo json_encode($retorno);
}
