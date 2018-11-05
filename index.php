<!DOCTYPE html>

<?php 
    //include('session.php');
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
<h1 style="float:middle;"> The Book Shop <?php //echo $login_session; ?></h1>

<body>
	<!-- Header - to navigate the site -->
	<nav class="navbar navbar-inverse navbar-custom">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php"> Home </a>
				<a class="navbar-brand" href="products.php">Books</a>
				<a style="float:right" class="navbar-brand" href="logout.php"> Logout </a>
				<a style="float:right" class="navbar-brand" href="login.php"> Log In </a>
			</div>
		</div>
		<!-- Library Image -->
		<img style="height:20%;width:100%" src="library2.jpg" alt="Our Store"/>
	</nav>

	<div style="padding-left:3%">
		<h2>Welcome!</h2>
		<p>
			Hello, thank you for visiting our website! We hope you find everything you're looking for. Don't forget to use our handy search box to make finding your next read quicker and easier. Happy Reading!
		</p>

		<!-- Search Bar -->
		<form action="searchResults.php" class="form-inline" method="post">
			<div class="form-group">
				<input type="text" 
					   class="form-control"
	                   name = "search" 
	                   placeholder="Search for a book..."/>
				<button type="submit" class="btn btn-dark" href = "searchResults.php"> Search </button>
		</form>

		<br/>
	</div>


	<!-- Footer -->
	<br/>
	<footer class="section footer-classic elegant-dark text-center" style="background-color: #303030">
		<div class="container-fluid">
			<p style="color:white">
				Address: 146 Allamy Street <br/>
				Contact Us: 01 2108 9952 <br/>
			</p>
		</div>
	</footer>
</body>
</html>