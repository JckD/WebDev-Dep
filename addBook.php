<!DOCTYPE html>
<!--
    Web developement and deployment
    Group Assignment
    Jack Doyle | Casey Ogbovoen
    1984.php
    Web page that adds books to the
    user's cart
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
                    <!-- Books button that links to products.php-->
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
                    <!-- Icon button that links to the user's cart-->
                     <li>
                        <a href="cart.php" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                    </li>
                    <!-- User Icon dropdown button to log in/out and user profile pages-->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="profile.php"> My Profile </a></li>
                            <li><a href="editprofile.php"> Edit Profile </a></li>
                            <li><a href="logout.php"> Logout </a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <!-- Library Image -->
            <img style="height:20%;width:100%" src="library2crop.jpg"/>
        </nav>

        <h2 style="padding-left:2%"> </h2> 
        <div style="padding-left: 5%">
            <?php

                //if statement so that only logged in user's
                // can add books to their cart
                if(isset ($_SESSION["user"])){


                    //PHP that adds a book to the user's cart
                    //set session varable as user
                    $user = $_SESSION["user"]; 

                    //connect to the database
                    $con = mysqli_connect("localhost","root","","dt211");

                    //initialise title variable
                    $title = ' ';
                   


                    //error check databse connection
                    if(mysqli_connect_errno())
                    {
                        echo "Failed to connect to MYSQL: ". mysqli_connect_errno();
                    }

                    //error echeck title is set
                    if(isset($_REQUEST['title']) && $_REQUEST['title'] != ''){
                        $title = ($_REQUEST['title']);
                    }

                    //sql statement that inserts the book_id, price and title from books
                    //into orders where the title matches $title which is taken from
                    //each book page.
                    $sql ="INSERT into `orders` (book_id, price, title)
                            select book_id, books.price, books.title from books
                            where books.title = '".$title."'";

                    //run the query
                    if (!mysqli_query($con,$sql))
                        {   
                            
                            if(mysqli_errno() == 1062)
                            {
                                die('you can update quantities at your <a href="."cart.php".">cart</a>.');
                            }                            
                           //die('Error: '. mysqli_error($con));


                        }

                    //sql statement that  updates the oders table and adds the user's name to the order
                    $update = "Update `orders` set username = '".$user."' where title LIKE '%".$title."%'";

                    //run query
                    if (!mysqli_query($con,$update))
                        {
                            die('Error: '. mysqli_error($con));


                        }
                    //confimed echo message
                    echo $user;
                    echo "Added to cart!";

                    //close connectection
                    mysqli_close($con);
                    //link user to cart
                    header("Location: cart.php");
                    exit;

                }
                //if the user is not logged in they will get this message
                //and link to login page
                else{
                    echo "Please <a href=". "login.php" . ">login </a> to add books to cart.";
                 }
            ?>
        </div>
        <br>
    </body>
</html>