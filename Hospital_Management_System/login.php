<?php
require_once 'config.php';
if (!empty($_SESSION['user_id'])) { header('Location: index.php'); exit; }
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email'] ?? '');
  $pass = $_POST['password'] ?? '';
  $stmt = $pdo->prepare('SELECT id,name,email,password FROM users WHERE email=?');
  $stmt->execute([$email]); $user = $stmt->fetch();
  if ($user && (password_verify($pass, $user['password']) || hash_equals((string)$user['password'], (string)$pass))) {
    session_regenerate_id(true); $_SESSION['user_id'] = $user['id']; $_SESSION['user_name'] = $user['name'];
    header('Location: index.php'); exit;
  }
  $error = 'Invalid email or password.';
}
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Login | CarePoint</title><link rel="stylesheet" href="style.css"></head>
<body class="auth-wrap"><div class="auth-card"><h1>✚ CarePoint</h1><h2>Login</h2><p class="muted">Sign in to manage hospital records.</p>
<?php if ($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?>
<form method="post"><label>Email</label><input type="email" name="email" required value="<?= e($_POST['email'] ?? '') ?>"><label style="margin-top:14px">Password</label><input type="password" name="password" required>
<button class="btn" type="submit">Login</button></form>
<p class="muted">Demo: admin@hospital.com / password</p><p>New user? <a href="register.php">Create account</a></p><p><a href="index.php">Home</a></p></div></body></html>