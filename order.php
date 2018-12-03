<!DOCTYPE html>
<!--
    Web developement and deployment
    Group Assignment
    Jack Doyle | Casey Ogbovoen
    order.php
    Page that places the user's order
-->
<?php 
    //start session
    session_start();
    $user = $_SESSION["user"];
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
                <!--Home button that links to the home page-->
                <li><a href="index.php"> Home </a></li>
                <!--Books button that links to products.php-->
                <li><a href="products.php">Books</a></li>
            </ul>
                
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <!-- Display profile picture adn link to profile page if user is logged in -->
                    <div><a href="profile.php">
                            <?php
                                include("userloggedin.php");
                            ?>
                        </a>
                    </div>
                </li>
                <!--Icon button that links to user's cart-->
                <li class="active">
                    <a href="cart.php" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                </li>
                <!--User Icon button dropdown button to log in/out and suer profile pages-->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="profile.php"> My Profile </a></li>
                        <li><a href="login.php"> Log In</a></li>
                        <li><a href="logout.php"> Logout </a></li>
                    </ul>
                </li>
            </ul>
        </div><!--Close Nav bar div-->
            
		<!-- Library Image -->
		<img style="height:20%;width:100%" src="library2crop.jpg"/>
	</nav>
   
        <!--Center div-->
        <div style=" width: 75%; display: block; margin-left:12%; text-align: center"> 

           
            <h3>Your order has been placed!</h3>
            <h5>Thank you for shopping with us.</h5>
            
            <?php 

                //connect to database
                $con = mysqli_connect("localhost","root","","dt211");

                //check connection
                if(mysqli_connect_errno())
                {
                    echo "Failed to connect to MYSQL: ". mysqli_connect_errno();
                }
                //sql that deletes from the oders table where the user name matches the logged in user
                 $sql = "DELETE FROM `orders` WHERE username = '".$user."'";


                if (!mysqli_query($con,$sql)){

                    die('Error: '. mysqli_error($con));
                }       

            ?>
            <!-- Button that links back to home page-->
            <div style="float: center; margin-bottom: 100px">

                <form action="index.php" method="post">
                        <input class="btn btn-dark" type="submit" style="margin-left: 10px" value="Home Page">
                </form>
            </div> <!--Close button div-->
        </div><!--close center div-->
    </body>
</html>