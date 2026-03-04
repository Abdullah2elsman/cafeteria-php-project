<?php

require("auth/auth.php");
include "db.php";

$result = $connection->query("SELECT * FROM users");

?>

<!DOCTYPE html>
<html>
<head>

<title>Users</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow p-4">

<div class="d-flex justify-content-between align-items-center mb-3">

<h3>Users List</h3>

<div>
Welcome <b><?= $_SESSION['username'] ?></b>

<a href="auth/logout.php" class="btn btn-danger btn-sm ms-2">Logout</a>
</div>

</div>

<table class="table table-bordered table-hover align-middle">

<thead class="table-dark">

<tr>
<th>ID</th>
<th>Image</th>
<th>Name</th>
<th>Country</th>
<th>Email</th>
<th>Actions</th>
</tr>

</thead>

<tbody>

<?php

while($row = $result->fetch(PDO::FETCH_ASSOC)){

$image = !empty($row['image']) ? $row['image'] : "uploads/default.png";

echo "<tr>";

echo "<td>{$row['id']}</td>";

echo "<td>
<img src='$image' width='60' height='60' style='object-fit:cover;border-radius:50%'>
</td>";

echo "<td>{$row['fname']} {$row['lname']}</td>";

echo "<td>{$row['country']}</td>";

echo "<td>{$row['email']}</td>";

echo "<td>

<a class='btn btn-info btn-sm' href='view.php?id={$row['id']}'>View</a>

<a class='btn btn-warning btn-sm' href='edit.php?id={$row['id']}'>Edit</a>

<a class='btn btn-danger btn-sm' href='delete.php?id={$row['id']}'>Delete</a>

</td>";

echo "</tr>";

}

?>

</tbody>

</table>

<a href="registration.php" class="btn btn-primary">Add User</a>

</div>

</div>

</body>
</html>