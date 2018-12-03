<?php
    if(isset ($_SESSION["user"])){
    //connect to database
    $con = mysqli_connect("localhost","root","","dt211");

    //check connection
    if(mysqli_connect_errno())
    {
        echo "Failed to connect to MYSQL: ". mysqli_connect_errno();
    }
            
    //store session username in a variable
    $session = $_SESSION["user"];

    $sql = "SELECT image FROM user WHERE username = '$session'";

    $result = $con->query($sql);

    if($result->num_rows > 0){

        while($row = $result->fetch_assoc()){
            echo "<img style='height: 40px; width: 40px' class='img-circle' src='" . "$row[image]" . "'/>";
        }
    }
            
}
    ?> 