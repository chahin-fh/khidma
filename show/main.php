<?php
$LOGIN_URL = '../login.php';
require_once '../auth.php';
require_once '../db.php';

$cnx = db_connect();

$m = '';
if (isset($_POST['m'])) {
    $m = $_POST['m'];
} elseif (isset($_GET['m'])) {
    $m = $_GET['m'];
}

$m = trim($m);
if ($m === '') {
    header('Location: index.php');
    exit;
}

$mLike = $m . '%';
$stmt = mysqli_prepare($cnx, "SELECT * FROM jour WHERE date LIKE ?");
if ($stmt) {
    mysqli_stmt_bind_param($stmt, 's', $mLike);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
}

if (!isset($res) || $res === false) {
    $mLikeSafe = mysqli_real_escape_string($cnx, $mLike);
    $res = mysqli_query($cnx, "SELECT * FROM jour WHERE date LIKE '$mLikeSafe'");
}
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
        <a class="app-link" href="../index.php">New entry</a>
        <a class="app-link" href="index.php">Change month</a>
        <a class="app-link" href="../logout.php">Logout</a>
      </nav>
    </header>

    <div class="results-wrapper" id="resultsRoot">
      <div class="results-head">
        <div>
          <div class="page-title">Results</div>
          <div class="page-subtitle">Month: <?php echo htmlspecialchars($m); ?></div>
        </div>
        <button class="formbold-btn results-btn" id="convertToPdf" type="button">Convertir la page en PDF</button>
      </div>

      <div class="records-grid">
      <?php
          while($t = mysqli_fetch_array($res)){
              $escaped = array_map('htmlspecialchars', $t);
              echo"
              <div class='record-card'>
                <div class='record-date'>{$escaped[5]}</div>
                <div class='record-grid'>
                  <div class='record-item'><div class='record-label'>travail du jour</div><div class='record-value'>{$escaped[0]}</div></div>
                  <div class='record-item'><div class='record-label'>sel3a</div><div class='record-value'>{$escaped[1]}</div></div>
                  <div class='record-item'><div class='record-label'>mazout</div><div class='record-value'>{$escaped[2]}</div></div>
                  <div class='record-item'><div class='record-label'>taslih</div><div class='record-value'>{$escaped[3]}</div></div>
                  <div class='record-item'><div class='record-label'>salaire du chouffeur</div><div class='record-value'>{$escaped[4]}</div></div>
                  <div class='record-item'><div class='record-label'>which vehicle</div><div class='record-value'>{$escaped[6]}</div></div>
                  <div class='record-item record-item-wide'><div class='record-label'>autre</div><div class='record-value'>{$escaped[7]}</div></div>
                </div>
                <div class='record-actions'>
                  <button class='btn-edit' data-date='{$escaped[5]}' data-tdj='{$escaped[0]}' data-s='{$escaped[1]}' data-m='{$escaped[2]}' data-t='{$escaped[3]}' data-sdc='{$escaped[4]}' data-slt='{$escaped[6]}' data-autre='{$escaped[7]}'>✏️ Edit</button>
                  <form class='delete-form' method='post' action='edit_delete.php' style='display:inline;'>
                    <input type='hidden' name='action' value='delete'>
                    <input type='hidden' name='date' value='{$escaped[5]}'>
                    <input type='hidden' name='m' value='" . htmlspecialchars($m) . "'>
                    <button type='submit' class='btn-delete' onclick=\"return confirm('Delete this record?');\">🚮 Delete</button>
                  </form>
                </div>
              </div>
              ";
          }
      ?>
      </div>

      <!-- Inline Edit Form (hidden by default) -->
      <div id='editFormOverlay' class='edit-overlay' style='display:none;'>
        <div class='edit-form-wrapper'>
          <form id='editForm' method='post' action='edit_delete.php'>
            <input type='hidden' name='action' value='update'>
            <input type='hidden' id='editDate' name='date'>
            <input type='hidden' name='m' value='<?php echo htmlspecialchars($m); ?>'>

            <div class='formbold-input-flex'>
              <div>
                <label class='formbold-form-label'>travail du jour</label>
                <input type='number' id='editTDJ' name='TDJ' class='formbold-form-input' />
              </div>
              <div>
                <label class='formbold-form-label'>sel3a</label>
                <input type='number' id='editS' name='S' class='formbold-form-input' />
              </div>
            </div>

            <div class='formbold-input-flex'>
              <div>
                <label class='formbold-form-label'>mazout</label>
                <input type='number' id='editM' name='m' class='formbold-form-input' />
              </div>
              <div>
                <label class='formbold-form-label'>taslih</label>
                <input type='number' id='editT' name='T' class='formbold-form-input' />
              </div>
            </div>

            <div class='formbold-input-flex'>
              <div>
                <label class='formbold-form-label'>salaire du chouffeur</label>
                <input type='number' id='editSDC' name='SDC' class='formbold-form-input' />
              </div>
              <div>
                <label class='formbold-form-label'>date</label>
                <input type='date' id='editDateDisplay' name='date_display' class='formbold-form-input' readonly />
              </div>
            </div>

            <div>
              <label class='formbold-form-label'>which vehicle</label>
              <select id='editSLT' name='SLT' class='formbold-form-input'>
                <option value='GCB'>GCB</option>
                <option value='CATS'>CATS</option>
                <option value='SEMU'>SEMU</option>
              </select>
            </div>

            <div>
              <label class='formbold-form-label'>autre</label>
              <textarea id='editAutre' name='autre' rows='4' class='formbold-form-input'></textarea>
            </div>

            <div class='edit-form-actions'>
              <button type='submit' class='formbold-btn'>Save</button>
              <button type='button' class='formbold-btn btn-cancel' onclick='closeEditForm()'>Cancel</button>
            </div>
          </form>
        </div>
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

        // Edit form logic
        function closeEditForm() {
            document.getElementById('editFormOverlay').style.display = 'none';
        }

        document.getElementById('editFormOverlay').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditForm();
            }
        });

        document.querySelectorAll('.btn-edit').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const date = this.dataset.date;
                const tdj = this.dataset.tdj;
                const s = this.dataset.s;
                const m = this.dataset.m;
                const t = this.dataset.t;
                const sdc = this.dataset.sdc;
                const slt = this.dataset.slt;
                const autre = this.dataset.autre;

                document.getElementById('editDate').value = date;
                document.getElementById('editDateDisplay').value = date;
                document.getElementById('editTDJ').value = tdj;
                document.getElementById('editS').value = s;
                document.getElementById('editM').value = m;
                document.getElementById('editT').value = t;
                document.getElementById('editSDC').value = sdc;
                document.getElementById('editSLT').value = slt;
                document.getElementById('editAutre').value = autre;

                document.getElementById('editFormOverlay').style.display = 'flex';
            });
        });
    </script>
</body>
</html>