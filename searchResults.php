<!DOCTYPE html>

<?php 
    //include('session.php');
?>

<html>
<head>
	<link rel="Stylesheet" type="text/css" href="stylesheet.css"/>
    
</head>

<title> The Book Shop </title>
<h1 style="float:middle;"> The Book Shop <?php //echo $login_session; ?></h1>

<body>
	<!-- Header - to navigate the site -->
	<ul class="header">
		<li><a href="bookshophome.php">Home</a></li>
        <li><a href="products.php">Books</a></li>
		<li style="float:right"><a href="logout.php">Logout</a></li>
		<li style="float:right"><a href="login.php">Login</a></li>
	</ul>

	<!-- Library Image -->
	<!--<img style="height:20%;width:100%" src="library2.jpg" alt="Our Store"/>


	<!-- Search Bar -->
	<!-- ADD ACTION TO SEARCH BAR -->
	<form action="searchResults.php" method="post">
		<div class="search-container">
			<input style="position:middle;" 
                   type="text" 
                   name = "search" 
                   placeholder="Search for a book"/>
			<button type="submit">Submit</button>
		</div>
	</form>
    <table class="search" style="margin-top:20px;
                                 text-align: center;
                                 font-size: 15px;
                                 border-collapse: collapse;
                                 border: 1px solid black;
                                 width: 100%">
    <?php
        $term = '';
    
        //connect to database
        $con = mysqli_connect("localhost","root","","dt211");
    
        //check connection
        if(mysqli_connect_errno())
        {
            echo "Failed to connect to MYSQL: ". mysqli_connect_errno();
        }
    
        //take the string that the user searchd for
        if(isset($_REQUEST['search']) && $_REQUEST['search'] != ''){
            $term = ($_REQUEST['search']);
        }
    
        //use the string to search for a book,author, publisher,genre or description matching that string
        $sql = "SELECT * FROM books WHERE  title LIKE '%" .$term. "%'
                                    OR author LIKE '%" .$term. "%'
                                    OR publisher LIKE '%" .$term. "%'
                                    OR genre LIKE '%" .$term. "%'
                                    OR descr LIKE '%" .$term. "%'";
        
        $result = $con->query($sql);
    
        if ($result->num_rows > 0)
        {
            
            echo       '<tr>';
            echo            '<th style="width: 25%; border: 1px solid black">Cover</th>';
            echo            '<th style="width: 30%; border: 1px solid black">Title</th>';
            echo            '<th style="width: 30%; border: 1px solid black">Author</th>';
            echo            '<th style="width: 30%; border: 1px solid black;">Price</th>';
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
    
        //if no titles match the search 
        else {
            echo "No results found.";
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
