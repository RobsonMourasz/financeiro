<?php
include_once __DIR__ . "/../../Data/conexao.php";
include_once __DIR__ . "/../../Data/conn.php";
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['NomeUser'])) {

    if (!empty($_POST['NomeUser'])) {

        if (isset($_POST['SenhaUser']) && !empty($_POST['SenhaUser'])) {
            $email = $_POST['EmailUser'];
            $nome = $_POST['NomeUser'];
            $senha = password_hash($_POST['SenhaUser'], PASSWORD_DEFAULT);
            $Cpf_Cnpj = limpar_texto($_POST['cpf_cnpj']);
            $rowsUser = $conexao->query("SELECT * FROM caduser where NomeUser = '$nome' AND Cpf_Cnpj = '$Cpf_Cnpj'");

            if ($rowsUser->num_rows > 1) {
                $retorno = ["Retorno" => "ERRO", "Motivo" => "Já existe Usuario cadastrado !"];
            }else{
                try {
                    $insert = $conexao->prepare("INSERT INTO caduser (Ativo, NomeUser, EmailUser, SenhaUser, cpf_cnpj, Nivel) VALUES (0,?,?,?,?,?)");
                    $insert->bind_param("sssss", $nome, $email, $senha, $Cpf_Cnpj, $_POST['Nivel']);
                    $insert->execute();
                    $insert->close();
                    $conn->select_db("dados");
                    $insertDados = $conn->prepare("INSERT INTO cadlogin (Empresa, Cpf_Cnpj, Email, Ativo) VALUES (?,?,?,0)");
                    $insertDados->bind_param("sss", $nome,  $_SESSION['cpf_cnpj'], $email);
                    $insertDados->execute();
                    $insertDados->close();
                    $retorno = ["Retorno" => "OK", "Motivo" => "Usuario cadastrado com sucesso!"];
                } catch (\Throwable $th) {
                    $retorno = ["Retorno" => "ERRO", "Motivo" => "Insert into: ". $th->getMessage()];
                    echo json_encode($retorno);
                    exit;
                }
            }

        } else {

            $retorno = ["Retorno" => "Erro", "Motivo" => "Senha não informada!"];

        }
        
        echo json_encode($retorno);
        exit();

    } else {

        $retorno = ["Retorno" => "Erro", "Motivo" => "Campo nome está vazio"];
        echo json_encode($retorno);
        exit;

    }
} else {

    $retorno = ["Retorno" => "Erro", "Motivo" => "Não encontrado POST['NomeUser']"];
    echo json_encode($retorno);
    exit;

}
