<!DOCTYPE html>

<?php 
    //include('session.php');
?>

<html>
<head>
	<link rel="Stylesheet" type="text/css" href="stylesheet.css"/>
    <script type="text/javascript" src="search.js"></script>
</head>

<title> The Book Shop </title>
<h1 style="float:middle;"> The Book Shop <?php //echo $login_session; ?></h1>

<body>
	<!-- Header - to navigate the site -->
	<ul class="header">
		<li><a  href="bookshophome.php">Home</a></li>
        <li><a  class = "active" href="products.php">Books</a></li>
		<li style="float:right"><a href="logout.php">Logout</a></li>
		<li style="float:right"><a href="login.php">Login</a></li>
	</ul>

	<!-- Library Image -->
	<img style="height:20%;width:100%" src="library2.jpg" alt="Our Store"/>

	<!-- Search Bar -->
	<!-- ADD ACTION TO SEARCH BAR -->
	<form action="searchResults.php" method="post">
		<div class="search-container">
			<input style="position:middle;" 
                   type="text" 
                   name = "search" 
                   placeholder="Search for a book..."/>
			<button type="submit" href = "searchResults.php">Submit</button>
		</div>
	</form>
    
    <table class="search" style = "margin-top:20px;
                                 text-align: center;
                                 font-size: 15px;
                                 border-collapse: collapse;
                                 border: 1px solid black;
                                 width: 100">
        
       
            
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
                echo            '<th style="width: 25%; border: 1px solid black">Cover</th>';
                echo            '<th style="width: 25%; border: 1px solid black">Title</th>';
                echo            '<th style="width: 25%; border: 1px solid black">Author</th>';
                echo            '<th style="width: 25%; border: 1px solid black;">Price</th>';
                echo        '</tr>';
        
                while($row = $result->fetch_assoc())
                {
                    echo "<tr>
                            <td style='border: 1px solid black;'><img style='width:50%' src='"."$row[title]".".jpg'</td>
                            <td style='border: 1px solid black;'>"."$row[title]". "</td>
                            <td style='border: 1px solid black;'>"."$row[author]"."</td>
                            <td style='border: 1px solid black;'>$"."$row[price]"."</td>
                        </tr>";
                }
            }
    
        ?>
    </table>

	<br/>

	<!-- Footer -->
	<br/>
	<ul class="footer" style="padding-left:5%">
		<p style="color:white">
			Address: 146 Allamy Street <br/>
			Contact Us: 01 2108 9952 <br/>
		</p>
	</ul>
</body>
</html>