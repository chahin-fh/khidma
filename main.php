<?php
$LOGIN_URL = 'login.php';
require_once 'auth.php';
require_once 'db.php';

extract($_POST);
$cnx = db_connect();

$stmt = mysqli_prepare($cnx, "INSERT INTO jour(TDJ,S,m,T,SDC,date,SLT,autre) VALUES(?,?,?,?,?,?,?,?)");
if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'ssssssss', $TDJ, $S, $m, $T, $SDC, $date, $SLT, $autre);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

mysqli_close($cnx);
header("Location: index.php");
exit;
?>
