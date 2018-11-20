<!DOCTYPE html>
<html>
<head>
	
	<title>Add for html</title>
</head>
<body>

<?php 
//addBook.php
    //Jack Doyle Casey Ogbevoen
    //Web Dev and Deployment Assignement
    
    //PHP that adds a book to the user's cart
    session_start();
    
    
    $con = mysqli_connect("localhost","root","","dt211");

    $title = ' ';
    $user = '';
   
    //display session variable if it is set
    if(isset($_SESSION["user"])){
        echo $_SESSION["user"];
        $user =  $_SESSION["user"]; 
        
    }
    
    
    if(mysqli_connect_errno())
    {
        echo "Failed to connect to MYSQL: ". mysqli_connect_errno();
    }
    
    if(isset($_REQUEST['title']) && $_REQUEST['title'] != ''){
        $title = ($_REQUEST['title']);
    }
  
    
    $sql ="INSERT into `orders` (book_id, price, title)
            select book_id, books.price, books.title from books
            where books.title = '".$title."'";
    
 
    if (!mysqli_query($con,$sql))
		{
			die('Error: '. mysqli_error($con));
            echo fuck;

		}
    
    $update = "Update `orders` set username = '".$user."' where title LIKE '%".$title."%'";

    
    if (!mysqli_query($con,$update))
		{
			die('Error: '. mysqli_error($con));
            echo fuck;

		}
    
    echo "Added to cart!";

    mysqli_close($con);
    header("Location: cart.php");
    exit;

?>
    </body>
</html>