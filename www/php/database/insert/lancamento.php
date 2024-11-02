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
    $valor = $_POST["valor"];
    $tipo_lanc = $_POST["tipoLanc"];
    $data_lanc = date('Y-m-d');
    $fk_funcionario = 1;
    $descricao = $_POST["descricao"];
    $fk_categoria = $_POST["categoria"];
    $fk_funcionario = $_SESSION['current_user']['id'];

    // validar sessão
    if (!$_SESSION['current_user'] || empty($fk_funcionario)) {
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
