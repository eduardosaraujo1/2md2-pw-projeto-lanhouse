<?php
require '_insert.php';

// salvando dados do form
$nome = $_POST['nome'];
$sobrenome = $_POST["sobrenome"];
$dt_nascimento = $_POST["dtNascimento"];
$cargo = $_POST["cargo"];
$salario = $_POST["salario"];
$dtAdmissao = date('Y-m-d');
$email = $_POST["email"];
$senha = $_POST["senha"];

// Tratando dados
$salario = str_replace(',', '.', $salario);

// Inserindo dados
$insert = safe_insert_prepare("
    INSERT INTO tb_funcionario (nm_funcionario, nm_sobrenome, dt_nascimento, nm_cargo, nr_salario, dt_admissao, email, nm_senha)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?);
    ", $conn);

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

safe_insert_execute($insert, $conn);
endpoint_return("Insert success", true);
