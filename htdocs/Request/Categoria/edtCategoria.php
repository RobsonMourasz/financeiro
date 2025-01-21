<?php
include_once __DIR__ . "/../../Data/conexao.php";
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['IdCat'])) {
    if (!empty($_POST['IdCat'])) {
        $idCat = intval(limpar_texto($_POST['IdCat']));
        $idSub = intval(limpar_texto($_POST['IdSub']));
        try {
            $update = $conexao->prepare("UPDATE cadcategoria SET DescricaoCat = ?, Tipo = ? WHERE idCat = ?");
            $update->bind_param("ssi", $_POST['DescricaoCat'], $_POST['Tipo'], $idCat);
            $update->execute();
            $update->close();

            $update = $conexao->prepare("UPDATE catsubcategoria SET DescricaoSub = ? WHERE  idSub = ? AND idCat = ? ");
            $update->bind_param("sii", $_POST['DescricaoSub'], $idSub, $idCat);
            $update->execute();
            $update->close();
            $conexao->close();
            $retorno = array("Retorno" => "OK", "Motivo" => "Alterado com sucesso !");
        } catch (\Throwable $th) {
            $retorno = array("Retorno" => "ERRO", "Motivo" => "Erro interno: " . $th->getMessage());
        }

        echo json_encode($retorno);
        exit;
    }else{
        $retorno = array("Retorno" => "ERRO", "Motivo" => "Campo id vazio");
        echo json_encode($retorno);
        exit;
    }
} else {
    $retorno = array("Retorno" => "ERRO", "Motivo" => "Não existe POST idcat");
    echo json_encode($retorno);
    exit;
}
