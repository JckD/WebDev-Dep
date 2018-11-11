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
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span></a>
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
    
            $sql = "SELECT * FROM books";
    
            $result = $con->query($sql);
    
            if ($result->num_rows > 0)
            {
            
                echo       '<tr>';
                echo            '<th scope="col" style="width: 25">Cover</th>';
                echo            '<th scope="col" style="width: 30%;">Title</th>';
                echo            '<th scope="col" style="width: 30%; ">Author</th>';
                echo            '<th scope="col" style="width: 30%; ">Price</th>';
                echo        '</tr>';
        
                while($row = $result->fetch_assoc())
                {
                    echo "<tr>
                            <td style='text-align: center; vertical-align: middle'>
                            <a href='"."$row[title]".".html'><img style='width:100%' src='"."$row[title]".".jpg'
                            </td>
                            <td style='text-align: center; vertical-align: middle;'>
                            <a href='"."$row[title]".".html'>"."$row[title]". "
                            </td>
                            <td style='text-align: center; vertical-align: middle;'>
                            <a href='"."$row[title]".".html'>"."$row[author]"."
                            </td>
                            <td style='text-align: center; vertical-align: middle;'>
                            <a href='"."$row[title]".".html'>$"."$row[price]"."
                            </td>
                        </tr>";
                }
            }
    
        ?>
    
        </table>
    </div>
	   <br/>
    </body>
</html>