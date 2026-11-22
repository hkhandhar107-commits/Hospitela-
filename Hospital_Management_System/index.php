<?php
require_once 'config.php';
if (empty($_SESSION['user_id'])) { header('Location: login.php'); exit; }
$page_title = 'Dashboard';
$patientCount = (int)$pdo->query('SELECT COUNT(*) FROM patients')->fetchColumn();
$doctorCount = (int)$pdo->query('SELECT COUNT(*) FROM doctors')->fetchColumn();
$appointmentCount = (int)$pdo->query('SELECT COUNT(*) FROM appointments')->fetchColumn();
$billTotal = (float)$pdo->query("SELECT COALESCE(SUM(amount),0) FROM bills")->fetchColumn();
require 'header.php';
?>
<section class="welcome"><h1>Welcome, <?= e($_SESSION['user_name'] ?? 'User') ?>!</h1><p>Hospital Management System dashboard. Manage patients, doctors, appointments and billing from one place.</p></section>
<div class="cards">
 <div class="card"><h3>Total Patients</h3><div class="number"><?= $patientCount ?></div><a href="patients.php">Manage patients →</a></div>
 <div class="card"><h3>Total Doctors</h3><div class="number"><?= $doctorCount ?></div><a href="doctors.php">Manage doctors →</a></div>
 <div class="card"><h3>Appointments</h3><div class="number"><?= $appointmentCount ?></div><a href="appointments.php">View appointments →</a></div>
 <div class="card"><h3>Total Billed</h3><div class="number">₹<?= number_format($billTotal,2) ?></div><a href="billing.php">Manage bills →</a></div>
</div>
<section class="panel"><h2>Quick actions</h2><div class="actions"><a class="btn" href="patients.php">+ Register Patient</a><a class="btn" href="doctors.php">+ Add Doctor</a><a class="btn" href="appointments.php">+ Book Appointment</a><a class="btn" href="billing.php">+ Create Bill</a></div></section>
<?php require 'footer.php'; ?>