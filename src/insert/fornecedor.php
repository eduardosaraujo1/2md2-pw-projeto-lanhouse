<?php
require __DIR__ . '/../response.php';
require __DIR__ . '/../modules/autoload.php';

function insertFornecedor()
{
    // Iniciar sessão (para obter usuário atual)
    session_start();

    // validar tipo de request
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        raiseInvalidRequestMethod();
    }

    // dados
    $nome = $_POST['nome'];
    $contato = $_POST['contato'];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $endereco = $_POST["endereco"];

    // validar sessão
    if (!$_SESSION['current_user']) {
        raiseInvalidSession();
    }

    // validação de entrada
    $required_fields = $_POST;
    $missing_fields = verificarCamposIndefinidos($required_fields);
    if (!empty($missing_fields)) {
        raiseMissingParameters($missing_fields);
    }

    if (!$telefone = sanitizarTelefone($telefone)) {
        raiseInvalidParameter('telefone');
    }

    $nome = truncate($nome, 50);
    $contato = truncate($contato, 30);
    $email = truncate($email, 50);
    $endereco = truncate($endereco, 100);


    // conexão
    $conn = criarConexao(__DIR__ . "../../config/database.json");

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

    // fechar conexão
    $conn->close();

    // montar resposta
    return 'INSERT_SUCCESS';
}

if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    echo json_encode(setupResponse('insertFornecedor'));
}
