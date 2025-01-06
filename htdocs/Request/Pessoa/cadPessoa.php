<?php
include_once __DIR__ . "../../Data/conexao.php";
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['nomeSocial'])) {

    if (!empty($_POST['nomeSocial'])) {

        if (isset($_POST['email']) && !empty("email")) {

            $emailPessoa = $_POST['email'];
            $queryPessoas = $conexao->query("SELECT * FROM cadPessoas where ativo=0 and emailpessoa = `$emailPessoa`");
            if ($queryPessoas->num_rows < 1) {
                $retorno = ["Retorno" => "OK", "cadPessoa" => $queryPessoas];
            }

        } else {

            try {
                $insert = $conexao->prepare("INSERT INTO cadpessoas ('nomecompleto,endereco,cpf_cnpj,email,telefone') VALUES (?????) ");
                $insert->bind_param("sssss", $_POST['nomeSocial'], $_POST['endereco'], $_POST['cnpj'], $_POST['email'], $_POST['telefone']);
                $insert->execute();
                $retorno = ["Retorno" => "OK", "cadPessoa" => "Cliente cadastrado"];
            } catch (\Throwable $th) {
                $retorno = ["Retorno" => "ERRO", "cadPessoa" => $th];
                echo json_encode($retorno);
                exit;
            }

        }
        
        echo json_encode($retorno);
        exit();

    } else {

        echo json_encode("ERRO: nome vazio");
        $retorno = ["Retorno" => "Erro", "Motivo" => ""];
        echo json_encode($retorno);
        exit;

    }
} else {

    print_r($_POST);
    $retorno = ["Retorno" => "Erro", "Motivo" => "Não encontrado POST['nome']"];
    echo json_encode($retorno);
    exit;

}
