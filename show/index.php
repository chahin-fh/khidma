<?php 
session_start();
$cnx = mysqli_connect("localhost" , "root" , "" , "chayma");
$res = mysqli_query($cnx , "SELECT DISTINCT date from jour");
/*$date = date('2024-01-01');
// Extract day, month, and year
$day = date('d', strtotime($date));
$month = date('m', strtotime($date));
$year = date('Y', strtotime($date));*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>show</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <center>
    <form action="main.php" method="post" onsubmit="return verif()">
        <select name="m" id="m">
            <option value="">select date</option>
            <?php
                while($t = mysqli_fetch_array($res)){
                    $month = date('m' , strtotime($t[0]));
                    $year = date('y' , strtotime($t[0]));
                    $c = "20" . $year . "-" . $month;
                    if($c != $j){
                        echo"<option value='$c'>$c <option>";
                        $j = $c;
                    }
                }
            ?>
        </select>
        <button type="submit">show</button>
    </form>
    </center>
</body>
</html>