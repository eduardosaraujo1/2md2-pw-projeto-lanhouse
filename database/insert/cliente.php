<?php
require '_insert.php';

// salvando dados do form
$nome = $_POST["nome"];
$sobrenome = $_POST["sobrenome"];
$email = $_POST["email"];
$telefone = $_POST["telefone"];
$endereco = $_POST["endereco"];

// Tratando dados
$nome = mb_substr($nome, 0, 30);
$sobrenome = mb_substr($sobrenome, 0, 30);
$email = mb_substr($email, 0, 100);
$telefone = mb_substr($telefone, 0, 11);
$endereco = mb_substr($endereco, 0, 100);

// Inserindo dados
$insert = safe_insert_prepare("
    INSERT INTO tb_cliente (nm_cliente, nm_sobrenome, nm_email, nr_telefone, nm_endereco)
    VALUES (?, ?, ?, ?, ?);
", $conn);

// 's' = string, 'i' = integer, 'd' = double, 'b' = blob
$insert->bind_param(
    "sssss",
    $nome,
    $sobrenome,
    $email,
    $telefone,
    $endereco
);
safe_insert_execute($insert, $conn);
endpoint_return("Insert success", true);
