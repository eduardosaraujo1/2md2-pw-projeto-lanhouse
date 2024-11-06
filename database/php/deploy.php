<?php
require __DIR__ . '/conn.php';

// Obter script de build
$script = file_get_contents(__DIR__ . '/../script.sql');

// Conectar ao banco de dados sem especificar o schema
$conn = criarConexaoNoSchema();

// Executar build usando multi_query
if ($conn->multi_query($script)) {
    do {
        // Limpar qualquer retorno para permitir a proxima query
        if ($result = $conn->store_result()) {
            $result->free();
        }
    } while ($conn->next_result());
} else {
    echo "Error executing SQL script: " . $conn->error;
}

$conn->close();
