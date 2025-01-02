<?php 
include_once __DIR__."conexao.php";
if (!isset($_SESSION)) {
    session_start();
}

if(isset($_GET['id'])){
    if(!empty($_GET['id'])){
        $idPessoa = intval($_GET['id']);

        $queryPessoas = $conexao->query("SELECT * FROM cadPessoas where ativo=0 and idpessoa = $idPessoa") ;
        if($queryPessoas->num_rows > 0){

            $queryPessoas = $queryPessoas->fetch_all();
            $retorno = ["Retorno"=>"OK", "cadPessoa" => $queryPessoas];

        }else{
            $retorno = ["ERRO"=> "Nenhuma pessoa encontrada"];
        }

    }else{
        echo json_encode("ERRO: id vazio");
        exit;
    }

}else{
    echo json_encode("ERRO: id não existe");
    exit;
}