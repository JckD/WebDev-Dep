<?php
    
    session_start();

    if(isset($_SESSION["user"])){
        $user = $_SESSION["user"];
        
    };

    $q = $_POST["quantity"];
    $t = $_POST["title"];
    

    $con = mysqli_connect("localhost","root","","dt211");
       
    if(mysqli_connect_errno()){
        echo "failed to connect to MYSQL: ". mysqli_conncet_errno();
    };

    //if ($q <= 0){
        
        
       // $sql = "delete from `orders` where quantity = ".$q." 
                                        //and title = '".$t."'" ;
    //}
    //else{
        
        $sql = "UPDATE `orders` SET quantity = ".$q." where username = '".$user."'
                                                    AND title = '".$t."'";
        
   // };
    
    if(!mysqli_query($con,$sql)){
        die('Error: '.mysqli_error($con));
    };

    
?>