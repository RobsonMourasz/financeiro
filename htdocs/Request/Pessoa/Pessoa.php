<?php 
    if(isset($_GET['id']) && !empty($_GET['id'])){
        include_once __DIR__."/../../Data/conexao.php";
        if($_GET['id'] == "0"){
            try {
                $cadPessoa = $conexao->query("SELECT * FROM cadpessoas");
                $Resultado = $cadPessoa->fetch_assoc();
                $resposta = array("Resposta"=> "OK", "Dados"=> $Resultado);
            } catch (\Throwable $th) {
                //throw $th;
            }
        }else{
            try {
                $idPessoa = intval($_GET['id']);
                $cadPessoa = $conexao->query("SELECT * FROM cadpessoas where idPessoa = $idPessoa");
                $Resultado = $cadPessoa->fetch_assoc();
                $resposta = array("Resposta"=> "OK", "Dados"=> $Resultado);
            } catch (\Throwable $th) {
                $resposta = array("Resposta" => "ERRO", "Motivo"=> $th->getMessage());
            }
        }

        echo json_encode($resposta);
        exit;
    }