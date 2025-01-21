<?php
include_once __DIR__ . "/../../Data/conexao.php";
if (!isset($_SESSION)) {
    session_start();
}

if(isset($_GET['idCat'])){
    if(!empty($_GET['idCat'])){
        try {
            $idCat = intval(limpar_texto($_GET['idCat']));
            $idSub = intval(limpar_texto($_GET['idSub']));
            $delete = $conexao->query("DELETE FROM cadcategoria WHERE idCat = $idCat");

            if($idSub > 0){
                $delete = $conexao->query("DELETE FROM catsubcategoria WHERE idSub = $idSub");
            } 
            $retorno = array("Retorno" => "OK", "Motivo" => "Excluido com sucesso!");
        } catch (\Throwable $th) {
            $retorno = array("Retorno" => "ERRO", "Motivo" => $th->getMessage());
        }
        echo json_encode($retorno);
        exit();
    }else{
        $retorno = array("Retorno" => "ERRO", "Motivo" => "Id Vazio");
        echo json_encode($retorno);
        exit();
    }
}else{
    $retorno = array("Retorno" => "ERRO", "Motivo" => "GET id não encontrado!");
    echo json_encode($retorno);
    exit();
}
