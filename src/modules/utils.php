<?php

// string utils
function truncate($str, $length = 1)
{
    $str = $str ?? "";
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

/**
 * Verifica quais campos em um array associativo estão indefinidos ou vazios.
 *
 * Este método espera um array associativo onde as chaves representam os nomes
 * dos campos obrigatórios e os valores são os valores desses campos.
 * A função retorna uma lista das chaves que possuem valores vazios ou indefinidos.
 *
 * @param array $campos Array associativo de campos obrigatórios, onde:
 *              - a chave é o nome do campo (string)
 *              - o valor é o conteúdo do campo (string|null)
 *              Exemplo: ['nome' => 'João', 'email' => null, 'telefone' => '']
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
