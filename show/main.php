<?php
extract($_POST);
$cnx = mysqli_connect("localhost" , "root" , "" , "chayma");
$res = mysqli_query($cnx,"SELECT * from jour where date like '$m%';");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>Page Title</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' type='text/css' media='screen' href='main1.css'>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
  <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
</head>
<body>
<?php
    while($t = mysqli_fetch_array($res)){
        echo"
        <form>
            <fieldset>
            <h1>$t[5]</h1>
            <br><br>
            <h2>travail du jour:</h2><h4>$t[0]</h4>
            <br><br>
            <h2>sel3a:</h2><h4>$t[1]</h4>
            <br><br>
            <h2>mazout:</h2><h4>$t[2]</h4>
            <br><br>
            <h2>taslih:</h2><h4>$t[3]</h4>
            <br><br>
            <h2>salaire du chouffeur:</h2><h4>$t[4]</h4>
            <br><br>
            <h2>which vehicle:</h2><h4>$t[6]</h4>
            <br><br>
            <h2>autre:</h2><h4>$t[7]</h4>
            </fieldset>
    </form>
        ";
    }
?>
 <button id="convertToPdf" >Convertir la page en PDF</button>
    <script>
        document.getElementById('convertToPdf').addEventListener('click', function() {
            const { jsPDF } = window.jspdf;
            html2canvas(document.body).then(canvas => {
                let pdf = new jsPDF('p', 'pt', 'letter');
                let imgData = canvas.toDataURL('image/png');
                let imgWidth = 595.28; 
                let pageHeight = 841.89; 
                let imgHeight = canvas.height * imgWidth / canvas.width;
                let heightLeft = imgHeight;
                let position = 0;
                
                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    pdf.addPage();
                    pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }
                pdf.save('T.pdf');
            });
        });
    </script>
</body>
</html>