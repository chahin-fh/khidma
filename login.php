<?php
require_once 'config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if ($username === '' || $password === '') {
        $error = 'Please enter username and password.';
    } else {
        if (hash_equals($SINGLE_USER_USERNAME, $username) && hash_equals($SINGLE_USER_PASSWORD, $password)) {
            $_SESSION['user_id'] = 1;
            $_SESSION['username'] = $username;

            $redirect = !empty($_SESSION['redirect_after_login']) ? $_SESSION['redirect_after_login'] : 'index.php';
            unset($_SESSION['redirect_after_login']);

            header('Location: ' . $redirect);
            exit;
        }

        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>Login</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
</head>
<body>
  <div class="app-shell">
    <header class="app-header">
      <div class="app-title">Daily Work</div>
      <nav class="app-nav"></nav>
    </header>

    <div class="formbold-main-wrapper">
      <div class="formbold-form-wrapper">
        <form method="POST" action="login.php">
          <div class="page-title">Login</div>
          <div class="page-subtitle">Enter your credentials to access the app.</div>

          <?php if ($error !== '') { ?>
            <div class="alert-error"><?php echo htmlspecialchars($error); ?></div>
          <?php } ?>

          <div style="margin-bottom: 15px;">
            <label class="formbold-form-label" for="username">Username</label>
            <input class="formbold-form-input" type="text" id="username" name="username" autocomplete="username" />
          </div>

          <div style="margin-bottom: 15px;">
            <label class="formbold-form-label" for="password">Password</label>
            <input class="formbold-form-input" type="password" id="password" name="password" autocomplete="current-password" />
          </div>

          <button class="formbold-btn" type="submit">Login</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
