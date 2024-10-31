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
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $endereco = $_POST["endereco"];

    // sanitização de entrada
    $telefone = preg_replace("/\D/", '', $telefone);
    if (!isset($nome, $sobrenome, $email, $telefone, $endereco)) {
        throw new Exception("Missing required parameter - received '" .  arrayParaString($_POST) . "'");
    }

    if (!validarTelefone($telefone)) {
        throw new Exception("Invalid Parameter - $telefone is not a valid phone number");
    }

    $nome = truncate($nome, 30);
    $sobrenome = truncate($sobrenome, 30);
    $email = truncate($email, 100);
    $telefone = truncate(preg_replace("/\D/", '', $telefone), 11);
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

// // salvando dados do form
// $nome = $_POST["nome"];
// $sobrenome = $_POST["sobrenome"];
// $email = $_POST["email"];
// $telefone = $_POST["telefone"];
// $endereco = $_POST["endereco"];

// // Tratando dados
// $nome = mb_substr($nome, 0, 30);
// $sobrenome = mb_substr($sobrenome, 0, 30);
// $email = mb_substr($email, 0, 100);
// $telefone = mb_substr($telefone, 0, 11);
// $endereco = mb_substr($endereco, 0, 100);

// $insert->bind_param(
//     "sssss",
//     $nome,
//     $sobrenome,
//     $email,
//     $telefone,
//     $endereco
// );
// safe_insert_execute($insert, $conn);
// endpoint_return("Insert success", true);
