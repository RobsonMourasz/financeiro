
<?php
include_once __DIR__ . "/../../Data/conexao.php";
if (!isset($_SESSION)) {
    session_start();
}

if(isset($_POST["DescricaoConta"])){
    if(!empty($_POST['DescricaoConta'])){
        try {
            $Update = $conexao->prepare("UPDATE cadconta SET DescricaoConta = ?, SaldoConta = ? WHERE IdConta = ?");
            $Update->bind_param("sdi", $_POST['DescricaoConta'],$_POST['SaldoConta'], $_POST['IdConta']);
            $Update->execute();
            $retorno = array("Retorno" => "OK", "Motivo" => "Alterado com sucesso!");
        } catch (\Throwable $th) {
            $retorno = array("Retorno" => "ERRO", "Motivo" => $th->getMessage());
        }
        echo json_encode($retorno);
    }else{
        $retorno = array("Retorno" => "ERRO", "Motivo" => "Nome Vazio");
        echo json_encode($retorno);
    }
}else{
    $retorno = array("Retorno" => "ERRO", "Motivo" => "GET DescricaoConta não encontrado!");
    echo json_encode($retorno);
}