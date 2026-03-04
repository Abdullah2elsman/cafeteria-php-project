<?php

session_start();

include "../db.php";

$username = $_POST['username'] ?? "";
$password = $_POST['password'] ?? "";

$stm = $connection->prepare("SELECT * FROM users WHERE username=? AND password=?");

$stm->execute([$username,$password]);

$user = $stm->fetch(PDO::FETCH_ASSOC);

if($user){

$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];

header("Location: ../home.php");

}else{

header("Location: ../login.php?error=1");

}

?>