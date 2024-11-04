<?php
if (basename($_SERVER['SCRIPT_FILENAME']) == basename(__FILE__)) {
    die('Direct access not permitted');
}

/**
 * Cria um objeto de conexão de banco de dados
 * 
 * @param string $path Caminho (relativo ou absoluto) para o arquivo JSON contendo as credenciais. O caminho relativo pode se alterar dependendo da localização do arquivo
 * @return \mysqli Objeto de conexão MySQL
 * @link https://github.com/eduardosaraujo1/2md2-pw-projeto-lanhouse/blob/main/database.json
 */
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
        throw new Exception("Connection failed. Error:" . $conn->connect_error);
    }

    return $conn;
}

/**
 * Executa uma query MySQL, utilizando parametros para segurança de entrada
 * 
 * @param \mysqli $conn Objeto de conexão MySQLi
 * @param string $query Consulta SQL em formato de string
 * @param string|null $types Tipo de cada parâmetro em $params ("i" para inteiro, "d" para double, "s" para string, "b" para blob)
 * @param array|null $params Parâmetros para vincular à consulta, prevenindo SQL Injection
 * 
 * @return \mysqli_result Result que pode ser lido utilizando .fetch_assoc.
 * @link https://www.php.net/manual/en/mysqli-stmt.bind-param.php
 * @link https://phpdelusions.net/mysqli_examples/prepared_select
 */
function executarQuery($conn, $query, $types = null, $params = null)
{
    // Certifica que ambos ou nenhum dos parâmetros $types e $params estão definidos
    if (($types && !$params) || (!$types && $params)) {
        raiseQueryError($conn->error);
    }

    // Prepara a declaração e retorna false em caso de falha
    if (!$stmt = $conn->prepare($query)) {
        raiseQueryError($conn->error);
    }

    // Vincula parâmetros, se fornecidos
    if ($types && $params) {
        if (!$stmt->bind_param($types, ...$params)) {
            raiseQueryError($conn->error);
        }
    }

    // Executa a declaração e retorna o resultado ou false em caso de erro
    if (!$stmt->execute()) {
        raiseQueryError($conn->error);
    }

    // Se tudo correr bem, retorne verdadeiro
    return $stmt->get_result();
}
