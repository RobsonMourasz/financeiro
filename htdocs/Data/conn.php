<?php
include_once __DIR__."/env/login";
include_once __DIR__."/funcoes.php";
$conn = new mysqli(IP, USER, PASS, DATA, PORT) or die($conexao->error) ;