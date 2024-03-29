<!DOCTYPE html>
<!--
    Web developement and deployment
    Group Assignment
    Jack Doyle | Casey Ogbovoen
    the Secret History.php
    Web page that displays information
    about the product: The Secret History
-->
<?php 
    //start session
    session_start();
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
                    <!--Home button that links to the home page-->
                    <li><a href="index.php"> Home </a></li>
                    <!--Books button that links to products.php-->
                    <li class="active"><a href="products.php">Books</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <!--cart Icon that links to the user's cart-->
                     <li>
                        <a href="cart.php" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                    </li>
                    <!--User Icon button dropdown button to log on/out and user profile pages-->
                    <li class="dropdown">
                        <a href="#" class="active dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span></a>
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

        <!--Product display div-->
        <div style=" padding-bottom:50%;">

            <div style="float: left; width: 40%; text-align: center;  padding-top: 30px">
                <img style="width: 60%; margin-left: 20%" src="The%20Secret%20History.jpg">
            </div><!--end cover div-->

            <!--Information div-->
            <div style="float: left; width: 40%">

                <div>
                    <h2>The Secret History</h2>
                    <h4>Donna Tartt</h4>
                </div><!-- end title div-->

                <div>
                    The Secret History is the first novel by Donna Tartt, published by Alfred A. Knopf in 1992. A 75,000 print order was made for the first edition (as opposed to the usual 10,000 order for a debut novel), and the book became a bestseller.
                </div><!-- end discription div-->

                <div>
                    <h2>$14.25</h2>
                </div><!-- end price div-->

                <div class="search-container">
                    <form action="addBook.php" method="post">

                         <button type="submit" name="title" value="The Secret History" class="btn btn-dark">Add To Basket</button>
                    </form>
                </div><!-- end order div-->

            </div><!-- end info div-->

        </div><!--end product display div-->
    </body>
</html>