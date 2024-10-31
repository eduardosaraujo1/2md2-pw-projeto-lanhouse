<?php
require '../header.php';
require '../utilities.php';
require '../connection.php';

$response = array('status' => 'success', 'content' => '');

try {
    // validar tipo de request
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        throw new Exception("Invalid request method - Expected 'POST' received '" . $_SERVER["REQUEST_METHOD"] . "'");
        // $_POST = $_GET;
    }

    // dados
    $valor = $_POST["valor"];
    $tipo_lanc = $_POST["tipoLanc"];
    $data_lanc = date('Y-m-d');
    $descricao = $_POST["descricao"];
    $categoria = $_POST["categoria"];
    // $funcionario = null || $_POST["debug"]; // O FUNCIONARIO SERÁ OBTIDO ATRAVÉS DA SESSÃO DE LOGIN ATUAL QUANDO FOR IMPLEMENTADO.
    // $funcionario = (int) $funcionario; // debug

    // sanitização de entrada
    if (!isset($tipo_lanc, $categoria, $valor, $funcionario)) {
        throw new Exception("Missing required parameter(s) - received '" .  assocArrayStringify($_POST) . "'");
    }

    if (!validarDecimal($valor)) {
        throw new Exception("Invalid Parameter - $valor is not a valid decimal");
    }

    if (!isUnsignedInt($categoria)) {
        throw new Exception("Invalid Parameter - categoria must be an foreign key value. Received $categoria");
    }

    switch ($tipo_lanc) {
        case 'lucro':
            $tipo_lanc = 1;
            break;
        case 'despeza':
            $tipo_lanc = 0;
            break;
        default:
            throw new Exception("Invalid Parameter - tipoLanc must be 'lucro' or 'despeza', received $tipo_lanc");
    }

    $valor = formatarDecimal($valor);
    $valor = sqlDecimalConstraint($valor, 8, 2);
    $descricao = is_string($descricao) ? truncate($descricao, 300) : null;
    $categoria = (int) $categoria;

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
        $categoria,
        $funcionario
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

// ! NÃO É POSSÍVEL CRIAR O ENDPOINT POIS O FORM NÃO FUNCIONA AINDA
// ! O FORM NÃO FUNCIONA AINDA POIS É NECESSÁRIO UMA FORMA DE DETECTAR QUAL É O USUÁRIO ATUAL PARA QUE O fk_id_funcionario SEJA DEFINIDO
// TAMBÉM PRECISA DA LISTA DE CATEGORIAS

// TODO: Fazer função "validar telefone" e "validar salario" mais direta. Executar validar, se for valido retornar o valor formatado se não throw erro