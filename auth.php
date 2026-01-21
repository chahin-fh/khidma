<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($LOGIN_URL) || $LOGIN_URL === '') {
    $LOGIN_URL = 'login.php';
}

if (empty($_SESSION['user_id'])) {
    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
    header('Location: ' . $LOGIN_URL);
    exit;
}
?>
