<!DOCTYPE html>
<!--
    Web developement and deployment
    Group Assignment
    Jack Doyle | Casey Ogbovoen
    To Kill a Mockingbird.php
    Web page that displays information
    about the product: To Kill a Mockingbird
-->
<?php 
    session_start();
    //display session variable if it is set
    if(isset($_SESSION["user"])){
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
                    <!--Home button that link to the home page-->
                    <li><a href="index.php"> Home </a></li>
                    <!-- Books button that links to porducts.php-->
                    <li class="active"><a href="products.php">Books</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <!--Icon Button links to user's cart-->
                     <li>
                        <a href="cart.php" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                    </li>
                    <!-- User Icon button dropown button to log in/out and user porfile pages-->
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

        <!-- Product display div-->
        <div style=" padding-bottom:50%;">

              <div style="float: left; width: 40%; text-align: center; padding-top: 20px">
                <img style="width: 60%; margin-left: 20%" src="To%20Kill%20a%20Mockingbird.jpg">
            </div><!--end cover div-->

            <!--Information div-->
            <div style="float: left; width: 40%">

                <div>
                    <h2>To Kill a Mocking Bird</h2>
                    <h4>Harper Lee</h4>
                </div><!-- end title div-->

                <div>
                    To Kill a Mockingbird is a novel by Harper Lee published in 1960. It was immediately successful, winning the Pulitzer Prize, and has become a classic of modern American literature. The plot and characters are loosely based on Lee's observations of her family, her neighbors and an event that occurred near her hometown of Monroeville, Alabama, in 1936, when she was 10 years old. The story is told by the six-year-old Jean Louise Finch.
                </div><!-- end discription div-->

                <div>
                    <h2>$16.45</h2>
                </div><!-- end price div-->

                <div class="search-container">
                    <form action="addBook.php" method="post">

                         <button type="submit" name="title" value="To Kill A Mockingbird" class="btn btn-dark">Add To Basket</button>
                    </form>
                </div><!-- end order div-->

            </div><!-- end info div-->


        </div><!--end product display div-->
    </body>
</html>