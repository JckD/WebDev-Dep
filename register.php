<!DOCTYPE html>

<?php
	include("config.php");
session_start();

$errors = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	if(mysqli_connect_errno()){

		mysqli_connect_errno()."Failed to Connect.";
	}

	$username = mysqli_real_escape_string($db, $_POST['username']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$address1 = mysqli_real_escape_string($db, $_POST['address1']);
	$address2 = mysqli_real_escape_string($db, $_POST['address2']);
	$password1 = mysqli_real_escape_string($db, $_POST['password1']);
	$password2 = mysqli_real_escape_string($db, $_POST['password2']);

	//if any fields are empty
	if (empty($username)) {
		array_push($errors,"Username is required");
	}
	if(empty($email)){
		array_push($errors, "E-mail is required");
	}
	if(empty($address1)){
		array_push($errors, "Shipping Address is required");
	}
	if(empty($password1)){
		array_push($errors, "Password is required");
	}
	if(empty($password2)){
		array_push($errors,"Confirm Password");
	}

	//if passwords do not match
	if ($password1 != $password2) {
		array_push($errors, "Passwords do not match");
	 }

	 print_r($errors);

	//if there are no errors found, the user is added to the database and registered
	if (!$errors) {
		//concatonate address line 1 with address line 2
		$address = $address1.$address2;

		$sql = "INSERT INTO user (username, email, address, password) VALUES ('$username','$email', '$address', $password1')";
		mysqli_query($db, $sql);

		$_SESSION['username'] = $username;
		$_SESSION['success'] = "Login Successful.";
		header('location: index.php');
	 }
	 header( 'location: '.htmlspecialchars($_SERVER['PHP_SELF']));
}
else{
	$form['username'] = $form['email'] = $form['address1'] = $form['address2'] = $form['password1'] = $form['password2'] = '';
}
?>

<script>
	function checkForm(){
		//Ensure username field isn't empty
		var username = document.getElementById("username");
		if(username == null || username == ""){
			alert("Please enter a Username");
			return false;
		}

		//ensure email field isn't empty
		var email = document.getElementById("email");
		if(email == null || email == ""){
			alert("Please enter an Email Address");
			return false;
		}

		//ensure the first address field is not empty
		var address1 = document.getElementById("address1");
		if(address1 == null || address1 == ""){
			alert("Please enter a Shipping Address");
			return false;
		}

		//ensure password was entered
		var password1 = document.getElementById("password1");
		var password2 = document.getElementById("password2");
		if(password1 == null || password1 == ""){
			alert("Please enter a Password");
			return false;
		}

		//ensure password was confirmed
		if(password2 == null || password2 == ""){
			alert("Plese confirm your Password");
			return false;
		}

		//ensure passwords match
		if(!password1.equals(password2)){
			alert("Passwords do not match");
			return false;
		}
	}//end checkForm()
</script>

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
				<a class="navbar-brand" href="products.php">Books</a>
				<a style="float:right" class="navbar-brand" href="logout.php"> Logout </a>
				<a style="float:right" class="navbar-brand" href="login.php"> Log In </a>
			</div>
		</div>
		<!-- Library Image -->
		<img style="height:20%;width:100%" src="library2crop.jpg"/>
	</nav>

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
</body>
</html>