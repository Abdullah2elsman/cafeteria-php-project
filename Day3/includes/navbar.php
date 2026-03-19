<?php
session_start();
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">

<a class="navbar-brand" href="users.php">PHP Lab</a>

<div class="collapse navbar-collapse justify-content-end">

<span class="navbar-text text-white me-3">

Welcome <?= $_SESSION['username'] ?>

</span>

<a href="auth/logout.php" class="btn btn-danger btn-sm">
Logout
</a>

</div>

</div>
</nav>