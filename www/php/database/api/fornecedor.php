<?php
throw new Exception("Not Implemented New Framework");
// require '_insert.php';

// // salvando dados do form
// $nome = $_POST['nome'];
// $contato = $_POST['contato'];
// $email = $_POST["email"];
// $telefone = $_POST["telefone"];
// $endereco = $_POST["endereco"];

// // Tratando dados
// $nome = mb_substr($nome, 0, 50);
// $contato = mb_substr($contato, 0, 30);
// $email = mb_substr($email, 0, 50);
// $telefone = preg_replace('/\D/', '', $telefone); // Deixar apenas números no telefone
// $telefone = mb_substr($telefone, 0, 11);
// $endereco = mb_substr($endereco, 0, 100);

// // Inserindo dados
// $insert = safe_insert_prepare("
//     INSERT INTO tb_fornecedor (nm_fornecedor, nm_contato, nm_email, nr_telefone, nm_endereco)
//     VALUES (?, ?, ?, ?, ?);
// ", $conn);

// // 's' = string, 'i' = integer, 'd' = double, 'b' = blob
// $insert->bind_param(
//     "sssss",
//     $nome,
//     $contato,
//     $email,
//     $telefone,
//     $endereco
// );
// safe_insert_execute($insert, $conn);
// endpoint_return("Insert success", true);
