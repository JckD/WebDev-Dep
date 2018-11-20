<!DOCTYPE html>

<?php 
    session_start();
    //display session variable if it is set
    if(isset($_SESSION["user"])){
        echo $_SESSION["user"];
        $user = $_SESSION["user"];
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
                <li>
                    <a href="cart.php" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                </li>
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
        	<h3>Your Shopping Cart:</h3>
        </div>
        
        <div style=" width: 75%; display: block; margin-left:12%"> 

            <table class="table table-hover" style = "margin-top:20px;
                                         text-align: center;
                                         font-size: 20px;
                                         width: 100%">
    
            
        <?php 
            
        if(isset ($_SESSION["user"])){
             //connect to database
            $con = mysqli_connect("localhost","root","","dt211");
    
            //check connection
            if(mysqli_connect_errno())
            {
                echo "Failed to connect to MYSQL: ". mysqli_connect_errno();
            }
    
            $sql = "SELECT title,price FROM orders where username = '".$user."'";
    
            $result = $con->query($sql);
    
            if ($result->num_rows > 0)
            {
            
                echo       '<tr>';
                echo            '<th scope="col" style="width: 25%;text-align: center; vertical-align: middle">Cover</th>';
                echo            '<th scope="col" style="width: 25%;text-align: center; vertical-align: middle">Title</th>';
                echo            '<th scope="col" style="width: 25%;text-align: center; vertical-align: middle">Price</th>';
                echo            '<th scope="col" style="width: 25%;text-align: center; vertical-align: middle">Quantity</th>';
                echo        '</tr>';
        
                while($row = $result->fetch_assoc())
                {
                    echo "<tr>
                            <td style='text-align: center; vertical-align: middle'>
                            <a href='"."$row[title]".".html'><img style='width:25%' src='"."$row[title]".".jpg'
                            </td>
                            <td style='text-align: center; vertical-align: middle;'>
                            <a href='"."$row[title]".".html'>"."$row[title]". "
                            </td>
                            <td style='text-align: center; vertical-align: middle;'>
                            <a href='"."$row[title]".".html'>$"."$row[price]"."
                            </td>
                            <td style='text-align: center; vertical-align: middle;'id='quantity'>
                            <p id='num'>1</p><br><button  class='btn btn-dark' style='margin-right:3px;margin-left: 5px' onclick='increase()'>+</button><button  class='btn btn-dark' onclick='decrease()' >-</button>
                            </td>
                        </tr>";
                }
            }
            else {
                echo "Your cart is empty!";
            }
        }
        else{
            echo "Please <a href=". "login.php" . ">login </a> to see your Cart.";
        }
           
                
    
        ?>
            
    
        </table>
            <div style="float: left; margin-right: 0px" class="btn-group" role="group" aria-label="Basic example">
                <form class="px-4 py-3" action="products.php">
                    <input class="btn btn-secondary" type="submit" style="margin-left: 10px" value="Continue Shopping" href="products.php">
            
                </form>
            </div>
            <div style="float: left; margin-right: 0px" class="btn-group" role="group" aria-label="Basic example">
                
            <form class="px-4 py-3" action="delete.php">
               
            
                <input class="btn btn-secondary" type="submit" style="margin-left: 10px" value="Delete Cart"> 
            </form>
           
        </div>
        <div style="float: right; margin-bottom: 100px">
           
            <form action="order.php" method="post">
                    <input class="btn btn-dark" type="submit" style="margin-left: 10px" value="Place Order">
            </form>
        </div>
    </div>
    <p id="test"></p>
    </body>
    <script>
        
        function increase(){
            
            var amount = document.getElementById('num')
            
            var quantity = Number(amount.textContent);
            
            quantity++;
            
            amount.textContent = quantity;
            document.getElementById('test').innerHTML = quantity;
        }
        
        function decrease(){
            
              var amount = document.getElementById('num')
            
            var quantity = Number(amount.textContent);
            
            quantity--;
            
            if (quantity < 0){
                quantity =0;
            };
            
            amount.textContent = quantity;
            document.getElementById('test').innerHTML = quantity;
        }
        
    </script>
</html>