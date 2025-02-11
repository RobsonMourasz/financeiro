<?php
@include_once __DIR__ . "/../../Data/conn.php";
@include_once __DIR__ . "/../../Data/conexao.php";

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['email'])) {
    $email = strtolower($_POST['email']);
    $senha = $_POST['senha'];
    if ($email !== "") {

        $verificaBD = $conn->query("SELECT * FROM cadlogin a WHERE a.Email = '$email'");
        if ($verificaBD->num_rows > 0) {
            $verificaBD = $verificaBD->fetch_assoc();
            $tempCNPJ = limpar_texto($verificaBD['Cpf_Cnpj']);
            $database = USER . $tempCNPJ;
            $_SESSION["cpf_cnpj"] = $tempCNPJ;
            $conexao->select_db($database);
            $verificaLogin = $conexao->prepare("SELECT * FROM caduser a WHERE a.EmailUser = ?");
            $verificaLogin->bind_param("s", $email);
            $verificaLogin->execute();

            if ($verificaLogin->fetch()) {
                $verificaLogin->close();
                $tempSenha = $conexao->query("SELECT SenhaUser FROM caduser WHERE EmailUser = '$email' AND Ativo = 0");
                $tempSenha = $tempSenha->fetch_assoc();

                if (password_verify($senha, $tempSenha['SenhaUser'])) {
                    $Usuario = $conexao->query("SELECT * FROM caduser WHERE EmailUser = '$email'");
                    $Usuario = $Usuario->fetch_assoc();
                    $_SESSION['usuario'] = $Usuario["NomeUser"];
                    $_SESSION['nivel'] = $Usuario["Nivel"];
                    $_SESSION['sessao'] = "ativa";
                    header("location: ../../index.php");
                } else { ?>

                    <script>
                        let respostaPass = alert("Senha incorreta!")
                        if (respostaPass == true) {
                            console.log("verdadeiro")
                        } else {
                            location.assign("../../../index.html");
                        }
                    </script>
            <?php
                }
            } else {
                die("asdas");
                header("location: ../../../index.html");
            }
        } else {
            ?>
            <script>
                let respostaUser = alert("Usuário não encontrado!")
                if (respostaUser == true) {
                    console.log("verdadeiro")
                } else {
                    location.assign("../../../index.html");
                }
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            let respostaUser1 = alert("Usuário não encontrado!")
            if (respostaUser1 == true) {
                console.log("verdadeiro")
            } else {
                location.assign("../../../index.html");
            }
        </script>
<?php
    }
}
