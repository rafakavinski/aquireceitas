<?php

$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "aqui_receitas";

$conexao = mysqli_connect($host, $usuario, $senha, $banco);

if(!$conexao){
    die("Erro: " . mysqli_connect_error());
}