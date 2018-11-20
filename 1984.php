<!DOCTYPE html>

<?php 
    //include('session.php');
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
                <li><a href="index.php"> Home </a></li>
                <li class="active"><a href="products.php">Books</a></li>
            </ul>
                
            <ul class="nav navbar-nav navbar-right">
                 <li>
                    <a href="cart.php" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                </li>
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
        
    
    <div style=" padding-bottom:50%;">
        
        <!--Image Div-->
        <div style="float: left; width: 40%; text-align: center;  padding-top: 30px">
            <img style="width: 60%; margin-left: 20%" src="1984.jpg">
        </div><!--end cover div-->

        <div style="float: left; width: 40%">
            
            <div>
                <h2>1984</h2>
                <h4>George Orwell</h4>
            </div><!-- end title div-->
            
            <div>
                George Orwell wrote 1984 in 1949. The dystopian novel is set in 1984 - Orwell's near future and our recent past - but the novel is still relevant today, due to its depiction of a totalitarian government and its themes of using media manipulation and advanced technology to control people.
            </div><!-- end discription div-->
            
            <div>
                <h2>$19.84</h2>
            </div><!-- end price div-->
            
            <div class="search-container">
                <form action="addBook.php" method="post">
                     <button type="submit" name="title" value="1984" class="btn btn-dark">Add To Basket</button>
                </form>
            </div><!-- end order div-->
            
        </div><!-- end info div-->
        
    </div><!--end product display div-->
</body>
</html>