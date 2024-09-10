<?php
require_once('db_endpoint_init.php'); // conectar com o banco

$method = $_SERVER['REQUEST_METHOD'];
if ($method !== 'POST') {
    endpoint_return("Invalid request method: $method", false);
}

// salvando dados do form
$nome = $_POST["nome"];
$sobrenome = $_POST["sobrenome"];
$email = $_POST["email"];
$telefone = $_POST["telefone"];
$endereco = $_POST["endereco"];

// Inserindo dados
$insert = $conn->prepare("
    INSERT INTO tb_cliente (nm_cliente, nm_sobrenome, nm_email, nr_telefone, nm_endereco)
    VALUES (?, ?, ?, ?, ?);
");
if (!$insert) {
    $error = "Insert query failed: " . $conn->error;
    endpoint_return($error, false);
}

// Bind parameters to the prepared statement (replace 's' and 'i' with correct types)
// 's' = string, 'i' = integer, 'd' = double, 'b' = blob
$insert->bind_param(
    "sssss",
    $nome,
    $sobrenome,
    $email,
    $telefone,
    $endereco
);

if ($insert->execute()) {
    endpoint_return("Data inserted successfully", true);
} else {
    endpoint_return("Error executing query" . $insert->error, false);
}
