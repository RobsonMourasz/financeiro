<?php 
    if(isset($_GET['id']) && !empty($_GET['id'])){
        include_once __DIR__."/../../Data/conexao.php";
        $resposta = array("Resposta"=> "Aguardando", "Dados"=> "0");

        if($_GET['id'] == "todos"){

            try {
                $cadPessoa = $conexao->query("SELECT * FROM cadpessoas");
                //$Resultado = $cadPessoa->fetch_assoc();
                //$dados = $cadPessoa->fetch_assoc();
                $dados = $cadPessoa->fetch_all(MYSQLI_ASSOC);
                $resposta = array("Resposta"=> "OK", "Dados"=> $dados);
            } catch (\Throwable $th) {
                $resposta = array("Resposta" => "ERRO", "Motivo"=> $th->getMessage());
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
    }else{
        $resposta = array("Resposta" => "ERRO", "Motivo"=>"Não existe GET[id] ou id vazio");
        echo json_encode($resposta);
        exit;
    }