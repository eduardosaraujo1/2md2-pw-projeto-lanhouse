<?php
require __DIR__ . '/../response.php';
require __DIR__ . '/../modules/autoload.php';

function insertCategoria()
{
    // Iniciar sessão (para obter usuário atual)
    session_start();

    // validar tipo de request
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        raiseInvalidRequestMethod();
    }

    // dados
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    // validar sessão
    if (!$_SESSION['current_user']) {
        raiseInvalidSession();
    }

    // validação de entrada
    $required_fields = $_POST;
    unset($required_fields['descricao']);
    $missing_fields = verificarCamposIndefinidos($required_fields);
    if (!empty($missing_fields)) {
        raiseMissingParameters($missing_fields);
    }

    // sanitize
    $nome = truncate($nome, 50);
    $descricao = sanitizarNullable($descricao);
    $descricao = truncate($descricao, 120);

    // conexão
    $conn = criarConexao("../../../database.json");

    // montar query
    $query = 'INSERT INTO tb_categoria (nome, descricao) VALUES (?, ?)';
    $types = "ss";
    $params = array($nome, $descricao);

    // executar query
    executarQuery($conn, $query, $types, $params);

    // fechar conexão
    $conn->close();

    return 'INSERT_SUCCESS';
}

if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    echo json_encode(setupResponse('insertCategoria'));
}
