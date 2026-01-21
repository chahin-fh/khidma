<?php
function db_connect() {
    $cnx = mysqli_connect("localhost", "root", "", "chayma");
    if (!$cnx) {
        die("Database connection failed");
    }
    mysqli_set_charset($cnx, 'utf8mb4');
    return $cnx;
}
?>
