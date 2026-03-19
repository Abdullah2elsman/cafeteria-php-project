<?php

session_start();

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit;
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Home</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow p-4">

<h3 class="mb-3">Welcome <?= $_SESSION['username']; ?></h3>

<p>You are successfully logged in.</p>

<a href="users.php" class="btn btn-primary">Users List</a>

<a href="auth/logout.php" class="btn btn-danger">Logout</a>

</div>

</div>

</body>
</html>