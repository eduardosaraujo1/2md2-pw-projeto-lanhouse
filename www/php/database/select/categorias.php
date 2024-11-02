<?php
require '../header.php';
require '../connection.php';

$response = array();
try {
    // conexão
    $conn = criarConexao("../../../../database.json");

    // montar query
    $query = "SELECT id_categoria 'id', nome FROM tb_categoria";

    // executar query
    $result = executarQuery($conn, $query);

    // fechar conexão
    $conn->close();

    // montar resposta
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $nome = $row['nome'];
        $response[$id] = $nome;
    }
} catch (Throwable) {
    $response = array();
}

if (__FILE__ === $_SERVER['SCRIPT_FILENAME']) {
    echo json_encode($response);
}
