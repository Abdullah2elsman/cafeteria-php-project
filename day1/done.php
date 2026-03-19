<?php

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$address = $_POST['address'];
$country = $_POST['country'];
$gender = $_POST['gender'];
$skills = $_POST['skills'];
$username = $_POST['username'];
$department = $_POST['department'];

?>

<!DOCTYPE html>
<html>
<head>
<title>Review</title>
</head>

<body>

<h2>Thanks <?php echo $fname . " " . $lname; ?></h2>

<h3>Please Review Your Information</h3>

Name: <?php echo $fname . " " . $lname; ?> <br><br>

Address: <?php echo $address; ?> <br><br>

Country: <?php echo $country; ?> <br><br>

Gender: <?php echo $gender; ?> <br><br>

Skills:
<?php
foreach($skills as $skill){
echo $skill . " ";
}
?>

<br><br>

Department: <?php echo $department; ?>

</body>
</html>