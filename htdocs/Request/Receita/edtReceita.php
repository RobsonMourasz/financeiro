<?php
include_once __DIR__ . "/../../Data/conexao.php";
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_GET['id'])) {
    try {
        $id = limpar_texto($_GET['id']);
        $confimado = $_GET['Confirmado'];
        $update = $conexao->query("UPDATE cr_lancamentos SET Confirmada = '$confimado' WHERE idCR = $id");
        $retorno = array("Retorno" => "OK", "Motivo" => "Alterado com sucesso!");
    } catch (\Throwable $th) {
        $retorno = array("Retorno" => "ERRO", "Motivo" => $th->getMessage());
    }

    echo json_encode($retorno);
    exit;
}

if (isset($_POST['Descricao']) && !empty($_POST['Descricao'])) {
    $descricao = $_POST['Descricao'];
    $vr_parcela = FormatarFloat($_POST['ValorParcela']);
    $vencimento = $_POST['DataVencimento'];
    $idConta = limpar_texto($_POST['idConta']);
    $idCat = limpar_texto($_POST['categoria']);
    $idSub = limpar_texto($_POST['sub']);
    $idCR = intval(limpar_texto($_POST['idCR']));
    $controle = limpar_texto($_POST['Controle']);
    $parcelado = $_POST['Parcelado'];
    $confimado = $_POST['Confirmada'];
    $alterarTodos = $_POST['AlterarTodos'];

    try {
        if ($alterarTodos == "S") {

            try {
                $selectControle = $conexao->query("SELECT * FROM cr_lancamentos WHERE idCR = $idCR ");
                $selectControle = $selectControle->fetch_assoc();
            } catch (\Throwable $th) {
                $retorno = array("Retorno" => "ERRO", "Motivo" => "SQL(selectControle): ". $th->getMessage());
                echo json_encode($retorno);
                exit;
            }
            
            $data = $selectControle['DataVencimento'];

            $sql = "UPDATE cr_lancamentos a 
                    SET 
                        a.idConta = ?, 
                        a.idCategoria = ?,
                        a.id_SubCategoria = ?, 
                        a.Descricao = ?,
                        a.Confirmada = ?,
                        a.ValorParcela = ?
                    WHERE 
                        a.Controle LIKE ? 
                    AND
                        a.DataVencimento >= ?;
                    ";
            $update = $conexao->prepare($sql);
            $update->bind_param("iiissdss", $idConta, $idCat, $idSub, $descricao, $confimado, $vr_parcela, $controle, $data);
        } else {
            $sql = "UPDATE cr_lancamentos a 
                    SET 
                        a.idConta = ?, 
                        a.idCategoria = ?,
                        a.id_SubCategoria = ?, 
                        a.Descricao = ?,
                        a.Confirmada = ?,
                        a.ValorParcela = ?
                    WHERE 
                        a.idCR = ?;
                    ";
            $update = $conexao->prepare($sql);
            $update->bind_param("iiissdi", $idConta, $idCat, $idSub, $descricao, $confimado, $vr_parcela, $idCR);
        }

        try {
            $update->execute();
            $retorno = array("Retorno" => "OK", "Motivo" => "Alterado com sucesso!");
        } catch (\Throwable $th) {
            $retorno = array("Retorno" => "ERRO", "Motivo" => "Execute() " . $th->getMessage());
        }
    } catch (\Throwable $th) {
        $retorno = array("Retorno" => "ERRO", "Motivo" => "SQL " . $th->getMessage());
    }

    echo json_encode($retorno);
}
