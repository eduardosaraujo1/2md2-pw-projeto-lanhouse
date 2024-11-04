<?php
require __DIR__ . '/../get/categorias.php';

function viewCategoria($categorias)
{
    // Initialize an empty string for the <option> tags
    $options = '';

    // Loop through each item in the array
    foreach ($categorias as $item) {
        if (isset($item['id']) && isset($item['nome'])) {
            // Append an <option> tag with the appropriate value and innerHTML
            $options .= '<option value="' . htmlspecialchars($item['id']) . '">'
                . htmlspecialchars($item['nome'])
                . '</option>\n';
        }
    }

    // Displays option tags
    echo $options;
}

viewCategoria(getCategorias());
