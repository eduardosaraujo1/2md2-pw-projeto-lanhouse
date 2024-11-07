<?php
require __DIR__ . '/../response.php';
require __DIR__ . '/../modules/conexao.php';

function getUserByEmail($email, $conn)
{
    // Efetuar query a partir do email
    $query = "SELECT id_funcionario, nm_funcionario, nm_senha FROM tb_funcionario WHERE email = ?";
    $types = "s";
    $params = array(
        $email
    );

    $result = executarQuery($conn, $query, $types, $params);
    $user = $result->fetch_assoc();

    return $user ?? false;
}

function startLoginSession($user)
{
    $ONE_WEEK = 604800;

    // Start session for the first time
    session_set_cookie_params([
        'lifetime' => $ONE_WEEK,
        'httponly' => true
    ]);
    session_start();

    // Regenerate the session ID to enforce new cookie parameters
    session_regenerate_id(true);

    // Add current user parameters
    $_SESSION['current_user'] = [
        'id' => $user['id_funcionario'],
        'name' => $user['nm_funcionario']
    ];
}

function attemptLogin()
{
    // Validar metodo de requisição
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        throw new Exception("Request method must be 'POST'. Received " . $_SERVER["REQUEST_METHOD"]);
        // $_POST = $_GET;
    }

    // dados
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // validar dados
    if (!isset($email, $senha)) {
        throw new Exception("Missing required parameters. Parameters 'email' and 'senha' expected");
    }

    // Conectar ao banco de dados para procurar usuário
    $conn = criarConexao();

    // Obter usuário
    $user = getUserByEmail($email, $conn);

    // fechar conexão após o uso
    $conn->close();

    // Verificar se usuário existe
    if (!$user) {
        throw new Exception("USER_NOT_FOUND");
    }

    // Validar senha
    $correct_password = $user['nm_senha'];
    $password_matches = password_verify($senha, $correct_password);

    // Se a senha não for valida, trazer erro
    if (!$password_matches) {
        throw new Exception("INCORRECT_PASSWORD");
    }

    // Iniciar sessão se tudo correr bem
    startLoginSession($user);

    // Enviar resposta de sucesso
    return 'LOGIN_SUCCESS';
}

if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    echo json_encode(setupResponse('attemptLogin'));
}
