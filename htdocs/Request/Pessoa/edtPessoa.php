<?php
include_once __DIR__ . "/../../Data/conexao.php";
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['nomeSocial'])) {

    if (!empty($_POST['nomeSocial'])) {
        $Cpf_Cnpj = limpar_texto($_POST['cnpj']);
        $Telefone = limpar_texto($_POST['telefone']);
        try {
            $Update = $conexao->prepare("UPDATE cadpessoas SET NomePessoa = ?, EnderecoPessoa = ?, Cpf_Cnpj = ?, Email= ?, Telefone = ?");
            $Update->bind_param("sssss", $_POST['nomeSocial'], $_POST['endereco'], $Cpf_Cnpj, $_POST['email'], $Telefone);
            $Update->execute();
            $Update->close();
            $retorno = ["Retorno" => "OK", "Motivo" => "Pessoa alterado com sucesso!"];
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
    $retorno = ["Retorno" => "Erro", "Motivo" => "Não encontrado POST['nome']"];
    echo json_encode($retorno);
    exit;
}