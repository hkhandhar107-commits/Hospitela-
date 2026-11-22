<?php
require_once 'config.php'; require_login();
$counts = [];
foreach (['patients','doctors','appointments','bills'] as $table) {
    $counts[$table] = (int)$pdo->query("SELECT COUNT(*) FROM `$table`")->fetchColumn();
}
$recent = $pdo->query("SELECT a.id,a.appointment_date,a.appointment_time,a.status,p.name AS patient_name,d.name AS doctor_name
 FROM appointments a JOIN patients p ON p.id=a.patient_id JOIN doctors d ON d.id=a.doctor_id
 ORDER BY a.appointment_date DESC,a.appointment_time DESC LIMIT 6")->fetchAll();
include 'header.php';
?>
<section class="welcome"><div><p class="eyebrow">OVERVIEW</p><h1>Welcome back, <?= e($_SESSION['user_name']) ?> 👋</h1><p class="muted">Here is what is happening at your hospital today.</p></div><a class="btn primary" href="appointments.php">＋ New appointment</a></section>
<div class="stats-grid">
<a class="stat-card" href="patients.php"><span class="stat-icon blue">♙</span><span class="stat-label">Total Patients</span><strong><?= $counts['patients'] ?></strong><span class="stat-foot">Manage patient records →</span></a>
<a class="stat-card" href="doctors.php"><span class="stat-icon green">✚</span><span class="stat-label">Doctors</span><strong><?= $counts['doctors'] ?></strong><span class="stat-foot">View medical team →</span></a>
<a class="stat-card" href="appointments.php"><span class="stat-icon orange">▦</span><span class="stat-label">Appointments</span><strong><?= $counts['appointments'] ?></strong><span class="stat-foot">View schedules →</span></a>
<a class="stat-card" href="billing.php"><span class="stat-icon purple">₹</span><span class="stat-label">Bills</span><strong><?= $counts['bills'] ?></strong><span class="stat-foot">Manage billing →</span></a>
</div>
<section class="panel"><div class="panel-heading"><div><h2>Recent appointments</h2><p class="muted">Latest scheduled visits</p></div><a class="text-link" href="appointments.php">View all</a></div>
<?php if (!$recent): ?><p class="empty">No appointments yet. Add patients and doctors, then book an appointment.</p><?php else: ?>
<div class="table-wrap"><table><thead><tr><th>Patient</th><th>Doctor</th><th>Date</th><th>Time</th><th>Status</th></tr></thead><tbody>
<?php foreach ($recent as $r): ?><tr><td><?= e($r['patient_name']) ?></td><td><?= e($r['doctor_name']) ?></td><td><?= e($r['appointment_date']) ?></td><td><?= e(substr($r['appointment_time'],0,5)) ?></td><td><span class="pill <?= strtolower($r['status']) ?>"><?= e($r['status']) ?></span></td></tr><?php endforeach; ?>
</tbody></table></div><?php endif; ?></section>
<?php include 'footer.php'; ?>
