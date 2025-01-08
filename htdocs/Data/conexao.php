<?php
require_once __DIR__."/env/config";

$conexao = new mysqli(IP, USER, PASS, DATA, PORT) or die($conexao->error) ;