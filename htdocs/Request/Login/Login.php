<?php
@include_once __DIR__ . "/../../Data/conn.php";
@include_once __DIR__ . "/../../Data/conexao.php";

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['email'])) {
    $email = strtolower($_POST['email']);
    $senha = $_POST['senha'];
    if($email !== ""){

        $verificaBD = $conn->query("SELECT * FROM cadlogin a WHERE a.Email = '$email'");
        if ($verificaBD->num_rows > 0) {

            $verificaBD = $verificaBD->fetch_assoc();
            $database = "f_".$verificaBD['Cpf_Cnpj'];
            $_SESSION["cpf_cnpj"] = $verificaBD['Cpf_Cnpj'] ;
            $conexao->select_db($database);
            $verificaLogin = $conexao->prepare("SELECT * FROM caduser a WHERE a.EmailUser = ?");
            $verificaLogin->bind_param("s", $email);
            $verificaLogin->execute();
            if ($verificaLogin->num_rows > 0) {
                $verificaLogin->close();
                $tempSenha = $conexao->query("SELECT SenhaUser FROM caduser WHERE EmailUser = '$email'");
                $tempSenha = $tempSenha->fetch_assoc();
                
                if(password_verify($senha, $tempSenha['SenhaUser'])){
                    $_SESSION['usuario'] = "Robson Moura";
                    $_SESSION['nivel'] = "Administrador";
                    $_SESSION['sessao'] = "ativa";
                    header("location: ../index.php");
                }else{
                    die("senha nao deu certo ");
                    header("location: ../../../index.html");
                }

            }else{
                echo $email ;
                echo"<br>";
                var_dump($verificaLogin);
                echo"<br>";
                echo $verificaLogin->num_rows ;
                echo"<br>";
                echo "menor que 0";
            }

        } else {
            header("location: ../../../index.html");
        }
    }

}
