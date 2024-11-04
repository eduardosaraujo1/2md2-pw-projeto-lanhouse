<?php
if (basename($_SERVER['SCRIPT_FILENAME']) == basename(__FILE__)) {
    die('ACESSO_NEGADO');
}

require 'utils.php';
require 'sanitizar.php';
require 'erros.php';
require 'conexao.php';
