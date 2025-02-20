<?php
include_once __DIR__ . "/../../Data/conexao.php";
if (!isset($_SESSION)) {
    session_start();
}

if(isset($_GET['id'])){
    if($_GET['id'] === "todos"){
        $PesqCat = $conexao->query("SELECT a.*, b.DescricaoSub,b.idSub
        FROM cadcategoria a 
        LEFT JOIN catsubcategoria b ON a.idCat = b.idCat");
        $PesqCat = $PesqCat->fetch_all(MYSQLI_ASSOC);
        $retorno = array("Retorno" => "OK", "Dados" => $PesqCat);
    }else{
        $id= intval(limpar_texto($_GET['id']));
        $PesqCat = $conexao->query("SELECT a.*, b.DescricaoSub, b.idSub
        FROM cadcategoria a 
        LEFT JOIN catsubcategoria b ON a.idCat = b.idCat 
        WHERE a.idCat =  $id");
        if($PesqCat->num_rows > 0){
            $PesqCat = $PesqCat->fetch_all(MYSQLI_ASSOC);
            $retorno = ["Retorno" => "OK", "Dados" => $PesqCat];  
        }else{
            $retorno = array("Retorno" => "ERRO", "Motivo" => "Nenhuma Categoria Encontrada !");  
        }
    }
    print_r($retorno);
    exit;
}else{
    $retorno = array("Retorno" => "ERRO", "Motivo" => "GET id não encontrado!");
    var_dump(json_encode($retorno));
    exit;
}