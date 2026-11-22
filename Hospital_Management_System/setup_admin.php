<?php
require_once 'config.php';
$email = 'admin@hospital.com';
$name = 'Hospital Admin';
$plainPassword = 'Admin@123';
$stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
$stmt->execute([$email]);
if ($stmt->fetch()) {
    echo 'Admin already exists. You can log in using admin@hospital.com and the password you previously set. Delete setup_admin.php now.';
    exit;
}
$stmt = $pdo->prepare('INSERT INTO users (name,email,password,role) VALUES (?,?,?,?)');
$stmt->execute([$name, $email, password_hash($plainPassword, PASSWORD_DEFAULT), 'admin']);
echo 'Admin created. Email: admin@hospital.com | Password: Admin@123. IMPORTANT: delete setup_admin.php after setup and change the password.';
