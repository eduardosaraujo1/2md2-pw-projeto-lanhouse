<?php
require __DIR__ . '/../src/modules/conexao.php';

$conn = criarConexao();

$script = file_get_contents(__DIR__ . '/../database/script.sql');

// Execute the script using multi_query
if ($conn->multi_query($script)) {
    do {
        // Store any result set to clear results and allow the next query to run
        if ($result = $conn->store_result()) {
            $result->free();
        }
    } while ($conn->next_result()); // Move to the next result set
} else {
    echo "Error executing SQL script: " . $conn->error;
}

$conn->close();
