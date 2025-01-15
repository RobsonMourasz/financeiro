<?php 
include_once __DIR__ . "/../../Data/conexao.php";
if (!isset($_SESSION)) {
    session_start();
}

if(isset($_GET['id'])){
    if(!empty($_GET['id'])){
        $idUser = limpar_texto(intval($_GET['id']));
        try {
            $excUser = $conexao->prepare("DELETE FROM caduser WHERE idUser = ?");
            $queryPessoas->bind_param("i",$idUser);
            $queryPessoas->execute();
            $retorno = array("Retorno"=> "OK", "Motivo"=> "Excluido com sucesso!");
        } catch (\Throwable $th) {
            $retorno = ["Retorno"=> "ERRO", "Motivo"=> $th->getMessage()];
        }
        
        echo json_encode($retorno);
        exit;
    }else{
        $retorno = ["Retorno"=> "ERRO", "Motivo"=>"Id Vazio"];
        echo json_encode($retorno);
        exit;
    }

}else{
    $retorno = ["Retorno"=> "ERRO", "Motivo"=>"ID Não existe"];
    echo json_encode($retorno);
    exit;
}