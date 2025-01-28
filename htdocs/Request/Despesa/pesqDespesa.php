<?php
include_once __DIR__ . "/../../Data/conexao.php";
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['DataInicial']) && isset($_POST['DataFinal'])) {
    $Data1 = $_POST['DataInicial'];
    $Data2 = $_POST['DataFinal'];
    $sqlPesq = "SELECT * 
    FROM cp_lancamentos a 
    WHERE a.DataVencimento BETWEEN '$Data1' AND '$Data2'";

    if (!empty($_POST['categoria'])) {
        $idCat = limpar_texto($_POST['categoria']);
        $sqlAndCategoria = " AND a.idCategoria = $idCat";
        if (!empty($_POST['SubCategoria'])) {
            $idSub = limpar_texto($_POST['SubCategoria']);
            $sqlAndCategoria .= " AND a.id_SubCategoria = $idSub";
        }
    }

    if (!empty($_POST['Tipo'])) {
        $Tipo = $_POST['Tipo'];
        $sqlAndTipo = " AND a.Tipo = '$Tipo'";
    }

    if (!empty($_POST['Situacao'])) {
        $Situacao = $_POST['Situacao'];
        $sqlAndSituacao = " AND a.Confirmada = '$Situacao'";
    }

    $sqlPesq .= $sqlAndCategoria ?? "";
    $sqlPesq .= $sqlAndTipo ?? "";
    $sqlPesq .= $sqlAndSituacao ?? "";

    try {
        $PesqCpLancamentos = $conexao->query($sqlPesq);
        $PesqCpLancamentos = $PesqCpLancamentos->fetch_all(MYSQLI_ASSOC);
        $retorno = array("Retorno" => "OK", "Dados" => $PesqCpLancamentos);
        echo json_encode($retorno);
        exit;
    } catch (\Throwable $th) {
        $retorno = array("Retorno" => "ERRO", "Motivo" => "Consulta SQL: " . $th->getMessage());
        echo json_encode($retorno);
        exit;
    }
} else if (isset($_GET['idCR'])) {
    $id = intval(limpar_texto($_GET['idCR']));
    try {
        $sqlPesq = "SELECT * 
        FROM cp_lancamentos a 
        WHERE a.idCR in($id)";

        $PesqCpLancamentos = $conexao->query($sqlPesq);
        $PesqCpLancamentos = $PesqCpLancamentos->fetch_all(MYSQLI_ASSOC);
        $retorno = array("Retorno" => "OK", "Dados" => $PesqCpLancamentos);
        echo json_encode($retorno);
        
    } catch (\Throwable $th) {
        $retorno = array("Retorno" => "ERRO", "Motivo" => "Consulta SQL: " . $th->getMessage());
        echo json_encode($retorno);
        exit;
    }
} else {
    $retorno = array("Retorno" => "ERRO", "Motivo" => "Nao encontrada POST");
    echo json_encode($retorno);
    exit;
}
