<?php

function truncate($str, $length)
{
    return mb_substr($str, 0, $length);
}

function arrayParaString($array)
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
    $num_only = preg_replace("/\D/", '', $phone_number);
    if (strlen($num_only) >= 3 && $num_only[2] === '9') {
        return strlen($num_only) === 11;
    } else {
        return strlen($num_only) === 10;
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
