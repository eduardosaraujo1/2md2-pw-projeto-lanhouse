<?php
require '_insert.php';

// salvando dados do form
$nome = $_POST['nome'];
$descricao = $_POST["descricao"];

// Filtrando dados
$nome = mb_substr($nome, 0, 50);
if (empty($descricao)) {
    $descricao = null;
} else {
    $descricao = mb_substr($descricao, 0, 120);
}

// Inserindo dados
// $insert = $conn->prepare($query);
$insert = safe_insert_prepare("
    INSERT INTO tb_categoria (nome, descricao)
    VALUES (?, ?);
", $conn);

// 's' = string, 'i' = integer, 'd' = double, 'b' = blob
$insert->bind_param(
    "ss",
    $nome,
    $descricao,
);
$success = safe_insert_execute($insert, $conn);

endpoint_return("Insert success", true);
