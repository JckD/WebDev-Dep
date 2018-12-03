<?php
/*
    Web developement and deployment
    Group Assignment
    Jack Doyle | Casey Ogbevoen
    update quantity.php
    PHP that uses ajax to communicate
    the quantity of the items in the
    user's cart
*/
    
    //start session
    session_start();
    
    //check if user is logged on
    if(isset($_SESSION["user"])){
        $user = $_SESSION["user"];
        
    };
    
    //get the POSTed quantity and title values.
    $q = $_POST["quantity"];
    $t = $_POST["title"];
    
    //connect to the database
    $con = mysqli_connect("localhost","root","","dt211");
    
    //eeror check the connection
    if(mysqli_connect_errno()){
        echo "failed to connect to MYSQL: ". mysqli_conncet_errno();
    };

    //sql to upadate the order
    $sql = "UPDATE `orders` SET quantity = ".$q." where username = '".$user."'
                                                    AND title = '".$t."'";
    //run sql
    if(!mysqli_query($con,$sql)){
        die('Error: '.mysqli_error($con));
    };

      
?>