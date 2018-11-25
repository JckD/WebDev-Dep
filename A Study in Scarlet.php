<!DOCTYPE html>
<!--
    Web developement and deployment
    Group Assignment
    Jack Doyle | Casey Ogbovoen
    1984.php
    Web page that displays information
    about the product: A Study in Scarlet
-->
<?php 
    //start session
    session_start();
    //display session variable if it is set
    if(isset($_SESSION["user"])){
        //set user variable
        echo $_SESSION["user"];
    }
?>

<html>
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
                    <!--Home button that links to the home page -->
                    <li><a href="index.php"> Home </a></li>
                    <!-- Books button that links to the products.php-->
                    <li class="active"><a href="products.php">Books</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <!-- Icon button that links to the user's cart-->
                     <li>
                        <a href="cart.php" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                    </li>
                    <!-- User Icon button dropdpwn button to log in/out and user profile pages-->
                    <li class="dropdown">
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
            <img style="height:20%;width:100%" src="library2crop.jpg"/>
        </nav>



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

        <!--Open Procuct Display div-->
        <div style=" padding-bottom:50%;">


            <!--Information div -->
            <div style="float: left; width: 40%; text-align: center;  padding-top: 30px">
                <img style="width: 60%; margin-left: 20%" src="A%20Study%20in%20Scarlet.jpg">
            </div><!--end cover div-->

            <div style="float: left; width: 40%">

                <div>
                    <h2>A Study in Scarlet</h2>
                    <h4>Arthur Conan Doyle</h4>
                </div><!-- end title div-->

                <div>
                    A Study in Scarlet is an 1887 detective novel by British author Arthur Conan Doyle. Written in 1886, the story marks the first appearance of Sherlock Holmes and Dr. Watson, who would become the most famous detective duo in popular fiction.
                </div><!-- end discription div-->

                <div>
                    <h2>$23.99</h2>
                </div><!-- end price div-->

                <div class="search-container">
                    <form action="addBook.php" method="post">

                         <button type="submit" name="title" value="A Study in Scarlet" class="btn btn-dark">Add To Basket</button>
                    </form>
                </div><!-- end order div-->

            </div><!-- end info div-->

        </div><!--end product display div-->
    </body>
</html>