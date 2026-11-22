<?php
require_once 'config.php';
$error = ''; $success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? ''); $email = trim($_POST['email'] ?? ''); $password = $_POST['password'] ?? '';
  if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6) {
    $error = 'Enter a name, valid email, and password with at least 6 characters.';
  } else {
    try {
      $stmt = $pdo->prepare('INSERT INTO users (name,email,password) VALUES (?,?,?)');
      $stmt->execute([$name,$email,password_hash($password,PASSWORD_DEFAULT)]);
      $success = true;
    } catch (PDOException $e) { $error = 'This email may already be registered.'; }
  }
}
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Create account</title><link rel="stylesheet" href="style.css"></head>
<body class="auth-wrap"><div class="auth-card"><h1>Create Account</h1>
<?php if ($success): ?><div class="alert">Account created. <a href="login.php">Login now</a>.</div><?php endif; ?>
<?php if ($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?>
<form method="post"><label>Full name</label><input name="name" required value="<?= e($_POST['name'] ?? '') ?>"><label style="margin-top:14px">Email</label><input type="email" name="email" required value="<?= e($_POST['email'] ?? '') ?>"><label style="margin-top:14px">Password (minimum 6 characters)</label><input type="password" name="password" minlength="6" required><button class="btn">Register</button></form>
<p>Already registered? <a href="login.php">Login</a></p></div></body></html>