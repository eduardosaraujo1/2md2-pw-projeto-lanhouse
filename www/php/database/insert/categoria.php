<?php
require '../header.php';
require '../utilities.php';
require '../connection.php';

$response = array('status' => 'success', 'content' => '');

try {
    // validar tipo de request
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        throw new Exception("Invalid request method - Expected 'POST' received '" . $_SERVER["REQUEST_METHOD"] . "'");
    }

    // dados
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    // validação de entrada
    if (!isset($nome)) {
        throw new Exception("Missing required parameter - received '" .  assocArrayStringify($_POST) . "'");
    } else {
        $nome = truncate($nome, 50);
    }

    if (empty($descricao)) {
        $descricao = null;
    } else {
        $descricao = truncate($descricao, 120);
    }

    // conexão
    $conn = criarConexao("../../../../database.json");

    // montar query
    $query = 'INSERT INTO tb_categoria (nome, descricao) VALUES (?, ?)';
    $types = "ss";
    $params = array($nome, $descricao);

    // executar query
    executarQuery($conn, $query, $types, $params);


    // montar resposta
    $response['content'] = "Successful Insert";
} catch (Throwable $err) {
    $response['status'] = 'error';
    $response['content'] = $err->getMessage();
}

echo json_encode($response);
