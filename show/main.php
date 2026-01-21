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
  <div class="app-shell">
    <header class="app-header">
      <div class="app-title">Daily Work</div>
      <nav class="app-nav">
        <a class="app-link" href="../index.html">New entry</a>
        <a class="app-link" href="index.php">Change month</a>
      </nav>
    </header>

    <div class="results-wrapper" id="resultsRoot">
      <div class="results-head">
        <div>
          <div class="page-title">Results</div>
          <div class="page-subtitle">Month: <?php echo $m; ?></div>
        </div>
        <button class="formbold-btn results-btn" id="convertToPdf" type="button">Convertir la page en PDF</button>
      </div>

      <div class="records-grid">
      <?php
          while($t = mysqli_fetch_array($res)){
              echo"
              <div class='record-card'>
                <div class='record-date'>$t[5]</div>
                <div class='record-grid'>
                  <div class='record-item'><div class='record-label'>travail du jour</div><div class='record-value'>$t[0]</div></div>
                  <div class='record-item'><div class='record-label'>sel3a</div><div class='record-value'>$t[1]</div></div>
                  <div class='record-item'><div class='record-label'>mazout</div><div class='record-value'>$t[2]</div></div>
                  <div class='record-item'><div class='record-label'>taslih</div><div class='record-value'>$t[3]</div></div>
                  <div class='record-item'><div class='record-label'>salaire du chouffeur</div><div class='record-value'>$t[4]</div></div>
                  <div class='record-item'><div class='record-label'>which vehicle</div><div class='record-value'>$t[6]</div></div>
                  <div class='record-item record-item-wide'><div class='record-label'>autre</div><div class='record-value'>$t[7]</div></div>
                </div>
              </div>
              ";
          }
      ?>
      </div>
    </div>
  </div>
    <script>
        document.getElementById('convertToPdf').addEventListener('click', function() {
            const { jsPDF } = window.jspdf;
            html2canvas(document.getElementById('resultsRoot')).then(canvas => {
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