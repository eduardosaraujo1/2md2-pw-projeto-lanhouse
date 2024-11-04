<?php
require __DIR__ . '/../response.php';
require __DIR__ . '/../modules/autoload.php';

function getCategorias()
{
    $response = array();

    // conexão
    $conn = criarConexao("../../config/database.json");

    // montar query
    $query = "SELECT id_categoria 'id', nome FROM tb_categoria";

    // executar query
    $result = executarQuery($conn, $query);

    // fechar conexão
    $conn->close();

    // montar resposta
    while ($row = $result->fetch_assoc()) {
        $response[] = [
            'id' => $row['id'],
            'nome' => $row['nome']
        ];
    }

    return $response;
}

if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    echo json_encode(setupResponse('getCategorias'));
}
