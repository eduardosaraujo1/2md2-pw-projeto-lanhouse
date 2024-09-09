<?php
require_once('conexao.php'); // conectar com o banco

$method = $_SERVER['REQUEST_METHOD'];
if ($method !== 'POST') {
    endpoint_response("Invalid request method: $method", false);
}

// salvando dados do form
$nome = $_POST['nome'];
$descricao = $_POST["descricao"];

// Inserindo dados
$insert = $conn->prepare("
    INSERT INTO tb_categoria (nome, descricao)
    VALUES (?, ?);
");
if (!$insert) {
    $error = "Insert query failed: " . $conn->error;
    endpoint_response($error, false);
}

// Bind parameters to the prepared statement (replace 's' and 'i' with correct types)
// 's' = string, 'i' = integer, 'd' = double, 'b' = blob
$insert->bind_param(
    "ss",
    $nome,
    $descricao,
);

if ($insert->execute()) {
    endpoint_response("Data inserted successfully", true);
} else {
    endpoint_response("Error executing query" . $insert->error, false);
}
