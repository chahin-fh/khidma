<?php
$cnx = mysqli_connect("localhost" , "root" , "" , "chayma");
extract($_POST);
$res = mysqli_query($cnx,"INSERT into jour(TDJ,S,m,T,SDC,date,SLT,autre) values('$TDJ','$S','$m','$T','$SDC','$date','$SLT','$autre')");
sleep(3);
header("Refresh:0; url=index.html");
mysqli_close($cnx);
?>
