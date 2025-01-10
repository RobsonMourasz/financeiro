<?php
include_once __DIR__ . "/../../Data/conexao.php";
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['nomeSocial'])) {

    if (!empty($_POST['nomeSocial'])) {

        if (isset($_POST['email']) && !empty("email")) {

            $emailPessoa = $_POST['email'];
            $Cpf_Cnpj = limpar_texto($_POST['cnpj']);
            $Telefone = limpar_texto($_POST['telefone']);
            $queryPessoas = $conexao->query("SELECT * FROM cadPessoas where  Cpf_Cnpj = '$Cpf_Cnpj'");

            if ($queryPessoas->num_rows > 1) {
                $retorno = ["Retorno" => "Erro", "Motivo" => "Já existe cliente cadastrado !"];
            }else{
                try {
                    $insert = $conexao->prepare("INSERT INTO cadpessoas (NomePessoa,EnderecoPessoa,Cpf_Cnpj,Email,Telefone) VALUES (?,?,?,?,?) ");
                    $insert->bind_param("sssss", $_POST['nomeSocial'], $_POST['endereco'], $Cpf_Cnpj, $_POST['email'], $Telefone);
                    $insert->execute();
                    $insert->close();
                    $retorno = ["Retorno" => "OK", "Motivo" => "Cliente cadastrado com sucesso!"];
                } catch (\Throwable $th) {
                    $retorno = ["Retorno" => "ERRO", "Motivo" => $th->getMessage()];
                    echo json_encode($retorno);
                    exit;
                }
            }

        } else {

            $retorno = ["Retorno" => "Erro", "Motivo" => "Campo E-mail vazio"];

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

    $retorno = ["Retorno" => "Erro", "Motivo" => "Não encontrado POST['nome']"];
    echo json_encode($retorno);
    exit;

}
