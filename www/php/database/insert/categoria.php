<?php
require '../header.php';
require '../utilities.php';
require '../connection.php';

try {
    // validar tipo de request
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        raiseInvalidRequestMethod();
    }

    // dados
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    // validação de entrada
    if (!isset($nome)) {
        raiseMissingParameters();
    }

    $nome = truncate($nome, 50);
    $descricao = sanitizarNullable($descricao);
    $descricao = truncate($descricao, 120);

    // conexão
    $conn = criarConexao("../../../../database.json");

    // montar query
    $query = 'INSERT INTO tb_categoria (nome, descricao) VALUES (?, ?)';
    $types = "ss";
    $params = array($nome, $descricao);

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
