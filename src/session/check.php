<?php
session_start();

// Redirect to login if uauth does not exist
$direct_request = basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]);
$session_valid = isset($_SESSION['current_user']);

if (!$direct_request) {
    if (!$session_valid) {
        session_destroy();
        header('Location: login.php');
    }
} else {
    echo json_encode([
        'status' => 'success',
        'content' => $session_valid ? 'true' : 'false'
    ]);
}
