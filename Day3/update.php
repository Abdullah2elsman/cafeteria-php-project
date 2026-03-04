<?php

require("auth/auth.php");

include "db.php";

$id = $_POST['id'];

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$address = $_POST['address'];
$country = $_POST['country'];
$gender = $_POST['gender'];
$skills = isset($_POST['skills']) ? implode("|", $_POST['skills']) : "";
$username = $_POST['username'];
$department = $_POST['department'];

$stm = $connection->prepare(
"UPDATE users SET 
fname=?, 
lname=?, 
email=?, 
address=?, 
country=?, 
gender=?, 
skills=?, 
username=?, 
department=? 
WHERE id=?"
);

$stm->execute([
$fname,
$lname,
$email,
$address,
$country,
$gender,
$skills,
$username,
$department,
$id
]);

header("Location: users.php");

?>