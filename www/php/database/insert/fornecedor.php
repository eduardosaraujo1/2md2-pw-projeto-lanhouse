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
    $contato = $_POST['contato'];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $endereco = $_POST["endereco"];

    // validação de entrada
    if (!isset($nome, $contato, $email, $telefone, $endereco)) {
        throw new Exception("Missing required parameter - received '" .  assocArrayStringify($_POST) . "'");
    }


    $nome = truncate($nome, 50);
    $contato = truncate($contato, 30);
    $email = truncate($email, 50);
    $telefone = formatarTelefone($telefone);
    $endereco = truncate($endereco, 100);

    if (!validarTelefone($telefone)) {
        throw new Exception("Invalid Parameter - $telefone is not a valid phone number");
    }

    // conexão
    $conn = criarConexao("../../../../database.json");

    // montar query
    $query =
        "INSERT INTO tb_fornecedor (nm_fornecedor, nm_contato, nm_email, nr_telefone, nm_endereco) VALUES (?, ?, ?, ?, ?) ";
    $types = "sssss";
    $params = array(
        $nome,
        $contato,
        $email,
        $telefone,
        $endereco
    );

    // executar query
    executarQuery($conn, $query, $types, $params);

    // montar resposta
    $response['content'] = "Successful Insert";
} catch (Throwable $err) {
    $response['status'] = 'error';
    $response['content'] = $err->getMessage();
}

echo json_encode($response);
