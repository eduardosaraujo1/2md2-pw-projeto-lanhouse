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
    if (!empty($_POST['debug'])) {
        $fk_funcionario = 1;
    }
    $valor = $_POST["valor"];
    $tipo_lanc = $_POST["tipoLanc"];
    $data_lanc = date('Y-m-d');
    $descricao = $_POST["descricao"];
    $fk_categoria = $_POST["categoria"];


    // validar sessão e propriedades enviadas
    if (empty($fk_funcionario)) {
        raiseInvalidSession();
    }

    // obter campos faltantes
    $required_fields = $_POST;
    unset($required_fields['descricao']);
    $missing_fields = verificarCamposIndefinidos($required_fields);

    // sanitização de entrada
    if (!empty($missing_fields)) {
        raiseMissingParameters($missing_fields);
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
