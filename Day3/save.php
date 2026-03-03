<?php

include "db.php";

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$address = $_POST['address'];
$country = $_POST['country'];
$gender = $_POST['gender'];
$skills = isset($_POST['skills']) ? implode("|", $_POST['skills']) : "";
$username = $_POST['username'];
$password = $_POST['password'];
$department = $_POST['department'];

$stm = $connection->prepare(
"INSERT INTO users 
(fname,lname,email,address,country,gender,skills,username,password,department)
VALUES (?,?,?,?,?,?,?,?,?,?)"
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
$password,
$department
]);

header("Location: users.php");

?>