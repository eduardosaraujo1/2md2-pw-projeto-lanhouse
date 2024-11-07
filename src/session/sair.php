<?php
// Anular sessão
session_start();
session_destroy();

// Redirecionar para login
header("Location: ../../public/login.php");
die();
