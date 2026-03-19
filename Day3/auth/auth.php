<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: /Day3/login.php");
    exit();
}
?>