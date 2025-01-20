<?php
include_once __DIR__ . "/../../Data/conexao.php";
if (!isset($_SESSION)) {
    session_start();
}

if(isset($_POST['DescricaoCat'])){

    if(!empty($_POST['DescricaoCat'])){
        
        try {
            $insert = $conexao->prepare("INSERT INTO cadcategoria (DescricaoCat, Tipo) VALUES (?,?)");
            $insert->bind_param("ss", $_POST['DescricaoCat'], $_POST['Tipo']);
            $insert->execute();
            $Res = $insert->get_result();
            if($Res->num_rows > 0 ){
                $IdCat = $Res->fetch_assoc();
                $IdCat =  $Res['idCat'];
            }
            var_dump($IdCat);
            die();
            $insert->close();
            $retorno = array("Retorno" => "OK", "Motivo" => "Cadastrado com sucesso!");
            if(!empty($_POST['SubCategoria'])){
                $insert = $conexao->prepare("INSERT INTO catsubcategoria (idCat, DescricaoSub) VALUES (?,?)");
                $insert->bind_param("is","", $_POST['SubCategoria']);
                $insert->execute();
                $insert->close();
            }
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