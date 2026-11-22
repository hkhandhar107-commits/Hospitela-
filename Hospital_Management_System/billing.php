<?php
require_once 'config.php'; require_login(); $page_title='Billing'; $message='';
if($_SERVER['REQUEST_METHOD']==='POST' && ($_POST['action']??'')==='add') {
 $patient=(int)($_POST['patient_id']??0); $desc=trim($_POST['description']??''); $amount=(float)($_POST['amount']??0); $date=$_POST['bill_date']??date('Y-m-d');
 if(!$patient||$desc===''||$amount<0||!$date) $message='Please enter valid bill details.';
 else { $st=$pdo->prepare('INSERT INTO bills(patient_id,description,amount,bill_date) VALUES(?,?,?,?)'); $st->execute([$patient,$desc,$amount,$date]); $message='Bill created.'; }
}
if(isset($_GET['paid'])) { $st=$pdo->prepare("UPDATE bills SET status='Paid' WHERE id=?"); $st->execute([(int)$_GET['paid']]); header('Location: billing.php'); exit; }
$patients=$pdo->query('SELECT id,full_name FROM patients ORDER BY full_name')->fetchAll();
$bills=$pdo->query('SELECT b.*,p.full_name patient_name FROM bills b JOIN patients p ON p.id=b.patient_id ORDER BY b.id DESC')->fetchAll(); require 'header.php';
?>
<h1>Billing Management</h1><?php if($message): ?><div class="alert"><?= e($message) ?></div><?php endif; ?>
<section class="panel"><h2>Create Bill</h2><form method="post"><input type="hidden" name="action" value="add"><div class="form-grid"><div><label>Patient *</label><select name="patient_id" required><option value="">Select patient</option><?php foreach($patients as $p): ?><option value="<?= $p['id'] ?>"><?= e($p['full_name']) ?></option><?php endforeach; ?></select></div><div><label>Description *</label><input name="description" required placeholder="Consultation, test, etc."></div><div><label>Amount (₹) *</label><input type="number" name="amount" min="0" step="0.01" required></div><div><label>Bill date *</label><input type="date" name="bill_date" value="<?= date('Y-m-d') ?>" required></div></div><button class="btn">Create Bill</button></form></section>
<section class="panel"><h2>Bill List</h2><table><thead><tr><th>Bill ID</th><th>Patient</th><th>Description</th><th>Amount</th><th>Date</th><th>Status</th><th>Action</th></tr></thead><tbody><?php foreach($bills as $b): ?><tr><td><?= $b['id'] ?></td><td><?= e($b['patient_name']) ?></td><td><?= e($b['description']) ?></td><td>₹<?= number_format((float)$b['amount'],2) ?></td><td><?= e($b['bill_date']) ?></td><td><?= e($b['status']) ?></td><td><?php if($b['status']==='Unpaid'): ?><a href="billing.php?paid=<?= $b['id'] ?>">Mark Paid</a><?php else: ?>—<?php endif; ?></td></tr><?php endforeach; ?></tbody></table></section>
<?php require 'footer.php'; ?>