<?php

include "db.php";

$id = $_GET['id'];

$stm = $connection->prepare("SELECT * FROM users WHERE id=?");

$stm->execute([$id]);

$user = $stm->fetch(PDO::FETCH_ASSOC);

$image = !empty($user['image']) ? $user['image'] : "uploads/default.png";

?>

<!DOCTYPE html>
<html>
<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card p-4 shadow text-center">

<h4 class="mb-4">User Details</h4>

<img src="<?= $image ?>" width="120" height="120"
style="object-fit:cover;border-radius:50%;margin-bottom:20px;">

<p><b>Name:</b> <?= $user['fname'] . " " . $user['lname']; ?></p>

<p><b>Email:</b> <?= $user['email']; ?></p>

<p><b>Address:</b> <?= $user['address']; ?></p>

<p><b>Country:</b> <?= $user['country']; ?></p>

<p><b>Gender:</b> <?= $user['gender']; ?></p>

<p><b>Skills:</b> <?= $user['skills']; ?></p>

<p><b>Username:</b> <?= $user['username']; ?></p>

<p><b>Department:</b> <?= $user['department']; ?></p>

<a href="users.php" class="btn btn-secondary mt-3">Back</a>

</div>

</div>

</body>
</html>