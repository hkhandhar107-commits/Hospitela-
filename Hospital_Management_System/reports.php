<?php
require_once 'config.php'; require_login(); $page_title='Reports';
$patientCount=(int)$pdo->query('SELECT COUNT(*) FROM patients')->fetchColumn();
$doctorCount=(int)$pdo->query('SELECT COUNT(*) FROM doctors')->fetchColumn();
$appointmentCount=(int)$pdo->query('SELECT COUNT(*) FROM appointments')->fetchColumn();
$scheduled=(int)$pdo->query("SELECT COUNT(*) FROM appointments WHERE status='Scheduled'")->fetchColumn();
$completed=(int)$pdo->query("SELECT COUNT(*) FROM appointments WHERE status='Completed'")->fetchColumn();
$cancelled=(int)$pdo->query("SELECT COUNT(*) FROM appointments WHERE status='Cancelled'")->fetchColumn();
$paid=(float)$pdo->query("SELECT COALESCE(SUM(amount),0) FROM bills WHERE status='Paid'")->fetchColumn();
$unpaid=(float)$pdo->query("SELECT COALESCE(SUM(amount),0) FROM bills WHERE status='Unpaid'")->fetchColumn();
require 'header.php';
?>
<h1>Reports</h1><div class="cards">
<div class="card"><h3>Total Patients</h3><div class="number"><?= $patientCount ?></div></div><div class="card"><h3>Total Doctors</h3><div class="number"><?= $doctorCount ?></div></div><div class="card"><h3>Total Appointments</h3><div class="number"><?= $appointmentCount ?></div></div><div class="card"><h3>Scheduled</h3><div class="number"><?= $scheduled ?></div></div><div class="card"><h3>Completed</h3><div class="number"><?= $completed ?></div></div><div class="card"><h3>Cancelled</h3><div class="number"><?= $cancelled ?></div></div><div class="card"><h3>Paid Amount</h3><div class="number">₹<?= number_format($paid,2) ?></div></div><div class="card"><h3>Unpaid Amount</h3><div class="number">₹<?= number_format($unpaid,2) ?></div></div></div>
<section class="panel"><h2>Report summary</h2><p>This page calculates counts and billing totals directly from the MySQL database.</p><button class="btn" onclick="window.print()">Print Report</button></section>
<?php require 'footer.php'; ?>