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
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $endereco = $_POST["endereco"];

    // sanitização de entrada
    if (!isset($nome, $sobrenome, $email, $telefone, $endereco)) {
        raiseMissingParameters();
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

    // montar resposta
    $response['status'] = "success";
    $response['content'] = "Successful Insert";
} catch (Throwable $err) {
    $response['status'] = 'error';
    $response['content'] = $err->getMessage();
}

echo json_encode($response);