<!DOCTYPE html>
<!--
    Web developement and deployment
    Group Assignment
    Jack Doyle | Casey Ogbovoen
    delete.php
    php that deletes all items from
    oders table that match the logged in user
-->
<html>
    
    <head>
        
    </head>
    <body>
        <?php
            //check user logged in
            session_start();
            //display session variable if it is set
            if(isset($_SESSION["user"])){
                echo $_SESSION["user"];
                $user = $_SESSION["user"];
            }
            //connect to db
            $con = mysqli_connect("localhost","root","","dt211");
    
            //check connection
            if(mysqli_connect_errno())
            {
                echo "Failed to connect to MYSQL: ". mysqli_connect_errno();
            }
            //sql to delete from orders for the user logged in
            $sql = "DELETE FROM `orders` WHERE username = '".$user."'";
               
            if (!mysqli_query($con,$sql)){
                
                die('Error: '. mysqli_error($con));
            }
            //link back to cart page
            header("Location: cart.php");
            exit;
        ?>
    </body>
</html>

    
