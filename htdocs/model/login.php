<?php 
    if(isset($_POST['email']) && isset($_POST['senha'])){
        if(!empty($_POST['email']) && !empty($_POST['senha'])){
            
            if (!isset($_SESSION)){
                session_start();
            }

            $_SESSION['usuario'] = "Robson Moura";
            $_SESSION['nivel'] = "Administrador";
            $_SESSION['sessao'] = "ativa";

            header("location: ../index.php");
        }else{
            header("location: ../../index.html");
        }
    }else{
        header("location: ../../index.html");
    }