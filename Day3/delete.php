<?php

require("auth/auth.php");

include "db.php";
$db = new Database();
$connection = $db->connect();   

$id = $_GET['id'];

$stm = $connection->prepare("DELETE FROM users WHERE id=?");

$stm->execute([$id]);

header("Location: users.php");

?>