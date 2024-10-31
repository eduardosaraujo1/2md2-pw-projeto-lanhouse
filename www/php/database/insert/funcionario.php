<?php
require '../header.php';
require '../connection.php';

$response = array('status' => 'success', 'content' => '');

try {
    // validar tipo de request
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        throw new Exception("Invalid request method - Expected 'POST' received '" . $_SERVER["REQUEST_METHOD"] . "'");
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
        throw new Exception("Missing required parameter");
    }

    if (!validarData($dt_nascimento)) {
        throw new Exception("Invalid Parameter - dt_nascimento is not in a valid format");
    }

    if (!validarDecimal($salario)) {
        throw new Exception("Invalid Parameter - salario is not a valid decimal");
    }

    $nome = truncate($nome, 30);
    $sobrenome = truncate($sobrenome, 30);
    $cargo = truncate($cargo, 30);
    $salario = sqlDecimalConstraint((float) $salario, 7, 2);
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
    $result = executarQuery($conn, $query, $types, $params);
    if (!$result) {
        throw new Exception("Query error - " . $conn->error);
    }

    // montar resposta
    $response['content'] = "Successful Insert";
} catch (Throwable $err) {
    $response['status'] = 'error';
    $response['content'] = $err->getMessage();
}

echo json_encode($response);
