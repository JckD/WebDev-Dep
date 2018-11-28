<?php
    //connect to database
    $con = mysqli_connect("localhost","root","","dt211");
    
    //check connection
    if(mysqli_connect_errno()){
        echo "Failed to connect to MYSQL: ". mysqli_connect_errno();
    }
?>