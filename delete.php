<!DOCTYPE html>
<html>
    
    <head>
        
    </head>
    <body>
        <?php

     session_start();
    //display session variable if it is set
    if(isset($_SESSION["user"])){
        echo $_SESSION["user"];
        $user = $_SESSION["user"];
    }

     $con = mysqli_connect("localhost","root","","dt211");
    
            //check connection
            if(mysqli_connect_errno())
            {
                echo "Failed to connect to MYSQL: ". mysqli_connect_errno();
            }
    
           $sql = "DELETE FROM `orders` WHERE username = '".$user."'";
               
            if (!mysqli_query($con,$sql)){
                
                die('Error: '. mysqli_error($con));
            }

    header("Location: cart.php");
   exit;
        ?>
    </body>
</html>

    
