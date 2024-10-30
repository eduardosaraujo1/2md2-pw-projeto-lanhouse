<?php
// Bloquear acesso direto
if (basename($_SERVER['SCRIPT_FILENAME']) === basename(__FILE__)) {
    die('Direct access not allowed');
}

// Endpoint init
require_once('../init.php');

$method = $_SERVER['REQUEST_METHOD'];
if ($method !== 'POST') {
    endpoint_return("Invalid request method: $method", false);
}

function trigger_insert_error($conn)
{
    $error = "Insert error: " . $conn->error;
    endpoint_return($error, false);
}
function safe_insert_prepare($query, $conn)
{
    $insert = $conn->prepare($query);
    if (!$insert) {
        trigger_insert_error($conn);
    }
    return $insert;
}

function safe_insert_execute($insert, $conn)
{
    if (!$insert->execute()) {
        trigger_insert_error($conn);
    }
    return true;
}
