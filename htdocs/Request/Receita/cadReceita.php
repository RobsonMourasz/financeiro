<?php
include_once __DIR__ . "/../../Data/conexao.php";
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['Descricao'])) {
    if (!empty($_POST['Descricao'])) {
        $ValorParcela = FormatarFloat($_POST['ValorParcela']);
        $QtdParcela = intval(limpar_texto($_POST['QtdParcela']));
        $Descricao = $_POST['Descricao'];
        $Vencimento = $_POST['DataVencimento'] . " 00:00:00";
        $Emissao = date("Y-m-d H:i:s");
        $Alterado = date("Y-m-d H:i:s");
        $Controle = limpar_texto(date("Y-m-d H:i:s"));
        $IdConta = limpar_texto($_POST['idConta']);
        $IdCategoria = limpar_texto($_POST['categoria']);

        if (isset($_POST['sub']) && !empty($_POST['sub'])) {
            $IdSub = intval(limpar_texto($_POST['sub']));
        } else {
            $IdSub = 0;
        }

        if (isset($_POST['fixa'])) {
            $ParcelaFixa = $_POST['fixa'];
        } else {
            $ParcelaFixa = "N";
        }

        if (isset($_POST['Confirmada'])) {
            $ParcelaConfirmada = $_POST['Confirmada'];
        } else {
            $ParcelaConfirmada = "N";
        }

        if (isset($_POST['parcelada'])) {
            $Parcelado = $_POST['parcelada'];
        } else {
            $Parcelado = "N";
        }

        if (!empty($_POST['ValorTotal'])) {
            $ValorTotal = FormatarFloat($_POST['ValorTotal']);
        } else {
            $ValorTotal = FormatarFloat($_POST['ValorParcela']);
        }

        if ($QtdParcela == 0) {
            $QtdParcela = 1;
        }


        try {
            $sqlInser = "INSERT INTO cr_lancamentos (idPessoa, idConta, idCategoria, id_SubCategoria, Descricao, Fixa, Parcelada, Confirmada, Tipo, Controle, QtdParcela, ValorParcela, ValorTotal, Desconto, Acrescimo, Abate, DataEmissao, DataVencimento, Alterado) VALUES (1,?,?,?,?,?,?,?,'D',?,?,?,?,0.00,0.00,0.00,?,?,?)";

            if ($ParcelaFixa === "S") {

                $VencimentoParcela = $Vencimento;

                $tempData = mesesAte2050();
                for ($i = 0; $i < $tempData; $i++) {
                    $parcela = "1 / 1";
                    $ValorParcela = $ValorTotal;
                    $insert = $conexao->prepare($sqlInser);
                    $insert->bind_param("iiissssssddsss", $IdConta, $IdCategoria, $IdSub, $Descricao, $ParcelaFixa, $Parcelado, $ParcelaConfirmada, $Controle, $parcela, $ValorParcela, $ValorTotal, $Emissao, $VencimentoParcela, $Alterado);
                    $insert->execute();
                    $VencimentoParcela = acrescentarMes($VencimentoParcela, 1);
                }
            } else {

                if ($QtdParcela === 1) {

                    $parcela = "1/1";
                    $insert = $conexao->prepare($sqlInser);
                    $insert->bind_param("iiissssssddsss", $IdConta, $IdCategoria, $IdSub, $Descricao, $ParcelaFixa, $Parcelado, $ParcelaConfirmada, $Controle, $parcela, $ValorParcela, $ValorTotal, $Emissao, $Vencimento, $Alterado);
                    $insert->execute();
                } else {

                    $VencimentoParcela = $Vencimento;
                    if ($ValorParcela == $ValorTotal) {
                        if (!is_numeric($ValorParcela)) {
                            $ValorParcela = floatval($ValorParcela);
                            $ValorTotal = $ValorParcela * $QtdParcela;
                        } else {
                            $ValorTotal = $ValorParcela * $QtdParcela;
                        }
                    }

                    for ($i = 0; $i < $QtdParcela; $i++) {

                        $tempDescricao = "";
                        $addParcela = $i + 1;
                        $parcela = $addParcela . "/" . $QtdParcela;
                        $tempDescricao = $Descricao . " " . $addParcela . "/" . $QtdParcela;
                        $insert = $conexao->prepare($sqlInser);
                        $insert->bind_param("iiissssssddsss", $IdConta, $IdCategoria, $IdSub, $tempDescricao, $ParcelaFixa, $Parcelado, $ParcelaConfirmada, $Controle, $parcela, $ValorParcela, $ValorTotal, $Emissao, $VencimentoParcela, $Alterado);
                        $insert->execute();
                        $VencimentoParcela = acrescentarDias($VencimentoParcela, 30);
                    }
                }
            }

            $retorno = array("Retorno" => "OK", "Motivo" => "Despesa Cadastrada com sucesso!");
        } catch (\Throwable $th) {
            $retorno = array("Retorno" => "ERRO", "Motivo" => $th->getMessage());
        }

        echo json_encode($retorno);
        exit;
    }
}
