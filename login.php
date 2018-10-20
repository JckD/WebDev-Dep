<!DOCTYPE html>

<?php
	include("config.php");
	session_start();

	if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      // username and password sent from form 
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT email FROM user WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
      if($count == 1) {
         session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         
         header("location: bookshophome.php");
      }
      else {
         $error = "Error logging in. Make sure your username and password are correct.";
      }//end if/else
  }//end if
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
		<li style="float:right"><a class="active" href="login.php">Login</a></li>	
	</ul>

	<!-- Library Image -->
	<img style="height:20%;width:100%" src="library2crop.jpg"/>

	<h2> Log In </h2>

	<form action="" method="post">
		<label for="username"><b> Username: </b></label>
		<input type="text" placeholder="Enter your Username" name="username" required>

		<label for="password"><b> Password: </b></label>
		<input type="password" placeholder="Enter your Password" name="password" required>

		<button type="submit"> Login </button>

		<p>
			Don't have an account yet? <a href="register.php"> Register! </a>
		</p>
	</form>

	<!-- Error Message -->
	<p style="color:red"><?php echo $error; ?></p>

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