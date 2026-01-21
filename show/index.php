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
    <div class="app-shell">
      <header class="app-header">
        <div class="app-title">Daily Work</div>
        <nav class="app-nav">
          <a class="app-link" href="../index.html">New entry</a>
        </nav>
      </header>

      <div class="formbold-main-wrapper">
        <div class="formbold-form-wrapper">
          <form action="main.php" method="post" onsubmit="return verif()">
            <div class="page-title">Show entries</div>
            <div class="page-subtitle">Pick a month to view saved records.</div>

            <label class="formbold-form-label" for="m">Month</label>
            <select name="m" id="m" class="formbold-form-input">
                <option value="">select date</option>
                <?php
                    while($t = mysqli_fetch_array($res)){
                        $month = date('m' , strtotime($t[0]));
                        $year = date('y' , strtotime($t[0]));
                        $c = "20" . $year . "-" . $month;
                        if($c != $j){
                            echo"<option value='$c'>$c</option>";
                            $j = $c;
                        }
                    }
                ?>
            </select>

            <button class="formbold-btn" type="submit">show</button>
          </form>
        </div>
      </div>
    </div>
</body>
</html>