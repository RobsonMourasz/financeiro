<?php
include_once __DIR__ . "/../../Data/conexao.php";
if (!isset($_SESSION)) {
    session_start();
}

if(isset($_GET['idCR']) && !empty($_GET['idCR'])){
    if (isset($_GET['todos']) && !empty($_GET['todos'])) {
        $id = intval(limpar_texto($_GET['idCR']));
        $Parcelado = $_GET['todos'];
        if ($Parcelado == "S"){
            try {
                $selectControle = $conexao->query("SELECT * FROM cp_lancamentos WHERE idCR = $id ");
                $selectControle = $controle->fetch_assoc();
            } catch (\Throwable $th) {
                $retorno = array("Retorno" => "ERRO", "Motivo" => "SQL(selectControle): ". $th->getMessage());
            }
            
            $controle = $selectControle['Controle'];

            try {
                $conexao->query("DELETE FROM cp_lancamentos WHERE Controle = '$controle'");
            } catch (\Throwable $th) {
                $retorno = array("Retorno" => "ERRO", "Motivo" => "SQL(DELETE): ". $th->getMessage());
            }

            echo $retorno;
            exit;
            
        }else{

            try {
                $conexao->query("DELETE FROM cp_lancamentos WHERE idCR = $id");
            } catch (\Throwable $th) {
                $retorno = array("Retorno" => "ERRO", "Motivo" => "SQL(DELETE): ". $th->getMessage());
            }

            echo $retorno;
            exit;

        }
        
    }else{
        $retorno = array("Retorno" => "ERRO", "Motivo" => "VALOR  GET TODOS VAZIO OU NAO EXISTE");
        echo $retorno;
        exit;
    }

}else{
    $retorno = array("Retorno" => "ERRO", "Motivo" => "VALOR  GET IDCR VAZIO OU NAO EXISTE");
    echo $retorno;
    exit;
}