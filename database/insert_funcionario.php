<?php
// salvando dados do form
$nome = $_POST['nome'];
$sobrenome = $_POST["sobrenome"];
$dt_nascimento = $_POST["data-nascimento"];
$email = $_POST["email"];
$cargo = $_POST["cargo"];
$salario = $_POST["salario"];
$salario = str_replace(',', '.', $salario);
$senha = $_POST["senha"];

require_once('conexao.php'); // conectar c banco

// inserir (TODO: ARRUMAR INSERT QUEBRADO DADOS NÃO TRATADOS CORRETAMENTE)
$insert = "
INSERT INTO tb_funcionario
VALUES (NULL, '$nome', '$sobrenome', '$dt_nascimento', '$cargo', '$salario', '".date("Y-m-d")."', '$email', '$senha');";
$resultado = $conn->query($insert);

if ($resultado) {
    // FAZER COM QUE VOLTE PARA home.html
    // APLIQUE ESSE PADRÃO PARA OUTRAS TELAS
}