
<?php
include_once __DIR__ . "/../../Data/conexao.php";
if (!isset($_SESSION)) {
    session_start();
}

if(isset($_POST["id"])){
    if(!empty($_POST['id'])){
        try {
            $Update = $conexao->prepare("UPDATE cadconta SET DescricaoConta = ?, SaldoConta = ? ");
            $Update->bind_param("id", $_POST['DescricaoConta'],$_POST['SaldoConta']);
            $Update->execute();
            $retorno = array("Retorno" => "OK", "Motivo" => "Alterado com sucesso!");
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