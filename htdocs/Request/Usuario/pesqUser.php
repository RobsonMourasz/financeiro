<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    include_once __DIR__ . "/../../Data/conexao.php";
    $resposta = array("Resposta" => "Aguardando", "Dados" => "0");
    if ($_GET['id'] == "todos") {
        try {
            $cadUser = $conexao->query("SELECT * FROM caduser");
            $Resultado = $cadUser->fetch_all(MYSQLI_ASSOC);
            $resposta = array("Resposta" => "OK", "Dados" => $Resultado);
        } catch (\Throwable $th) {
            $resposta = array("Resposta" => "ERRO", "Motivo" => $th->getMessage());
        }
    } else {
        try {
            $idPessoa = limpar_texto(intval($_GET['id']));
            $cadUser = $conexao->query("SELECT * FROM caduser where idUser = $idPessoa");
            $Resultado = $cadUser->fetch_all(MYSQLI_ASSOC);
            $resposta = array("Resposta" => "OK", "Dados" => $Resultado);
        } catch (\Throwable $th) {
            $resposta = array("Resposta" => "ERRO", "Motivo" => $th->getMessage());
        }
    }
    echo json_encode($resposta);
    exit;
} else {
    $resposta = array("Resposta" => "ERRO", "Motivo" => "Não existe GET[id] ou id vazio");
    echo json_encode($resposta);
    exit;
}
