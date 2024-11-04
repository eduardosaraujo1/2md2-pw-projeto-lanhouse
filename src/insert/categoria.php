<?php
require '../header.php';
require '../../utilities/generic.php';
require '../connection.php';

$response = array('status' => 'undefined', 'content' => '');

try {
    // Iniciar sessão (para obter usuário atual)
    session_start();

    // validar tipo de request
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        raiseInvalidRequestMethod();
    }

    // dados
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    // validar sessão
    if (!$_SESSION['current_user']) {
        raiseInvalidSession();
    }

    // validação de entrada
    $required_fields = $_POST;
    unset($required_fields['descricao']);
    $missing_fields = verificarCamposIndefinidos($required_fields);
    if (!empty($missing_fields)) {
        raiseMissingParameters($missing_fields);
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

    // fechar conexão
    $conn->close();

    // montar resposta
    $response['status'] = "success";
    $response['content'] = "Successful Insert";
} catch (Throwable $err) {
    $response['status'] = 'error';
    $response['content'] = $err->getMessage();
}

echo json_encode($response);
