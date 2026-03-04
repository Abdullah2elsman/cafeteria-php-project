<?php

require("auth/auth.php");
include "db.php";

$errors = [];

// Get Form Data

$fname = $_POST['fname'] ?? "";
$lname = $_POST['lname'] ?? "";
$email = $_POST['email'] ?? "";
$address = $_POST['address'] ?? "";
$country = $_POST['country'] ?? "";
$gender = $_POST['gender'] ?? "";
$username = $_POST['username'] ?? "";
$password = $_POST['password'] ?? "";
$department = $_POST['department'] ?? "";
$skills = isset($_POST['skills']) ? implode("|", $_POST['skills']) : "";


// Validation

// required fields
if(empty($fname)) $errors[] = "First name is required";
if(empty($lname)) $errors[] = "Last name is required";
if(empty($address)) $errors[] = "Address is required";
if(empty($country)) $errors[] = "Country is required";
if(empty($gender)) $errors[] = "Gender is required";
if(empty($username)) $errors[] = "Username is required";
if(empty($password)) $errors[] = "Password is required";

// name validation
if(!preg_match("/^[a-zA-Z]+$/",$fname)){
$errors[] = "First name must contain letters only";
}

if(!preg_match("/^[a-zA-Z]+$/",$lname)){
$errors[] = "Last name must contain letters only";
}

// skills validation
if(!isset($_POST['skills'])){
$errors[] = "Please select at least one skill";
}

// password validation
if(!preg_match("/^[a-z0-9_]{8}$/",$password)){
$errors[] = "Password must be 8 characters (lowercase, numbers, underscore only)";
}



// Image Upload

$imagePath = "uploads/default.png";

if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){

$allowed = ['jpg','jpeg','png'];

$imgName = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];
$size = $_FILES['image']['size'];

$ext = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));

if(!in_array($ext,$allowed)){
$errors[] = "Only JPG and PNG images allowed";
}

if($size > 2000000){
$errors[] = "Image must be less than 2MB";
}

// upload only if no errors
if(empty($errors)){

$newName = time().".".$ext;
$path = "uploads/".$newName;

move_uploaded_file($tmp,$path);

$imagePath = $path;

}

}

// If Errors

if(!empty($errors)){

foreach($errors as $error){
echo "<p style='color:red'>$error</p>";
}

echo "<a href='registration.php'>Go Back</a>";
exit;

}


// Insert Data

$stm = $connection->prepare(
"INSERT INTO users 
(fname,lname,email,address,country,gender,skills,username,password,department,image)
VALUES (?,?,?,?,?,?,?,?,?,?,?)"
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
$department,
$imagePath
]);

header("Location: users.php");

?>