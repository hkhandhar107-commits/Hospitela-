<?php
require_once 'config.php'; require_login(); $page_title='Doctors'; $message='';
if($_SERVER['REQUEST_METHOD']==='POST') {
 $name=trim($_POST['full_name']??''); $spec=trim($_POST['specialization']??''); $phone=trim($_POST['phone']??''); $email=trim($_POST['email']??'');
 if($name===''||$spec===''||$phone==='') $message='Name, specialization and phone are required.';
 else { $st=$pdo->prepare('INSERT INTO doctors(full_name,specialization,phone,email) VALUES(?,?,?,?)'); $st->execute([$name,$spec,$phone,$email]); $message='Doctor added successfully.'; }
}
if(isset($_GET['delete'])) { $st=$pdo->prepare('DELETE FROM doctors WHERE id=?'); $st->execute([(int)$_GET['delete']]); header('Location: doctors.php'); exit; }
$doctors=$pdo->query('SELECT * FROM doctors ORDER BY id DESC')->fetchAll(); require 'header.php';
?>
<h1>Doctor Management</h1><?php if($message): ?><div class="alert"><?= e($message) ?></div><?php endif; ?>
<section class="panel"><h2>Add Doctor</h2><form method="post"><div class="form-grid"><div><label>Full name *</label><input name="full_name" required></div><div><label>Specialization *</label><input name="specialization" required placeholder="e.g. Cardiology"></div><div><label>Phone *</label><input name="phone" required></div><div><label>Email</label><input type="email" name="email"></div></div><button class="btn">Save Doctor</button></form></section>
<section class="panel"><h2>Doctor List</h2><input data-table-search placeholder="Search doctors..." style="max-width:350px;margin-bottom:12px"><table data-search-table><thead><tr><th>ID</th><th>Name</th><th>Specialization</th><th>Phone</th><th>Email</th><th>Action</th></tr></thead><tbody><?php foreach($doctors as $d): ?><tr><td><?= $d['id'] ?></td><td><?= e($d['full_name']) ?></td><td><?= e($d['specialization']) ?></td><td><?= e($d['phone']) ?></td><td><?= e($d['email']) ?></td><td><a data-confirm="Delete this doctor? Related appointments will also be deleted." href="doctors.php?delete=<?= $d['id'] ?>">Delete</a></td></tr><?php endforeach; ?></tbody></table></section>
<?php require 'footer.php'; ?>