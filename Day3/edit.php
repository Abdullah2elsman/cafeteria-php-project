<?php

require("auth/auth.php");

include "db.php";

$id = $_GET['id'];

$stm = $connection->prepare("SELECT * FROM users WHERE id=?");
$stm->execute([$id]);

$user = $stm->fetch(PDO::FETCH_ASSOC);

$skills = explode("|", $user['skills']);

?>

<!DOCTYPE html>
<html>
<head>

<title>Edit User</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow p-4">

<h3 class="mb-4 text-center">Edit User</h3>

<form action="update.php" method="POST">

<input type="hidden" name="id" value="<?= $user['id']; ?>">

<div class="row">

<div class="col-md-6 mb-3">
<label class="form-label">First Name</label>
<input type="text" name="fname" class="form-control" value="<?= $user['fname']; ?>">
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Last Name</label>
<input type="text" name="lname" class="form-control" value="<?= $user['lname']; ?>">
</div>

</div>

<div class="mb-3">
<label class="form-label">Email</label>
<input type="email" name="email" class="form-control" value="<?= $user['email']; ?>">
</div>

<div class="mb-3">
<label class="form-label">Address</label>
<textarea name="address" class="form-control"><?= $user['address']; ?></textarea>
</div>

<div class="mb-3">
<label class="form-label">Country</label>

<select name="country" class="form-select">

<option <?= $user['country']=="Egypt" ? "selected" : "" ?>>Egypt</option>
<option <?= $user['country']=="USA" ? "selected" : "" ?>>USA</option>
<option <?= $user['country']=="Germany" ? "selected" : "" ?>>Germany</option>

</select>

</div>

<div class="mb-3">

<label class="form-label">Gender</label><br>

<div class="form-check form-check-inline">

<input class="form-check-input" type="radio" name="gender" value="Male"
<?= $user['gender']=="Male" ? "checked" : "" ?>>

<label class="form-check-label">Male</label>

</div>

<div class="form-check form-check-inline">

<input class="form-check-input" type="radio" name="gender" value="Female"
<?= $user['gender']=="Female" ? "checked" : "" ?>>

<label class="form-check-label">Female</label>

</div>

</div>

<div class="mb-3">

<label class="form-label">Skills</label><br>

<div class="form-check form-check-inline">

<input class="form-check-input" type="checkbox" name="skills[]" value="PHP"
<?= in_array("PHP",$skills) ? "checked" : "" ?>>

<label class="form-check-label">PHP</label>

</div>

<div class="form-check form-check-inline">

<input class="form-check-input" type="checkbox" name="skills[]" value="MySQL"
<?= in_array("MySQL",$skills) ? "checked" : "" ?>>

<label class="form-check-label">MySQL</label>

</div>

<div class="form-check form-check-inline">

<input class="form-check-input" type="checkbox" name="skills[]" value="J2SE"
<?= in_array("J2SE",$skills) ? "checked" : "" ?>>

<label class="form-check-label">J2SE</label>

</div>

</div>

<div class="mb-3">
<label class="form-label">Username</label>
<input type="text" name="username" class="form-control" value="<?= $user['username']; ?>">
</div>

<div class="mb-3">
<label class="form-label">Department</label>
<input type="text" name="department" class="form-control" value="<?= $user['department']; ?>">
</div>

<div class="text-center">

<button class="btn btn-success px-4">Update</button>

<a href="users.php" class="btn btn-secondary px-4">Cancel</a>

</div>

</form>

</div>

</div>

</body>
</html>