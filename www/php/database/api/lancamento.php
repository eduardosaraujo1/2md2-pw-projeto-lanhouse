<?php
throw new Exception("Not Implemented New Framework");

// ! NÃO É POSSÍVEL CRIAR O ENDPOINT POIS O FORM NÃO FUNCIONA AINDA
// ! O FORM NÃO FUNCIONA AINDA POIS É NECESSÁRIO UMA FORMA DE DETECTAR QUAL É O USUÁRIO ATUAL PARA QUE O fk_id_funcionario SEJA DEFINIDO
// TAMBÉM PRECISA DA LISTA DE CATEGORIAS

// salvando dados do form
// $nome = $_POST['nome'];
// $sobrenome = $_POST["sobrenome"];
// $dt_nascimento = $_POST["dtNascimento"];
// $cargo = $_POST["cargo"];
// $salario = $_POST["salario"];
// $dtAdmissao = date('Y-m-d');
// $email = $_POST["email"];
// $senha = $_POST["senha"];

// Tratando dados

// Inserindo dados
// $insert = safe_insert_prepare("
//     INSERT INTO tb_funcionario (nm_funcionario, nm_sobrenome, dt_nascimento, nm_cargo, nr_salario, dt_admissao, email, nm_senha)
//     VALUES (?, ?, ?, ?, ?, ?, ?, ?);
//     ", $conn);

// // 's' = string, 'i' = integer, 'd' = double, 'b' = blob
// $insert->bind_param(
//     "ssssdsss",
//     $nome,
//     $sobrenome,
//     $dt_nascimento,
//     $cargo,
//     $salario,
//     $dtAdmissao,
//     $email,
//     $senha
// );

// safe_insert_execute($insert, $conn);
// endpoint_return("Insert success", true);
