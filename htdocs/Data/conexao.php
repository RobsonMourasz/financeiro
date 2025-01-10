<?php
require_once __DIR__."/env/config";
include_once("funcoes.php");

$conexao = new mysqli(IP, USER, PASS, DATA, PORT) or die($conexao->error) ;