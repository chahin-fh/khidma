<?php
$LOGIN_URL = '../login.php';
require_once '../auth.php';
require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$action = isset($_POST['action']) ? $_POST['action'] : '';
$redirectMonth = isset($_POST['m']) ? $_POST['m'] : '';
$cnx = db_connect();

if ($action === 'delete') {
    $date = isset($_POST['date']) ? $_POST['date'] : '';
    if ($date !== '') {
        $stmt = mysqli_prepare($cnx, "DELETE FROM jour WHERE date = ? LIMIT 1");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 's', $date);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
    $redirectUrl = 'main.php?m=' . urlencode($redirectMonth);
    header('Location: ' . $redirectUrl);
    exit;
}

if ($action === 'update') {
    $date = isset($_POST['date']) ? $_POST['date'] : '';
    $TDJ = isset($_POST['TDJ']) ? $_POST['TDJ'] : '';
    $S = isset($_POST['S']) ? $_POST['S'] : '';
    $m = isset($_POST['m']) ? $_POST['m'] : '';
    $T = isset($_POST['T']) ? $_POST['T'] : '';
    $SDC = isset($_POST['SDC']) ? $_POST['SDC'] : '';
    $SLT = isset($_POST['SLT']) ? $_POST['SLT'] : '';
    $autre = isset($_POST['autre']) ? $_POST['autre'] : '';

    if ($date !== '') {
        $stmt = mysqli_prepare($cnx, "UPDATE jour SET TDJ=?, S=?, m=?, T=?, SDC=?, SLT=?, autre=? WHERE date=? LIMIT 1");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'ssssssss', $TDJ, $S, $m, $T, $SDC, $SLT, $autre, $date);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
    $redirectUrl = 'main.php?m=' . urlencode($redirectMonth);
    header('Location: ' . $redirectUrl);
    exit;
}

mysqli_close($cnx);
header('Location: index.php');
exit;
?>
