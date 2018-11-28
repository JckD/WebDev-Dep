<!DOCTYPE html>

<?php 
    session_start();
    //display session variable if it is set
    if(isset($_SESSION["user"])){
        echo $_SESSION["user"];
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

<body >
    <h1> The Book Shop </h1>
    
	<!-- Header - to navigate the site -->
	<nav class="navbar navbar-inverse navbar-default">
		<div class="container-fluid">
			<ul class="nav navbar-nav">
                <li><a href="index.php"> Home </a></li>
                <li><a href="products.php">Books</a></li>
            </ul>
                
            <ul class="nav navbar-nav navbar-right">
                 <li>
                    <a href="cart.php" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                </li>
                <li class="active dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span></a>
                    <ul class="dropdown-menu">
                        <li class="active"><a href="profile.php"> My Profile </a></li>
                        <li><a href="editprofile.php"> Edit Profile </a></li>
                        <li><a href="logout.php"> Logout </a></li>
                    </ul>
                </li>
            </ul>
        </div>
            
		<!-- Library Image -->
		<img style="height:20%;width:100%" src="library2crop.jpg"/>
	</nav>
    <br>
    <br>
    
    <div align="center">
        <?php
    
        if(isset ($_SESSION["user"])){
            //connect to database
            $con = mysqli_connect("localhost","root","","dt211");

            //check connection
            if(mysqli_connect_errno())
            {
                echo "Failed to connect to MYSQL: ". mysqli_connect_errno();
            }
            
            //store session username in a variable
            $session = $_SESSION["user"];

            $sql = "SELECT username, email, address, image FROM user WHERE username = '$session'";

            $result = $con->query($sql);

            if($result->num_rows > 0){

                while($row = $result->fetch_assoc()){
                    echo "<h2 style='padding-right:30%'> My Profile </h2>";
                    echo "<img style='height: 300px; width: 300px' class='img-circle' src='" . "$row[image]" . "'/><br><br>";
                    echo "<h4> Username: " . "$row[username]" . "</h4><br>";
                    echo "<h4> Email: " . "$row[email]" . "<h4><br>";
                    echo "<h4> Address: " . "$row[address]" . "<h4><br>";
                    echo "<a href='validatepassword.php'><button class='btn btn-dark'> Edit Profile </button></a> ";
                    echo "<a href='deleteaccount.php'><button class='btn btn-dark'> Delete Profile </button></a>";
                }
            }
            
        }
        else{
            echo "Please <a href=". "login.php" . ">login </a> to see your Profile.";
        }
    ?>  
    </div>
    <br>
</body>
</html>