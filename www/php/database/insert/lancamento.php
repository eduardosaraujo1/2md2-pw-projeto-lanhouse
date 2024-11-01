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
    $valor = $_POST["valor"];
    $tipo_lanc = $_POST["tipoLanc"];
    $data_lanc = date('Y-m-d');
    $descricao = $_POST["descricao"];
    $fk_categoria = $_POST["categoria"];
    // $fk_funcionario = null || $_POST["debug"]; // O FUNCIONARIO SERÁ OBTIDO ATRAVÉS DA SESSÃO DE LOGIN ATUAL QUANDO FOR IMPLEMENTADO.
    // $fk_funcionario = (int) $fk_funcionario; // debug

    // sanitização de entrada
    if (!isset($tipo_lanc, $fk_categoria, $valor, $fk_funcionario)) {
        raiseMissingParameters();
    }

    if (!$valor = sanitizarDecimal($valor, 8, 2)) {
        raiseInvalidParameter('valor');
    }

    if (!sanitizarInt($fk_categoria)) {
        raiseInvalidParameter("categoria", "Field must be of type 'integer'");
    }

    switch ($tipo_lanc) {
        case 'lucro':
            $tipo_lanc = 1;
            break;
        case 'despeza':
            $tipo_lanc = 0;
            break;
        default:
            raiseInvalidParameter("tipoLanc", "Field must be either 'lucro' or 'despeza'");
    }

    $descricao = sanitizarNullable($descricao);
    $descricao =  truncate($descricao, 300);

    // conexão
    $conn = criarConexao("../../../../database.json");

    // montar query
    $query =
        "INSERT INTO tb_lancamento (valor, tipo, data_lancamento, descricao, fk_id_categoria, fk_id_funcionario) VALUES (?, ?, ?, ?, ?, ?)";
    $types = "dissii";
    $params = array(
        $valor,
        $tipo_lanc,
        $data_lanc,
        $descricao,
        $fk_categoria,
        $fk_funcionario
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

// ! TODO: Finalizar mecanismo de login com session e criar uma query para lista de categorias
