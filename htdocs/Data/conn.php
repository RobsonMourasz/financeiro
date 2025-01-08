<?php
require_once __DIR__."/env/login";

$conn = new mysqli(IP, USER, PASS, DATA, PORT) or die($conexao->error) ;