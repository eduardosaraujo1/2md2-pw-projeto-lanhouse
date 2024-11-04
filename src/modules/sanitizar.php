<?php
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
