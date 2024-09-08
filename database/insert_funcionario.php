<?php
require_once('conexao.php'); // conectar com o banco

$method = $_SERVER['REQUEST_METHOD'];
if ($method !== 'POST') {
    endpoint_response("Invalid request method: $method", false);
}

// salvando dados do form
$nome = $_POST['nome'];
$sobrenome = $_POST["sobrenome"];
$dt_nascimento = $_POST["dtNascimento"];
$cargo = $_POST["cargo"];
$salario = str_replace(',', '.', $_POST["salario"]);
$dtAdmissao = date('Y-m-d');
$email = $_POST["email"];
$senha = $_POST["senha"];
$table = $_POST["table"];

// Inserindo dados
$insert = $conn->prepare("
    INSERT INTO $table (nm_funcionario, nm_sobrenome, dt_nascimento, nm_cargo, nr_salario, dt_admissao, email, nm_senha)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
");
if (!$insert) {
    $error = "Insert query failed: " . $conn->error;
    endpoint_response($error, false);
}

// Bind parameters to the prepared statement (replace 's' and 'i' with correct types)
// 's' = string, 'i' = integer, 'd' = double, 'b' = blob
$insert->bind_param(
    "ssssdsss",
    $nome,
    $sobrenome,
    $dt_nascimento,
    $cargo,
    $salario,
    $dtAdmissao,
    $email,
    $senha
);

if ($insert->execute()) {
    endpoint_response("Data inserted successfully", true);
} else {
    endpoint_response("Error executing query" . $insert->error, false);
}
