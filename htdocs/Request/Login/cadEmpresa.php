<?php
include_once __DIR__ . "/../../Data/conexao.php";
if (isset($_POST["NomeEmpresa"])) {

    $database = "f_" . $_POST["cpf_cnpj"];

    $consulta = $conexao->query("SELECT COUNT(*) AS BancoExiste
        FROM information_schema.SCHEMATA
        WHERE SCHEMA_NAME = '$database'");
    
    $consulta = $consulta->fetch_assoc();
    if ($consulta["BancoExiste"] == 0) {;
        try {

            $sqlCreateBanco ="CREATE DATABASE IF NOT EXISTS `$database` /*!40100 DEFAULT CHARACTER SET utf8 */ "; 

            $sqlCreateEstrutura = "CREATE TABLE IF NOT EXISTS `cadcategoria` (
                `idCat` int(11) NOT NULL AUTO_INCREMENT,
                `DescricaoCat` varchar(20) DEFAULT NULL,
                `Tipo` varchar(2) NOT NULL COMMENT 'R 'RECEITA' D 'DESPESA'',
                PRIMARY KEY (`idCat`),
                UNIQUE KEY `idCat` (`idCat`),
                KEY `idCat2` (`idCat`)
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8";


            if($conexao->query($sqlCreateBanco)){
                echo"banco criado com sucesso";

                echo"banco criado com sucesso";
                if($conexao->query($sqlCreateEstrutura)){
                    echo"dados criado";
                }

            }else{
                echo"erro";
            }

        } catch (\Throwable $th) {
            die($th->getMessage());
            header("location: ../../model/logoff.php");
        }

    } else {
        die("erro na consulta");
    }
} else {
    die("acesso negado!");
}
