<?php
require_once 'config.php'; require_login(); $page_title='Patients'; $message='';
if ($_SERVER['REQUEST_METHOD']==='POST' && ($_POST['action']??'')==='add') {
 $name=trim($_POST['full_name']??''); $gender=$_POST['gender']??''; $age=(int)($_POST['age']??0); $phone=trim($_POST['phone']??'');
 if($name==='' || !in_array($gender,['Male','Female','Other'],true) || $age<0 || $age>120 || $phone==='') $message='Please enter valid patient details.';
 else { $st=$pdo->prepare('INSERT INTO patients(full_name,gender,age,phone,email,address) VALUES(?,?,?,?,?,?)'); $st->execute([$name,$gender,$age,$phone,trim($_POST['email']??''),trim($_POST['address']??'')]); $message='Patient registered successfully.'; }
}
if(isset($_GET['delete'])) { $st=$pdo->prepare('DELETE FROM patients WHERE id=?'); $st->execute([(int)$_GET['delete']]); header('Location: patients.php'); exit; }
$patients=$pdo->query('SELECT * FROM patients ORDER BY id DESC')->fetchAll(); require 'header.php';
?>
<h1>Patient Management</h1><?php if($message): ?><div class="alert"><?= e($message) ?></div><?php endif; ?>
<section class="panel"><h2>Register Patient</h2><form method="post"><input type="hidden" name="action" value="add"><div class="form-grid">
<div><label>Full name *</label><input name="full_name" required></div><div><label>Gender *</label><select name="gender" required><option value="">Select</option><option>Male</option><option>Female</option><option>Other</option></select></div>
<div><label>Age *</label><input type="number" name="age" min="0" max="120" required></div><div><label>Phone *</label><input name="phone" required></div><div><label>Email</label><input type="email" name="email"></div><div><label>Address</label><textarea name="address"></textarea></div></div><button class="btn">Save Patient</button></form></section>
<section class="panel"><h2>Patient List (<?= count($patients) ?>)</h2><input data-table-search placeholder="Search patients..." style="max-width:350px;margin-bottom:12px"><table data-search-table><thead><tr><th>ID</th><th>Name</th><th>Gender</th><th>Age</th><th>Phone</th><th>Email</th><th>Action</th></tr></thead><tbody>
<?php foreach($patients as $p): ?><tr><td><?= $p['id'] ?></td><td><?= e($p['full_name']) ?></td><td><?= e($p['gender']) ?></td><td><?= $p['age'] ?></td><td><?= e($p['phone']) ?></td><td><?= e($p['email']) ?></td><td><a data-confirm="Delete this patient?" href="patients.php?delete=<?= $p['id'] ?>">Delete</a></td></tr><?php endforeach; ?>
</tbody></table></section><?php require 'footer.php'; ?>