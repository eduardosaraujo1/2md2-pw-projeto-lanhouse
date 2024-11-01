<?php
require '../header.php';
require '../utilities.php';
require '../connection.php';

try {
    // validar tipo de request
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        raiseInvalidRequestMethod();
        // $_POST = $_GET;
    }

    // dados
    $nome = $_POST['nome'];
    $sobrenome = $_POST["sobrenome"];
    $dt_nascimento = $_POST["dt_nascimento"];
    $cargo = $_POST["cargo"];
    $salario = $_POST["salario"];
    $dt_admissao = date('Y-m-d');
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // validação de entrada
    if (!isset($nome, $sobrenome, $dt_nascimento, $cargo, $salario, $email, $senha)) {
        raiseMissingParameters();
    }
    if (!$dt_nascimento = sanitizarData($dt_nascimento)) {
        raiseInvalidParameter('dt_nascimento', 'Hint: format yyyy-mm-dd');
    }
    if (!$salario = sanitizarDecimal($salario, 7, 2)) {
        raiseInvalidParameter('salario');
    }

    $nome = truncate($nome, 30);
    $sobrenome = truncate($sobrenome, 30);
    $cargo = truncate($cargo, 30);
    $email = truncate($email, 100);
    $senha = password_hash($senha, PASSWORD_BCRYPT, array("cost" => 14));

    // conexão
    $conn = criarConexao("../../../../database.json");

    // montar query
    $query =
        "INSERT INTO tb_funcionario (nm_funcionario, nm_sobrenome, dt_nascimento, nm_cargo, nr_salario, dt_admissao, email, nm_senha) VALUES (?, ?, ?, ?, ?, ?, ?, ?) ";
    $types = "ssssdsss";
    $params = array(
        $nome,
        $sobrenome,
        $dt_nascimento,
        $cargo,
        $salario,
        $dt_admissao,
        $email,
        $senha
    );

    // executar query
    executarQuery($conn, $query, $types, $params);

    // montar resposta
    $response['status'] = "success";
    $response['content'] = "Successful Insert";
} catch (Throwable $err) {
    $response['status'] = 'error';
    $response['content'] = $err->getMessage();
}

echo json_encode($response);
