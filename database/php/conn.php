<?php
function criarConexaoNoSchema()
{
    $raw_credentials = file_get_contents(__DIR__ . '/../../config/database.json');
    $credentials = json_decode($raw_credentials, true);

    if (!isset($credentials["host"], $credentials["username"], $credentials["password"], $credentials["port"])) {
        throw new Exception("Connection Error: Missing credentials.");
    }

    $conn = new mysqli(
        $credentials["host"],
        $credentials["username"],
        $credentials["password"],
        null,
        $credentials["port"]
    );

    if ($conn->connect_error) {
        throw new Exception("Connection Error:" . $conn->connect_error);
    }

    return $conn;
}