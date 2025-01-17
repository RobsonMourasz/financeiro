<?php 
include_once __DIR__ . "/../../Data/conexao.php";
include_once __DIR__ . "/../../Data/conn.php";
if (!isset($_SESSION)) {
    session_start();
}

if(isset($_GET['idUser'])){
    if(!empty($_GET['idUser'])){
        $idUser = intval(limpar_texto($_GET['idUser']));
        try {

            $excUser = $conexao->prepare("DELETE FROM caduser WHERE idUser = ?");
            $excUser->bind_param("i",$idUser);
            $excUser->execute();

            $conn->select_db("dados");
            $inativa = $conn->prepare("UPDATE cadlogin SET Ativo = 1 WHERE Email = ?"); 
            $inativa->bind_param("s",$_GET['EmailUser']);
            $inativa->execute();
            $inativa->close();
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