<?php
include_once __DIR__ . "/../../Data/conexao.php";
if (!isset($_SESSION)) {
    session_start();
}

if(isset($_GET['idCR']) && !empty($_GET['idCR'])){
    if (isset($_GET['todos']) && !empty($_GET['todos'])) {
        
        if(!empty($_GET['vencimento'])){
            $data = $_GET['vencimento'];
        }else{
            $data = date('Y-m-d');
        }

        $id = intval(limpar_texto($_GET['idCR']));
        $Parcelado = $_GET['todos'];
        if ($Parcelado == "S"){
            try {
                $selectControle = $conexao->query("SELECT * FROM cp_lancamentos WHERE idCR = $id ");
                $selectControle = $selectControle->fetch_assoc();
            } catch (\Throwable $th) {
                $retorno = array("Retorno" => "ERRO", "Motivo" => "SQL(selectControle): ". $th->getMessage());
                echo json_encode($retorno);
                exit;
            }
            
            $controle = $selectControle['Controle'];

            try {
                $conexao->query("DELETE FROM cp_lancamentos WHERE Controle LIKE '$controle' AND DataVencimento >= '$data'");
                $retorno = array("Retorno"=> "OK", "Motivo"=> "Registro excluido!");
            } catch (\Throwable $th) {
                $retorno = array("Retorno" => "ERRO", "Motivo" => "SQL(DELETE): ". $th->getMessage());
            }

            echo json_encode($retorno);
            exit;
            
        }else{

            try {
                $conexao->query("DELETE FROM cp_lancamentos WHERE idCR = $id");
                $retorno = array("Retorno"=> "OK", "Motivo"=> "Registro excluido!");
            } catch (\Throwable $th) {
                $retorno = array("Retorno" => "ERRO", "Motivo" => "SQL(DELETE): ". $th->getMessage());
            }

            echo json_encode($retorno);
            exit;

        }
        
    }else{
        $retorno = array("Retorno" => "ERRO", "Motivo" => "VALOR  GET TODOS VAZIO OU NAO EXISTE");
        echo json_encode($retorno);
        exit;
    }

}else{
    $retorno = array("Retorno" => "ERRO", "Motivo" => "VALOR  GET IDCR VAZIO OU NAO EXISTE");
    echo json_encode($retorno);
    exit;
}