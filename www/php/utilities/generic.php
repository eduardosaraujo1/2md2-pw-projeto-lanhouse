<?php

// string utils
function truncate($str, $length)
{
    return mb_substr($str, 0, $length);
}

function assocArrayStringify($array)
{
    $result = [];
    foreach ($array as $key => $value) {
        $result[] = "[$key] => $value";
    }
    return implode("; ", $result);
}

// input sanitize utils
function sanitizarTelefone($telefone)
{
    // Formatar: remover valores não numericos
    $telefone = preg_replace("/\D/", '', $telefone);
    // Validate: Se o terceiro digito for 9, tamanho deve ser 11 digitos, se não, tamanho deve ser 10
    if (strlen($telefone) < 10 || strlen($telefone) > 11) {
        return false;
    }

    $expectedLength = $telefone[2] === '9' ? 11 : 10;
    if (strlen($telefone) !== $expectedLength) {
        return false;
    }

    // Retorne a string dos 10 ou 11 digitos não formatados
    return $telefone;
}

function sanitizarData($date)
{
    // Transformar data em objeto
    $format = 'Y-m-d'; // yyyy-mm-dd format
    $dateObject = DateTime::createFromFormat($format, $date);

    // Se a conversão falhar, data invalida
    if (!$dateObject) {
        return false;
    }

    // Transforma o objeto de volta em data, e verifica se esse novo objeto é igual a data inserida
    $newDate = $dateObject->format($format);
    return $newDate;
}

function sanitizarDecimal($num, $size, $precision)
{
    // Validate: Não possui caracteres não numericos (0-9,.)
    if (preg_match("/[^\d.,]/", $num)) {
        return false;
    }

    // Format: transformar virgula em ponto
    $num = str_replace(',', '.', $num);

    // Format: transformar em float
    $num = (float) $num;

    // Format: arrendodar número
    $num = round($num, $precision);

    // Validate: Constraint do decimal
    [$inteira] = explode('.', $num);
    if (strlen($inteira) > $size - $precision) {
        return false;
    }

    return $num;
}

function sanitizarInt($num)
{
    return preg_match("/^\d+$/", $num) ? (int) $num : false;
}

/**
 * Se campo for vazio ou indefinido, transformar variavel em "null", se não mante-la
 * 
 * @return mixed|null
 */
function sanitizarNullable($campo)
{
    if (isset($campo) && !empty($campo)) {
        return $campo;
    }
    return null;
}



// Error messages
function raiseInvalidRequestMethod()
{
    throw new Exception("Invalid request method. Expected 'POST' received '" . $_SERVER["REQUEST_METHOD"] . "'");
}

function raiseMissingParameters($campos)
{
    throw new Exception("Missing Fields. Could not find '" . implode(', ', $campos) . "'");
}

function raiseInvalidParameter($fieldname, $extra = "")
{
    $extra = empty($extra) ? $extra : ". $extra";
    throw new Exception("Invalid Parameter. Field '$fieldname' is not in a valid format$extra");
}

function raiseInvalidSession()
{
    throw new Exception("Invalid Session. Please sign in to use the app.");
}

function raiseQueryError($error)
{
    throw new Exception("SQL query error. " . $error);
}

// Helpers
/**
 * Verifica quais campos em um array associativo estão indefinidos ou vazios.
 *
 * Este método espera um array associativo onde as chaves representam os nomes
 * dos campos obrigatórios e os valores são os valores desses campos.
 * A função retorna uma lista das chaves que possuem valores vazios ou indefinidos.
 *
 * @param array $campos Array associativo de campos obrigatórios, onde:
 *                      - a chave é o nome do campo (string)
 *                      - o valor é o conteúdo do campo (string|null)
 *                      Exemplo:
 *                      [
 *                          'nome' => 'João',
 *                          'email' => null,
 *                          'telefone' => '',
 *                      ]
 *
 * @return array Lista de chaves que possuem valores vazios ou indefinidos.
 *               Retorna um array vazio se todos os campos estiverem preenchidos.
 */
function verificarCamposIndefinidos($campos)
{
    $camposIndefinidos = [];

    foreach ($campos as $chave => $valor) {
        if (empty($valor)) { // Checa se o valor é vazio ou indefinido
            $camposIndefinidos[] = $chave;
        }
    }

    return $camposIndefinidos;
}
