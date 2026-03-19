<!DOCTYPE html>
<html>
<head>
<title>Registration</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow p-4">

<h2 class="text-center mb-4">Registration Form</h2>

<form action="done.php" method="POST">

<div class="row">

<div class="col-md-6 mb-3">
<label class="form-label">First Name</label>
<input type="text" name="fname" class="form-control" required pattern="[A-Za-z]+">
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Last Name</label>
<input type="text" name="lname" class="form-control" required pattern="[A-Za-z]+">
</div>

</div>

<div class="mb-3">
<label class="form-label">Address</label>
<textarea name="address" class="form-control" required></textarea>
</div>

<div class="mb-3">
<label class="form-label">Country</label>
<select name="country" class="form-select" required>
<option value="">Select Country</option>
<option value="Egypt">Egypt</option>
<option value="USA">USA</option>
<option value="Germany">Germany</option>
</select>
</div>

<div class="mb-3">
<label class="form-label">Gender</label><br>

<input type="radio" name="gender" value="Male" required> Male
<input type="radio" name="gender" value="Female"> Female

</div>

<div class="mb-3">
<label class="form-label">Skills</label><br>

<input type="checkbox" name="skills[]" value="PHP"> PHP
<input type="checkbox" name="skills[]" value="MySQL"> MySQL
<input type="checkbox" name="skills[]" value="J2SE"> J2SE
<input type="checkbox" name="skills[]" value="PostgreSQL"> PostgreSQL

</div>

<div class="mb-3">
<label class="form-label">Username</label>
<input type="text" name="username" class="form-control" required minlength="4">
</div>

<div class="mb-3">
<label class="form-label">Password</label>
<input type="password" name="password" class="form-control" required minlength="6">
</div>

<div class="mb-3">
<label class="form-label">Department</label>
<input type="text" name="department" class="form-control" value="OpenSource" readonly>
</div>

<div class="text-center">

<button type="submit" class="btn btn-primary px-4">Submit</button>
<button type="reset" class="btn btn-secondary px-4">Reset</button>

</div>

</form>

</div>

</div>

</body>
</html>
