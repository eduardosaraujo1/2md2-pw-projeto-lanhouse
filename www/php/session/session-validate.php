<?php
session_start();

// Redirect to login if uauth does not exist
if (!$_SESSION['current_user']) {
    session_destroy();
    header('Location: login.php');
}
