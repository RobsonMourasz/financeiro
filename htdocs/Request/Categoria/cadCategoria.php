<?php
include_once __DIR__ . "/../../Data/conexao.php";
if (!isset($_SESSION)) {
    session_start();
}

if(isset($_POST['DescricaoCat'])){

    if(!empty($_POST['DescricaoCat'])){
        
        try {

            $insert = $conexao->prepare("INSERT INTO cadcategoria (DescricaoCat, Tipo) VALUES (?, ?)");

            $insert->bind_param("ss", $_POST['DescricaoCat'], $_POST['Tipo']);

            if ($insert->execute()) {
                $IdCat = $insert->insert_id;
            } else {
                $insert->error;
            }
            $insert->close();
            if(!empty($_POST['SubCategoria'])){
                $insert = $conexao->prepare("INSERT INTO catsubcategoria (idCat, DescricaoSub) VALUES (?,?)");
                $insert->bind_param("is", $IdCat, $_POST['SubCategoria']);
                $insert->execute();
                $insert->close();
                $conexao->close();
            }
            $retorno = array("Retorno" => "OK", "Motivo" => "Cadastrado com sucesso!");
        } catch (\Throwable $th) {
            $retorno = array("Retorno" => "ERRO", "Motivo" => $th->getMessage());
        }
        
        echo json_encode($retorno);
    }else{
        $retorno = array("Retorno" => "ERRO", "Motivo" => "Campo descricao não pode ser vazio");
        echo json_encode($retorno);
    }

}else{
    $retorno = array("Retorno" => "ERRO", "Motivo" => "DescricaoCat não existe");
    echo json_encode($retorno);
}