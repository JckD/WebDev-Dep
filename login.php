<!DOCTYPE html>

<?php
	include("config.php");
	session_start();

	if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      // username and password sent from form 
      $username = mysqli_real_escape_string($db,$_POST['username']);
      $password = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT email FROM user WHERE username = '$username' and password = '$password'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
      if($count == 1) {
      	session_register("username");
        $_SESSION['login_user'] = $username;
         
        header("location: index.php");
      }
      else {
      	header( 'location: '.htmlspecialchars($_SERVER['PHP_SELF']));
      	$form['username'] = $form['password'] =  '';
      	$error = "Error. Please re-enter your loggin details.";
      }
  }//end if
?>

<script>
	function checkForm(){
		//Ensure username field isn't empty
		var username = document.getElementById("username");
		if(username == null || usrname == ""){
			alert("Please enter your Username");
			return false;
		}

		//ensure password was entered
		var password = document.getElementById("password");
		if(password == null || password == ""){
			alert("Please enter your Password");
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
		<h2> Log In </h2>
		<form style="padding-left:5%" action="login.php" method="post" onsubmit="return checkForm();">
			<div class="form-group">
				<label for="username"> Username: </label>
				<input type="text" class="form-control" placeholder="Enter Username" name="username" id="username" required>
			</div>

			<div class="form-group">
				<label for="password"> Password: </label>
				<input type="password" class="form-control" placeholder="Enter Password" name="password" id="password" required>
			</div>

			<br>
			<button type="submit" class="btn btn-dark" href="login.php"> Login </button>

			<p>
			<br/>
				Don't have an account yet? <a href="register.php"> Sign Up! </a>
			</p>
		</form>
	</div>
</body>
</html>