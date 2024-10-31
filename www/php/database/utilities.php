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

// validation utils
function validarTelefone($phone_number)
{
    $phone_number = preg_replace("/\D/", '', $phone_number);
    if (strlen($phone_number) >= 3 && $phone_number[2] === '9') {
        return strlen($phone_number) === 11;
    } else {
        return strlen($phone_number) === 10;
    }
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

function isUnsignedInt($str)
{
    return (is_string($str) && preg_match("/^\d+$/", $str));
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
    $inteira = truncate($inteira, $size - $precision);

    // Junta os dois valores novamente e converte em float
    $num = (float) "$inteira.$decimal";

    return $num;
}

// formatters
function formatarTelefone($telefone)
{
    return truncate(preg_replace("/\D/", '', $telefone), 11);
}

function formatarDecimal($decimal)
{
    return (float) str_replace(',', '.', $decimal);
}
