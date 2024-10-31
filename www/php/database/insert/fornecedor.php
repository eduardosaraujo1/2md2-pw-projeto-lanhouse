<?php
require '../header.php';
require '../utilities.php';
require '../connection.php';

$response = array('status' => 'success', 'content' => '');

try {
    // validar tipo de request
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        //TEMPORARIO para debug
        // throw new Exception("Invalid request method - Expected 'POST' received '" . $_SERVER["REQUEST_METHOD"] . "'");
        $_POST = $_GET;
    }

    // dados
    $nome = $_POST['nome'];
    $contato = $_POST['contato'];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $endereco = $_POST["endereco"];

    // validação de entrada
    if (!isset($nome, $contato, $email, $telefone, $endereco)) {
        throw new Exception("Missing required parameter - received '" .  arrayParaString($_POST) . "'");
    }

    if (!validarTelefone($telefone)) {
        throw new Exception("Invalid Parameter - $telefone is not a valid phone number");
    }

    $nome = truncate($nome, 50);
    $contato = truncate($contato, 30);
    $email = truncate($email, 50);
    $telefone = truncate(preg_replace("/\D/", '', $telefone), 11);
    $endereco = truncate($endereco, 100);

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
