<?php

@include_once __DIR__ . "/../../Data/conn.php";
@include_once __DIR__."/env/config";
if (isset($_POST["NomeEmpresa"])) {

    $tempCNPJ = limpar_texto($_POST["cpf_cnpj"]);
    $database = USER . $tempCNPJ;
    $Empresa = $_POST["NomeEmpresa"];
    $Email = $_POST["email"];
    $Senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);
    $CPF_CNPJ = $_POST["cpf_cnpj"];
    if (!isset($_SESSION)) {
        session_start();
    }
    $_SESSION["cpf_cnpj"] = $CPF_CNPJ;

    try {

        $VerificarCadastro = $conn->query("SELECT COUNT(a.Email) AS 'UserCadastrado' FROM cadlogin a WHERE a.Email = '$Email'");
        $VerificarCadastro = $VerificarCadastro->fetch_assoc();

    } catch (\Throwable $th) {
        die("Erro ao VerificarCadastro  ". $th->getMessage());
    }

    if ($VerificarCadastro['UserCadastrado'] < 1) {
        try {
            $consulta = $conn->query("SELECT COUNT(*) AS BancoExiste
            FROM information_schema.SCHEMATA
            WHERE SCHEMA_NAME = '$database'");
        } catch (\Throwable $th) {
            echo "Consulta VerificarCadastro: ". $th->getMessage();
        }

        $consulta = $consulta->fetch_assoc();
        if ($consulta["BancoExiste"] == 0) {;
            try {

                try {
                    $sqlCreateBanco = "CREATE DATABASE IF NOT EXISTS $database";
                    $DatabeDados = USER . "_dados";
                } catch (\Throwable $th) {
                    die("ERRO sqlCreateBanco: " . $th->getMessage());
                }

                $conn->select_db($DatabeDados);
                if ($conn->query($sqlCreateBanco)) {
                    echo "<h1>banco criado com sucesso</h1>";
                    @include_once __DIR__ . "/../../Data/conexao.php";
                    echo "<br>";
                    echo "<br>";
                    echo "<br>";


                    $sqlCreateTabelaCategoria = "CREATE TABLE `cadcategoria` (
                    `idCat` int(11) NOT NULL AUTO_INCREMENT,
                    `DescricaoCat` varchar(20) DEFAULT NULL,
                    `Tipo` varchar(2) NOT NULL,
                    PRIMARY KEY (`idCat`),
                    UNIQUE KEY `idCat` (`idCat`),
                    KEY `idCat2` (`idCat`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8";

                    $sqlCreateTabelaEmpresa = "CREATE TABLE IF NOT EXISTS `cadempresa` (
                    `idEmpresa` int(11) NOT NULL AUTO_INCREMENT,
                    `ativo` int(2) NOT NULL DEFAULT '0',
                    `NomeEmpresa` varchar(50) NOT NULL DEFAULT '0',
                    `Cpf_Cnpj` varchar(50) NOT NULL DEFAULT '0',
                    `Telefone` varchar(50) NOT NULL DEFAULT '0',
                    `Endereco` varchar(50) NOT NULL DEFAULT '0',
                    `bloqueio` varchar(255) NOT NULL DEFAULT '0',
                    PRIMARY KEY (`idEmpresa`),
                    UNIQUE KEY `id` (`idEmpresa`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

                    $sqlCreateTabelaPessoa = "CREATE TABLE IF NOT EXISTS `cadpessoas` (
                    `idPessoa` int(11) NOT NULL AUTO_INCREMENT,
                    `NomePessoa` varchar(100) NOT NULL,
                    `EnderecoPessoa` varchar(500) NOT NULL,
                    `Cpf_Cnpj` varchar(15) DEFAULT NULL,
                    `Email` varchar(100) DEFAULT NULL,
                    `Telefone` varchar(20) DEFAULT NULL,
                    PRIMARY KEY (`idPessoa`),
                    UNIQUE KEY `idPessoa` (`idPessoa`),
                    KEY `idPessoa1` (`idPessoa`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

                    $sqlCreateTabelaUsuario = "CREATE TABLE IF NOT EXISTS `caduser` (
                    `idUser` int(11) NOT NULL AUTO_INCREMENT,
                    `Ativo` int(2) NOT NULL DEFAULT 0,
                    `NomeUser` varchar(50) NOT NULL,
                    `EmailUser` varchar(50) NOT NULL,
                    `SenhaUser` varchar(255) NOT NULL,
                    `cpf_cnpj` varchar(50) NOT NULL DEFAULT '00000000000',
                    `Nivel` varchar(50) NOT NULL DEFAULT 'Usuario',
                    PRIMARY KEY (`idUser`),
                    UNIQUE KEY `idUser` (`idUser`),
                    KEY `idUser2` (`idUser`)
                    ) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;";

                    $sqlCreateTabelasubcategoria = "CREATE TABLE IF NOT EXISTS `catsubcategoria` (
                    `idSub` int(11) NOT NULL AUTO_INCREMENT,
                    `idCat` int(11) DEFAULT '0',
                    `DescricaoSub` int(11) NOT NULL,
                    PRIMARY KEY (`idSub`),
                    UNIQUE KEY `idSub` (`idSub`),
                    KEY `idSub2` (`idSub`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

                    $sqlCreateTabelaCP = "CREATE TABLE IF NOT EXISTS `cp_lancamentos` (
                    `idCR` int(11) NOT NULL AUTO_INCREMENT,
                    `idPessoa` int(11) NOT NULL DEFAULT '0',
                    `idConta` int(11) NOT NULL DEFAULT '0',
                    `idCategoria` int(11) NOT NULL DEFAULT '0',
                    `id_SubCategoria` int(11) NOT NULL DEFAULT '0',
                    `Descricao` varchar(50) NOT NULL,
                    `Fixa` varchar(2) DEFAULT 'N' COMMENT 'S  SIM N NAO',
                    `Parcelada` varchar(2) DEFAULT 'N' COMMENT 'S  SIM N NAO',
                    `Confirmada` varchar(2) DEFAULT 'N' COMMENT 'S  SIM N NAO',
                    `Tipo` varchar(2) DEFAULT 'D' COMMENT 'R RECEITA D DESPESA',
                    `Controle` varchar(20) DEFAULT 'NAO' COMMENT 'NUMERO QUE IRÁ AGRUPAR TODAS AS PARCELAS ',
                    `QtdParcela` varchar(10) DEFAULT '1/1',
                    `ValorParcela` double(14,2) DEFAULT '0.00',
                    `ValorTotal` double(14,2) DEFAULT '0.00',
                    `Desconto` double(14,2) DEFAULT '0.00',
                    `Acrescimo` double(14,2) DEFAULT '0.00',
                    `Abate` double(14,2) DEFAULT '0.00',
                    `DataEmissao` datetime DEFAULT NULL,
                    `DataVencimento` datetime DEFAULT NULL,
                    `Alterado` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                    PRIMARY KEY (`idCR`) USING BTREE,
                    UNIQUE KEY `idCR` (`idCR`) USING BTREE,
                    KEY `idCR1` (`idCR`) USING BTREE
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;";

                    $sqlCreateTabelaCR = "CREATE TABLE IF NOT EXISTS `cr_lancamentos` (
                    `idCR` int(11) NOT NULL AUTO_INCREMENT,
                    `idPessoa` int(11) NOT NULL DEFAULT '0',
                    `idConta` int(11) NOT NULL DEFAULT '0',
                    `idCategoria` int(11) NOT NULL DEFAULT '0',
                    `id_SubCategoria` int(11) NOT NULL DEFAULT '0',
                    `Descricao` varchar(50) NOT NULL,
                    `Fixa` varchar(2) DEFAULT 'N' COMMENT 'S  SIM N NAO',
                    `Parcelada` varchar(2) DEFAULT 'N' COMMENT 'S  SIM N NAO',
                    `Confirmada` varchar(2) DEFAULT 'N' COMMENT 'S  SIM N NAO',
                    `Tipo` varchar(2) DEFAULT 'D' COMMENT 'R RECEITA D DESPESA',
                    `Controle` varchar(20) DEFAULT 'NAO' COMMENT 'NUMERO QUE IRÁ AGRUPAR TODAS AS PARCELAS ',
                    `ValorParcela` double(14,2) DEFAULT '0.00',
                    `ValorTotal` double(14,2) DEFAULT '0.00',
                    `Desconto` double(14,2) DEFAULT '0.00',
                    `Acrescimo` double(14,2) DEFAULT '0.00',
                    `Abate` double(14,2) DEFAULT '0.00',
                    `DataEmissao` datetime DEFAULT NULL,
                    `DataVencimento` datetime DEFAULT NULL,
                    `Alterado` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                    PRIMARY KEY (`idCR`),
                    UNIQUE KEY `idCR` (`idCR`),
                    KEY `idCR1` (`idCR`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

                    $sqlCreateTabelaSaldo = "CREATE TABLE IF NOT EXISTS `saldo_historico` (
                    `idHistorico` int(11) NOT NULL AUTO_INCREMENT,
                    `idConta` int(11) DEFAULT '0',
                    `DataMovimentacao` datetime DEFAULT NULL,
                    `Alterado` timestamp NULL DEFAULT NULL,
                    PRIMARY KEY (`idHistorico`),
                    UNIQUE KEY `idHistorico` (`idHistorico`),
                    KEY `idHistorico2` (`idHistorico`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
                    ";

                    $sqlCreateTabelaCadConta = "CREATE TABLE IF NOT EXISTS `cadconta` (
                    `IdConta` int(11) NOT NULL AUTO_INCREMENT,
                    `DescricaoConta` varchar(50) DEFAULT NULL,
                    `SaldoConta` double(14,2) NOT NULL DEFAULT 0.00,
                    PRIMARY KEY (`IdConta`) USING BTREE,
                    UNIQUE KEY `idConta` (`IdConta`) USING BTREE,
                    KEY `idConta2` (`IdConta`) USING BTREE
                    ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;";

                    
                    $sqlInsertLogin = "INSERT INTO cadlogin (Empresa, Cpf_Cnpj, Email, Ativo) VALUES ('$Empresa', '$CPF_CNPJ', '$Email', 0)";
                    $sqlInsertLoginBD = "INSERT INTO caduser (NomeUser, EmailUser, SenhaUser, cpf_cnpj, Ativo) VALUES ('$Empresa', '$Email', '$Senha' , '$CPF_CNPJ', 0)";
                    
                    try {
                        $conexao->select_db($database);
                        if ($conexao->query($sqlCreateTabelaCategoria)) {
                            echo "Tabela Categoria criada";
                            echo "<br>";
                        }
    
                        if ($conexao->query($sqlCreateTabelaEmpresa)) {
                            echo "Tabela Empresa criada";
                            echo "<br>";
                        }
    
                        if ($conexao->query($sqlCreateTabelaPessoa)) {
                            echo "Tabela Pessoa criada";
                            echo "<br>";
                        }
    
                        if ($conexao->query($sqlCreateTabelaUsuario)) {
                            echo "Tabela Usuario criada";
                            echo "<br>";
                        }
    
                        if ($conexao->query($sqlCreateTabelasubcategoria)) {
                            echo "Tabela sub categoria criada";
                            echo "<br>";
                        }
    
                        if ($conexao->query($sqlCreateTabelaCP)) {
                            echo "Tabela contas a pagar criada";
                            echo "<br>";
                        }
    
                        if ($conexao->query($sqlCreateTabelaCR)) {
                            echo "Tabela contas a receber criada";
                            echo "<br>";
                        }
    
                        if ($conexao->query($sqlCreateTabelaSaldo)) {
                            echo "Tabela Saldo criada";
                            echo "<br>";
                        }
    
                        if ($conexao->query($sqlCreateTabelaCadConta)) {
                            echo "Tabela Conta criada";
                            echo "<br>";
                        }
    
                        if ($conn->query($sqlInsertLogin)) {
                            echo "Usuario e Senha Criados";
                            echo "<br>";
                        }
    
                        if ($conexao->query($sqlInsertLoginBD)) {
                            echo "Usuario e Senha Criados no BD";
                            echo "<br>";
                        }
                    } catch (\Throwable $th) {
                        die("ERRO AO USAR O CONEXAO: " . $th->getMessage());
                    }

                    header('Refresh:2 url="../../model/logoff.php"');
                } else { /* CREAT BANCO  */
                    echo "erro";
                }
            } catch (\Throwable $th) {
                //header("location: ../../model/logoff.php");
                die("ERRO TRY: " . $th->getMessage());
            }
        } else { /* SE EXISTE BANCO */
?>
            <script>
                let RespCNPJ = alert("Já existe um cadastro com algum desses dados")
                if (RespCNPJ == true) {
                    console.log("Já existe um cadastro com algum desses dados")
                } else {
                    location.assign("../../model/logoff.php");
                }
            </script>
        <?php
            die("Cadastro já existe!");
        }
    } else {
        ?>
        <script>
            let RespUser = alert("Existe já alguem com esse e-mail")
            if (RespUser == true) {
                console.log("Existe já alguem com esse e-mail")
            } else {
                location.assign("../../model/logoff.php");
            }
        </script>
    <?php
    }
} else {
    ?>
    <script>
        let RespErro = alert("FATAL ERROR")
        if (RespErro == true) {
            console.log("Sessao não encontrada")
        } else {
            location.assign("../../model/logoff.php");
        }
    </script>
<?php
}
