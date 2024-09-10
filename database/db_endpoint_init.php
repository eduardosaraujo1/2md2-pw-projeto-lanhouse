<?php
// Bloquear acesso direto
if (basename($_SERVER['SCRIPT_FILENAME']) === basename(__FILE__)) {
  die('Direct access not allowed');
}

// Determinar retorno em JSON
header('Content-Type: application/json');
error_reporting(E_ALL ^ E_WARNING);

// Retornar JSON mesmo em casos de erros (warnings, exceptions, etc)
set_exception_handler(function ($exception) {
  $code = $exception->getCode();
  $message = $exception->getMessage();
  endpoint_return("Exception: [$code] $message", false);
});

set_error_handler(function ($errno, $errstr, $errfile, $errline) {
  $error = "Error: [$errno] $errstr in $errfile on line $errline";
  endpoint_return($error, false);
});

// Conectar ao banco
$server = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'bd_empresa';

// Start connection
$conn = new mysqli($server, $user, $pass, $db);
if ($conn->connect_error) {
  endpoint_return($conn->connect_error, false);
}

// Utilitarios
function endpoint_return($content, $success)
{
  $error = json_encode([
    "success" => $success,
    "content" => $content
  ]);
  echo $error;
  die();
}
