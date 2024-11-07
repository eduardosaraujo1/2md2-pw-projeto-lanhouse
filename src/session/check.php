<?php
session_start();

// Redirect to login if uauth does not exist
$direct_request = basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]);
$session_valid = isset($_SESSION['current_user']);

if (!$direct_request) {
    echo json_encode([
        'status' => 'success',
        'content' => $session_valid ? 'true' : 'false'
    ]);
} else if (!$session_valid) {
    unset($_SESSION['current_user']);
    header('Location: login.php');
    die();
}
