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

<html>
<head>
	<link rel="Stylesheet" type="text/css" href="stylesheet.css"/>
</head>

<title> The Book Shop </title>
<h1 style="float:middle;"> The Book Shop </h1>

<body>
	<!-- Header - to navigate the site -->
	<ul class="header">
		<li><a href="bookshophome.php">Home</a></li>
		<li style="float:right"><a href="logout.php">Logout</a></li>
		<li style="float:right"><a href="login.php">Login</a></li>	
	</ul>

	<!-- Library Image -->
	<img style="height:20%;width:100%" src="library2crop.jpg"/>

	<h2> Create an Account </h2>

	<form action="" method="post">
		<label for="username"><b> Username: </b></label>
		<input type="text" placeholder="Enter your Username" name="username" required>

		<label for="email"><b> E-mail: </b></label>
		<input type="email" placeholder="Enter your E-mail Address" name="email" required>

		<label for="password1"><b> Password: </b></label>
		<input type="password" placeholder="Enter your Password" name="password1" required>

		<label for="password2"><b> Confirm Password: </b></label>
		<input type="password" placeholder="Confirm your Password" name="password2" required>

		<button type="submit"> Register </button>
	</form>

	<!-- Footer -->
	<br/>
	<ul class="footer" style="padding-left:5%">
		<p style="color:white">
			Address: 146 Allamy Street <br/>
			Contact Us: 01 2108 9952 <br/>
		</p>
	</ul>
</body>
</html>