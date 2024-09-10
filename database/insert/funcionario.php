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
function validateDate($date)
{
    $format = 'Y-m-d'; // yyyy-mm-dd format
    $d = DateTime::createFromFormat($format, $date);
    // Check if the date matches the format and is a valid calendar date
    return $d && $d->format($format) === $date;
}
$nome = mb_substr($nome, 0, 30);
$sobrenome = mb_substr($sobrenome, 0, 30);
$dt_nascimento = validateDate($dt_nascimento) ? $dt_nascimento : '1970-01-01';
$cargo = mb_substr($cargo, 0, 30);
$salario = str_replace(',', '.', $salario);
$dtAdmissao = validateDate($dtAdmissao) ? $dtAdmissao : '1970-01-01';
$email = mb_substr($email, 0, 100);

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
