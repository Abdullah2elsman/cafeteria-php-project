<!DOCTYPE html>
<html>
<head>
<title>Registration</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow p-4">

<h3 class="mb-4 text-center">Registration Form</h3>

<form action="save.php" method="POST" enctype="multipart/form-data">

<div class="row">

<div class="col-md-6 mb-3">
<label>First Name</label>
<input type="text" name="fname" class="form-control" required>
<div class="text-danger" id="fnameError"></div>
</div>

<div class="col-md-6 mb-3">
<label>Last Name</label>
<input type="text" name="lname" class="form-control" required>
<div class="text-danger" id="lnameError"></div>
</div>

</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Address</label>
<textarea name="address" class="form-control" required></textarea>
</div>

<div class="mb-3">
<label>Country</label>
<select name="country" class="form-select">
<option value="">Select Country</option>
<option>Egypt</option>
<option>USA</option>
<option>Germany</option>
</select>
</div>

<div class="mb-3">
<label>Gender</label><br>

<input type="radio" name="gender" value="Male" required> Male
<input type="radio" name="gender" value="Female"> Female

</div>

<div class="mb-3">

<label>Skills</label><br>

<input type="checkbox" name="skills[]" value="PHP"> PHP
<input type="checkbox" name="skills[]" value="MySQL"> MySQL
<input type="checkbox" name="skills[]" value="J2SE"> J2SE

</div>

<div class="mb-3">
<label>Username</label>
<input type="text" name="username" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
<div class="text-danger" id="passwordError"></div>
</div>

<div class="mb-3">
<label>Department</label>
<input type="text" name="department" class="form-control" value="OpenSource">
</div>

<div class="mb-3">
<label>Profile Picture</label>
<input type="file" name="image" class="form-control">
</div>

<button class="btn btn-primary">Submit</button>

<a href="users.php" class="btn btn-dark">View Users</a>

</form>

</div>

</div>

</body>
</html>