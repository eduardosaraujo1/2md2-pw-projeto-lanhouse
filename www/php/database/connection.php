<?php
if (basename($_SERVER['SCRIPT_FILENAME']) == basename(__FILE__)) {
    die('Direct access not permitted');
}

function criarConexao($path)
{
    $raw_credentials = file_get_contents($path);
    $credentials = json_decode($raw_credentials, true);

    if (!isset($credentials["host"], $credentials["username"], $credentials["password"], $credentials["database"], $credentials["port"])) {
        throw new Exception("Error: Missing credentials.");
    }

    $conn = new mysqli(
        $credentials["host"],
        $credentials["username"],
        $credentials["password"],
        $credentials["database"],
        $credentials["port"]
    );

    if ($conn->connect_error) {
        throw new Exception("Error: Connection failed -> " . $conn->connect_error);
    }

    return $conn;
}

/**
 * Executa uma consulta MySQL preparada com parâmetros opcionais para evitar SQL Injection.
 * 
 * @param \mysqli $conn Objeto de conexão MySQLi
 * @param string $query Consulta SQL em formato de string
 * @param string|null $types Tipo de cada parâmetro em $params ("i" para inteiro, "d" para double, "s" para string, "b" para blob)
 * @param array|null $params Parâmetros para vincular à consulta, prevenindo SQL Injection
 * @return \mysqli_result|false Retorna um objeto MySQLi result em caso de sucesso, ou false em caso de falha
 * @link https://www.php.net/manual/en/mysqli-stmt.bind-param.php
 */
function executarQuery($conn, $query, $types = null, $params = null)
{
    // Certifica que ambos ou nenhum dos parâmetros $types e $params estão definidos
    if (($types && !$params) || (!$types && $params)) {
        return false;
    }

    // Prepara a declaração e retorna false em caso de falha
    if (!$stmt = $conn->prepare($query)) {
        return false;
    }

    // Vincula parâmetros, se fornecidos
    if ($types && $params) {
        if (!$stmt->bind_param($types, ...$params)) {
            return false;
        }
    }

    // Executa a declaração e retorna o resultado ou false em caso de erro
    if (!$stmt->execute()) {
        return false;
    }

    // Retorna resultado
    return true;
}

function truncate($str, $length)
{
    return mb_substr($str, 0, $length);
}
