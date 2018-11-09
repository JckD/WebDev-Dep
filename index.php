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


<body>
     <h1> The Book Shop </h1>
    	<!-- Header - to navigate the site -->
	<nav class="navbar navbar-inverse navbar-default">
		<div class="container-fluid">
			<ul class="nav navbar-nav">
                <li><a href="index.php"> Home </a></li>
                <li><a href="products.php">Books</a></li>
            </ul>
                
            <ul class="nav navbar-nav navbar-right">
                <li class="active dropdown">
                    <a href="#" class="active dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="profile.php"> My Profile </a></li>
                        <li><a href="login.php"> Log In</a></li>
                        <li><a href="logout.php"> Logout </a></li>
                    </ul>
                </li>
            </ul>
        </div>
            
		<!-- Library Image -->
		<img style="height:20%;width:100%" src="library2crop.jpg" alt="Our Store"/>
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
            </div>
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