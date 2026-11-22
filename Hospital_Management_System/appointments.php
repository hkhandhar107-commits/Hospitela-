<?php
require_once 'config.php'; require_login(); $page_title='Appointments'; $message='';
if($_SERVER['REQUEST_METHOD']==='POST' && ($_POST['action']??'')==='add') {
 $patient=(int)($_POST['patient_id']??0); $doctor=(int)($_POST['doctor_id']??0); $date=$_POST['appointment_date']??''; $time=$_POST['appointment_time']??'';
 if(!$patient||!$doctor||!$date||!$time) $message='Please complete all required fields.';
 else { $st=$pdo->prepare('INSERT INTO appointments(patient_id,doctor_id,appointment_date,appointment_time,reason) VALUES(?,?,?,?,?)'); $st->execute([$patient,$doctor,$date,$time,trim($_POST['reason']??'')]); $message='Appointment booked.'; }
}
if(isset($_GET['status'],$_GET['id']) && in_array($_GET['status'],['Scheduled','Completed','Cancelled'],true)) { $st=$pdo->prepare('UPDATE appointments SET status=? WHERE id=?'); $st->execute([$_GET['status'],(int)$_GET['id']]); header('Location: appointments.php'); exit; }
$patients=$pdo->query('SELECT id,full_name FROM patients ORDER BY full_name')->fetchAll(); $doctors=$pdo->query('SELECT id,full_name,specialization FROM doctors ORDER BY full_name')->fetchAll();
$rows=$pdo->query('SELECT a.*,p.full_name patient_name,d.full_name doctor_name FROM appointments a JOIN patients p ON p.id=a.patient_id JOIN doctors d ON d.id=a.doctor_id ORDER BY a.appointment_date DESC,a.appointment_time DESC')->fetchAll(); require 'header.php';
?>
<h1>Appointments</h1><?php if($message): ?><div class="alert"><?= e($message) ?></div><?php endif; ?>
<section class="panel"><h2>Book Appointment</h2><?php if(!$patients||!$doctors): ?><p>Add at least one patient and one doctor before booking.</p><?php endif; ?>
<form method="post"><input type="hidden" name="action" value="add"><div class="form-grid"><div><label>Patient *</label><select name="patient_id" required><option value="">Select patient</option><?php foreach($patients as $p): ?><option value="<?= $p['id'] ?>"><?= e($p['full_name']) ?></option><?php endforeach; ?></select></div>
<div><label>Doctor *</label><select name="doctor_id" required><option value="">Select doctor</option><?php foreach($doctors as $d): ?><option value="<?= $d['id'] ?>"><?= e($d['full_name']) ?> — <?= e($d['specialization']) ?></option><?php endforeach; ?></select></div>
<div><label>Date *</label><input type="date" name="appointment_date" min="<?= date('Y-m-d') ?>" required></div><div><label>Time *</label><input type="time" name="appointment_time" required></div><div><label>Reason</label><input name="reason" placeholder="Reason for visit"></div></div><button class="btn">Book Appointment</button></form></section>
<section class="panel"><h2>Appointment List</h2><table><thead><tr><th>ID</th><th>Patient</th><th>Doctor</th><th>Date</th><th>Time</th><th>Reason</th><th>Status</th><th>Update</th></tr></thead><tbody><?php foreach($rows as $a): ?><tr><td><?= $a['id'] ?></td><td><?= e($a['patient_name']) ?></td><td><?= e($a['doctor_name']) ?></td><td><?= e($a['appointment_date']) ?></td><td><?= e(substr($a['appointment_time'],0,5)) ?></td><td><?= e($a['reason']) ?></td><td><span class="pill"><?= e($a['status']) ?></span></td><td><div class="actions"><?php foreach(['Scheduled','Completed','Cancelled'] as $s): ?><a href="appointments.php?id=<?= $a['id'] ?>&status=<?= $s ?>"><?= $s ?></a><?php endforeach; ?></div></td></tr><?php endforeach; ?></tbody></table></section>
<?php require 'footer.php'; ?>