<!DOCTYPE html>
<!--
    Web developement and deployment
    Group Assignment
    Jack Doyle | Casey Ogbovoen
    products.php
    Page that dispplay all products
    from the shop
-->
<?php 
    //start session
    session_start();
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
                <li class="active"><a href="products.php">Books</a></li>
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
                <!-- Icon button that links to user's cart-->
                 <li>
                    <a href="cart.php" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                </li>
                <!-- User Icon button dropdown to log in/out and user porfile pages-->
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

    <!--Search Bar div-->
    <div style="padding: 0%; margin-left: 12%">
        	<!-- Search Bar -->
            	<form action="searchResults.php" class="form-inline justify-content-center" method="post">
                    <div class="form-group">
                        <input type="text" 
                               class="form-control"
                               name = "search" 
                               placeholder="Something else...?"/>
                        <button type="submit" class="btn btn-dark" href = "searchResults.php"> Search </button>
                    </div>
                </form>
        </div>
        
        <div style=" width: 75%; display: block; margin-left:12%"> 

            <table class="table table-hover" style = "margin-top:20px;
                                         text-align: center;
                                         font-size: 20px;
                                         width: 100%">
    
            
                <?php 

                    //connect to database
                    $con = mysqli_connect("localhost","root","","dt211");

                    //check connection
                    if(mysqli_connect_errno())
                    {
                        echo "Failed to connect to MYSQL: ". mysqli_connect_errno();
                    }
                    //query to select all books from books table
                    $sql = "SELECT * FROM books";

                    //run sql query
                    $result = $con->query($sql);

                    //echo results table
                    if ($result->num_rows > 0)
                    {

                        echo       '<tr>';
                        echo            '<th scope="col" style="width: 25">Cover</th>';
                        echo            '<th scope="col" style="width: 30%;">Title</th>';
                        echo            '<th scope="col" style="width: 30%; ">Author</th>';
                        echo            '<th scope="col" style="width: 30%; ">Price</th>';
                        echo        '</tr>';
                        //results user $row[title] variable to link back to item page
                        while($row = $result->fetch_assoc())
                        {
                            echo "<tr>
                                    <td style='text-align: center; vertical-align: middle'>
                                    <a href='"."$row[title]".".php'><img style='width:100%' src='"."$row[title]".".jpg'
                                    </td>
                                    <td style='text-align: center; vertical-align: middle;'>
                                    <a href='"."$row[title]".".php'>"."$row[title]". "
                                    </td>
                                    <td style='text-align: center; vertical-align: middle;'>
                                    <a href='"."$row[title]".".php'>"."$row[author]"."
                                    </td>
                                    <td style='text-align: center; vertical-align: middle;'>
                                    <a href='"."$row[title]".".php'>$"."$row[price]"."
                                    </td>
                                </tr>";
                        }//end while
                    }//end if

                ?>
    
            </table>
        </div>
	   <br/>
    </body>
</html>