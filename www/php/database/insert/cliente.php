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
        // $_POST = $_GET;
    }

    // dados
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $endereco = $_POST["endereco"];

    // validar sessão
    if (!$_SESSION['current_user']) {
        raiseInvalidSession();
    }

    // sanitização de entrada
    $required_fields = $_POST;
    $missing_fields = verificarCamposIndefinidos($required_fields);
    if (!empty($missing_fields)) {
        raiseMissingParameters($missing_fields);
    }

    if (!$telefone = sanitizarTelefone($telefone)) {
        raiseInvalidParameter('telefone');
    }

    $nome = truncate($nome, 30);
    $sobrenome = truncate($sobrenome, 30);
    $email = truncate($email, 100);
    $endereco = truncate($endereco, 100);

    // conexão
    $conn = criarConexao("../../../../database.json");

    // montar query
    $query =
        "INSERT INTO tb_cliente (nm_cliente, nm_sobrenome, nm_email, nr_telefone, nm_endereco) VALUES (?, ?, ?, ?, ?)";
    $types = "sssss";
    $params = array(
        $nome,
        $sobrenome,
        $email,
        $telefone,
        $endereco
    );

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
