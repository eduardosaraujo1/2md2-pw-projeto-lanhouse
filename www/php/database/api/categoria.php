<?php
require '../header.php';
require '../connection.php';

$result = array('status' => 'success', 'content' => '');

try {
    // dados
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    // validação
    if (!isset($nome)) {
        throw new Exception("Missing required parameter - \$nome");
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

    // query
    $query = 'INSERT INTO tb_categoria (nome, descricao) VALUES (?, ?)';
    $types = "ss";
    $params = array($nome, $descricao);

    // executar
    $query_result = executarQuery($conn, $query, $types, $params);
    if (!$query_result) {
        throw new Exception("Query error - " . $conn->error);
    }
    $result['content'] = $query_result;
} catch (Throwable $err) {
    $result['status'] = 'error';
    $result['content'] = $err->getMessage();
}

echo json_encode($result);
