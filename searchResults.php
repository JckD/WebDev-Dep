<!DOCTYPE html>

<?php 
    //include('session.php');
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
<h1 style="float:middle;"> The Book Shop <?php //echo $login_session; ?></h1>

<body >
	<!-- Header - to navigate the site -->
    <nav class="navbar navbar-inverse navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php"> Home </a>
                <a class="navbar-brand" href="products.php">Books</a>
                <a style="float:right" class="navbar-brand" href="logout.php"> Logout </a>
                <a style="float:right" class="navbar-brand" href="login.php"> Log In </a>
            </div>
        </div>
        <!-- Library Image -->
        <img style="height:20%;width:100%" src="library2crop.jpg" alt="Our Store"/>
    </nav>
    <br>

    <div style="padding: 3%">
        <!-- Search Bar -->
            <form action="searchResults.php" class="form-inline" method="post">
                <div class="form-group">
                    <input type="text" 
                           class="form-control"
                           name = "search" 
                           placeholder="Something else...?"/>
                    <button type="submit" class="btn btn-dark" href = "searchResults.php"> Search </button>
            </form>
        <br>

        <table class="search" style="margin-top:20px;
                                     text-align: center;
                                     font-size: 15px;
                                     border-collapse: collapse;
                                     border: 1px solid black;
                                     width: 100%"/>
    </div>

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
            echo            '<th style="width: 25%; border: 1px solid lightgrey">Cover</th>';
            echo            '<th style="width: 30%; border: 1px solid lightgrey">Title</th>';
            echo            '<th style="width: 30%; border: 1px solid lightgrey">Author</th>';
            echo            '<th style="width: 30%; border: 1px solid lightgrey">Price</th>';
            echo        '</tr>';
        
            while($row = $result->fetch_assoc())
            {
                echo "<tr>
                        <td style='border: 1px solid lightgrey'><img style='width:50%; padding: 2%;' src='"."$row[title]".".jpg'</td>
                        <td style='border: 1px solid lightgrey'>"."$row[title]". "</td>
                        <td style='border: 1px solid lightgrey'>"."$row[author]"."</td>
                        <td style='border: 1px solid lightgrey'>$"."$row[price]"."</td>
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
</body>
</html>