<!DOCTYPE html>

<?php 
	include('session.php');
?>

<html>
<head>
	<link rel="Stylesheet" type="text/css" href="stylesheet.css"/>
</head>

<title> The Book Shop </title>
<h1 style="float:middle;"> The Book Shop <?php echo $login_session; ?></h1>

<body>
	<!-- Header - to navigate the site -->
	<ul class="header">
		<li><a class="active" href="bookshophome.php">Home</a></li>
		<li style="float:right"><a href="logout.php">Logout</a></li>
		<li style="float:right"><a href="login.php">Login</a></li>
	</ul>

	<!-- Library Image -->
	<img style="height:20%;width:100%" src="library2.jpg" alt="Our Store"/>

	<h2>Welcome!</h2>
	<p>
		Hello, thank you for visiting our website! We hope you find everything you're looking for. Don't forget to use our handy search box to make finding your next read quicker and easier. Happy Reading!
	</p>

	<!-- Search Bar -->
	<!-- ADD ACTION TO SEARCH BAR -->
	<form action="">
		<div class="search-container">
			<input style="position:middle;" type="text" placeholder="Search for Something..."/>
			<button type="submit">Submit</button>
		</div>
	</form>

	<!-- SUGGESTION: ADD A FAVOURITES SECTION
		 SHOW A FEW BOOKS JUST TO FILL UP THE 
		 HOME PAGE -->

	<br/>

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