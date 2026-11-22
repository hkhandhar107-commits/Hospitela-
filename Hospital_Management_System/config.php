<?php
session_start();

$host = 'localhost';
$dbname = 'hospital_db';
$username = 'root';
$password = ''; // XAMPP ma default MySQL password blank hoy chhe.

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch (PDOException $e) {
    die('Database connection failed. Check config.php and import database.sql in phpMyAdmin. Details: ' .
        htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8'));
}

function e($value) {
    return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8');
}

function require_login() {
    if (empty($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
}
?>