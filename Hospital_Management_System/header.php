<?php require_once __DIR__ . '/config.php'; require_login(); ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($page_title ?? 'Hospital Management System') ?></title>
<link rel="stylesheet" href="style.css">
<script src="app.js" defer></script>
</head>
<body>
<header class="topbar">
  <a class="brand" href="index.php" style="color:white">✚ CarePoint Hospital</a>
  <nav class="nav">
    <a href="index.php">Dashboard</a><a href="patients.php">Patients</a><a href="doctors.php">Doctors</a>
    <a href="appointments.php">Appointments</a><a href="billing.php">Billing</a><a href="reports.php">Reports</a><a href="logout.php">Logout</a>
  </nav>
</header>
<main class="container">
