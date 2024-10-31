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
        throw new Exception("Error: Connection failed -> " . $conn->connect_error);
    }

    return $conn;
}

/**
 * Executa uma query MySQL sem retorno de resultado, utilizando parametros para segurança de entrada
 * 
 * @param \mysqli $conn Objeto de conexão MySQLi
 * @param string $query Consulta SQL em formato de string
 * @param string|null $types Tipo de cada parâmetro em $params ("i" para inteiro, "d" para double, "s" para string, "b" para blob)
 * @param array|null $params Parâmetros para vincular à consulta, prevenindo SQL Injection
 * 
 * @return bool Retorna se a operação foi um sucesso ou uma falha
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

    // Se tudo correr bem, retorne verdadeiro
    return true;
}

// Utilities
function truncate($str, $length)
{
    return mb_substr($str, 0, $length);
}

function validarData($date)
{
    $format = 'Y-m-d'; // yyyy-mm-dd format
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

function validarDecimal($str)
{
    // Se houver caractere não numerico, declarar invalido
    return !preg_match("/[^\d.,]/i", $str);
}

/**
 * Aplica a restrição que o tipo de dado MySQL DECIMAL(size, precision) colocaria em um número,
 * truncando a parte inteira e a decimal conforme necessário.
 *
 * @param float $num O número a ser ajustado conforme a constraint do tipo DECIMAL.
 * @param int $size O tamanho total permitido, incluindo a parte inteira e decimal.
 * @param int $precision A quantidade de casas decimais permitidas.
 * 
 * @return float O número ajustado, respeitando as restrições de tamanho e precisão.
 */
function sqlDecimalConstraint($num, $size, $precision)
{
    // Formata o número de forma padronizada, ao mesmo tempo truncando a parte decimal
    $num = number_format($num, $precision, '.', '');

    // Separar parte inteira da parte decimal
    list($inteira, $decimal) = explode('.', $num);

    // Trunca o número da parte inteira para encaixar na constraint
    $inteira = truncate($inteira,  $size - $precision);

    // Junta os dois valores novamente e converte em float
    $num = (float) "$inteira.$decimal";

    return $num;
}
