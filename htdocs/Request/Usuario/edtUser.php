<?php
include_once __DIR__ . "/../../Data/conexao.php";
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['NomeUser'])) {

    if (!empty($_POST['NomeUser'])) {
        $Cpf_Cnpj = limpar_texto($_POST['cpf_cnpj']);
        $IdUser = limpar_texto(intval($_POST['idUser']));
        if(!empty($_POST['SenhaUser'])){
            $senha = password_hash($_POST['SenhaUser'], PASSWORD_DEFAULT);
        }
        try {

            if(empty($senha)){
                $sql = "UPDATE caduser SET Ativo = ?, NomeUser = ?, EmailUser = ?, Cpf_Cnpj = ?, Email= ?, Nivel=? WHERE idUser = ? ";
            }else{
                $sql = "UPDATE caduser SET Ativo = ?, NomeUser = ?, EmailUser = ?, SenhaUser, Cpf_Cnpj = ?, Email= ?, Nivel=? WHERE idUser = ? ";
            }

            $Update = $conexao->prepare($sql);
            if(empty($senha)){
                $Update->bind_param("isssssi", 0, $_POST['NomeUser'], $_POST['EmailUser'], $Cpf_Cnpj, $_POST['Nivel'], $IdUser);
            }else{
                $Update->bind_param("isssssi", 0, $_POST['NomeUser'], $_POST['EmailUser'], $senha, $Cpf_Cnpj, $_POST['Nivel'], $IdUser);
            }

            $Update->execute();
            $Update->close();
            $retorno = ["Retorno" => "OK", "Motivo" => "Usuario alterado com sucesso!"];
        } catch (\Throwable $th) {
            $retorno = ["Retorno" => "ERRO", "Motivo" => $th->getMessage()];
        }
        echo json_encode($retorno);
        exit;
    }else{
        $retorno = ["Retorno" => "Erro", "Motivo" => "Nome está vazio"];
        echo json_encode($retorno);
        exit;
    }

}else{
    $retorno = ["Retorno" => "Erro", "Motivo" => "Não encontrado POST['NomeUser']"];
    echo json_encode($retorno);
    exit;
}