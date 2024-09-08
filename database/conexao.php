<?php
$server = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'bd_empresa';

header('Content-Type: application/json');
error_reporting(E_ALL ^ E_WARNING);

function endpoint_response($content, $success)
{
  $error = json_encode([
    "success" => $success,
    "content" => $content
  ]);
  echo $error;
  die();
}

$conn = new mysqli($server, $user, $pass, $db);
if ($conn->connect_error) {
  endpoint_response($conn->connect_error, false);
}
