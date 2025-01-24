<?php
include_once __DIR__ . "/../../Data/conexao.php";
if (!isset($_SESSION)) {
    session_start();
}

if(isset($_POST['Descricao'])){
    if(!empty($_POST['Descricao'])){
        $ValorParcela = FormatarFloat($_POST['ValorParcela']);
        $QtdParcela = limpar_texto($_POST['QtdParcela']);
        $Descricao = $_POST['Descricao'];
        $Vencimento = $_POST['DataVencimento']." 00:00:00";
        $Emissao = date("Y-m-d H:i:s");
        $Alterado = date("Y-m-d H:i:s");
        $Controle = limpar_texto(date("Y-m-d H:i:s"));
        $IdConta = limpar_texto($_POST['idConta']);
        $IdCategoria = limpar_texto($_POST['categoria']);
        $IdSub = limpar_texto($_POST['sub']);

        if(isset($_POST['fixa'])){
            $ParcelaFixa = $_POST['fixa'];
        }else{
            $ParcelaFixa = "N";
        }

        if(isset($_POST['Confirmada'])){
            $ParcelaConfirmada = $_POST['Confirmada'];
        }else{
            $ParcelaConfirmada = "N";
        }

        if(isset($_POST['parcelada'])){
            $Parcelado = $_POST['parcelada'];
        }else{
            $Parcelado = "N";
        }

        if(!empty($_POST['ValorTotal'])){
            $ValorTotal = FormatarFloat($_POST['ValorTotal']);
        }else{
            $ValorTotal = FormatarFloat($_POST['ValorParcela']);
        }


        try {
            $sqlInser = "INSERT INTO cp_lancamentos (idPessoa, idConta, idCategoria, id_SubCategoria, Descricao, Fixa, Parcelada, Confirmada, Tipo, Controle, QtdParcela, ValorParcela, ValorTotal, Desconto, Acrescimo, Abate, DataEmissao, DataVencimento, Alterado) VALUES (1,?,?,?,?,?,?,?,?,?,?,?,?,0.00,0.00,0.00,?,?,?)";

            if($ParcelaFixa === "S"){
                $VencimentoParcela = $Vencimento;
                for ($i=0; $i < 60; $i++) { 
                    $VencimentoParcela = $VencimentoParcela + 30;
                }
            }
    
            if(count($QtdParcela) < 1 ){
    
            }else{
    
            }

            $retorno = array("Retorno"=> "OK", "Motivo" => "Despesa Cadastrada com sucesso!");

        } catch (\Throwable $th) {
            $retorno = array("Retorno"=> "ERRO", "Motivo" => $th->getMessage());
        }

        echo json_encode($retorno);
        exit;

    }
}