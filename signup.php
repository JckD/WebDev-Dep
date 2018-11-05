<!DOCTYPE html>

<?php
	include("config.php");
	session_start();

	$errors = array();

	if(mysqli_connect_errno()){

		mysqli_connect_errno()."Failed to Connect.";
	}

	$username = mysqli_real_escape_string($db, $_POST['username']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password1 = mysqli_real_escape_string($db, $_POST['password1']);
	$password2 = mysqli_real_escape_string($db, $_POST['password2']);

	if (empty($username) || empty($email) || empty($password1) || empty($password2)) {
		$errors = errors + 1;
	    header('location: registererrorpage.php');
	}

	if ($password1 != $password2) {
		echo("The two passwords do not match.");
		$errors = errors + 1;
		header('location: registererrorpage.php');
	 }

	//if there are no errors found, the user is added to the database and registered
	if (count($errors) == 0) {
	  	$sql = "INSERT INTO user (username, email, password) VALUES ('$username','$email','$password1')";
	  	mysqli_query($db, $sql);

	  	$_SESSION['username'] = $username;
	  	$_SESSION['success'] = "Login Successful.";
	  	header('location: bookshophome.php');
	 }
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="Stylesheet" type="text/css" href="stylesheet.css"/>

    <!-- CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<title> The Book Shop </title>
<h1 style="float:middle;"> The Book Shop </h1>

<body>
	<!-- Header - to navigate the site -->
	<nav class="navbar navbar-inverse navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php"> Home </a>
				<a style="float:right" class="navbar-brand" href="logout.php"> Logout </a>
				<a style="float:right" class="navbar-brand" href="login.php"> Log In </a>
			</div>
		</div>
	</nav>

	<!-- Library Image -->
	<img style="height:20%;width:100%" src="library2crop.jpg"/>

	<div class="container" style="width:50%">
	<h2> Create an Account </h2>
	<br>
	<form style="padding-left:5%" action="" method="POST" onsubmit="return checkForm();">
		<div class="form-group" style="padding-bottom:3%">
			<label for="username"> Username: </label>
			<input type="text" class="form-control" placeholder="Enter your Username" name="username" id="username" required>
		</div>

		<div class="form-group" style="padding-bottom:3%">
			<label for="email"> E-mail: </label>
			<input type="email" class="form-control" placeholder="Enter E-mail Address" id="email" required>
		</div>

		<div class="form-group">
			<label for="address"> Shipping Address: </label>
			<input type="text" class="form-control" placeholder="Shipping Address Line 1" id="address1" required>
		</div>

		<div style="padding-bottom:3%">
			<input type="text" class="form-control" placeholder="Shipping Address Line 2" id="address2" required>
		</div>

		<div class="form-group" style="padding-bottom:3%">
			<label for="password1"> Password: </label>
			<input type="password" class="form-control" placeholder="Enter Password" id="password1" required>
		</div>

		<div class="form-group">
			<label for="password2"> Confirm Password: </label>
			<input type="password" class="form-control" placeholder="Confirm Password" id="password2" required>
		</div>

		<br/>
		<button type="submit" class="btn btn-dark" name="submit" id="submit"> Create My Account </button>
	</form>
</div>

<!-- Footer -->
<br/>
<ul class="footer container-fluid text-center">
	<p style="color:white">
		Address: 146 Allamy Street <br/>
		Contact Us: 01 2108 9952 <br/>
	</p>
</ul>
</body>
</html>