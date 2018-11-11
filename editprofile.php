<!DOCTYPE html>

<?php
    error_reporting(E_ERROR | E_PARSE);
    
    //start session
    session_start();

    //connect to database
    $con = mysqli_connect("localhost","root","","dt211");

    //check connection
    if(mysqli_connect_errno()){
        echo "Failed to connect to MYSQL: ". mysqli_connect_errno();
    }
    else{
        
        $errors = array();
        
        $username = "";
        $email = "";
        $address = "";
        $password = "";
        
        if(isset($_SESSION["user"])){
            //store session info in a variables
            $session = $_SESSION["user"];

            $sql = "SELECT username, email, address FROM user WHERE username = '$session'";

            $result = $con->query($sql);

            if($result->num_rows > 0){

                while($row = $result->fetch_assoc()){
                    $username = $row[username];
                    $email = $row[email];
                    $address = $row[address];
                    $password = $row[password];
                }
            }

            if(isset($_POST["submit"])){

                //if any fields are not empty
                if (!empty($_POST["username"])) {
                    //update username
                    $username = $_POST["username"]; 
                    $sql = "UPDATE user SET username = '$username' WHERE username = '$session'";
                    mysqli_query($con, $sql);
                }
                if(!empty($_POST["email"])){
                    //update email
                    $email = $_POST["email"]; 
                    $sql = "UPDATE user SET email = '$email' WHERE username = '$session'";
                    mysqli_query($con, $sql);
                }
                if(!empty($_POST["address1"])){
                    //update address
                    $address1 = $_POST["address1"];
                    $address2 = $_POST["address2"];

                    //concatonate address line 1 and line 2
                    $address = $address1 . ", " . $address2;

                    $sql = "UPDATE user SET address = '$address' WHERE username = '$session'";
                    mysqli_query($con, $sql);
                }
                if(!empty($_POST["password1"])){
                    //update password
                    $password1 = $_POST["password1"];
                    $password2 = $_POST["password2"];

                    if($password1 == $password2){
                        $sql = "UPDATE user SET password = '$password1' WHERE username = '$session'";
                        mysqli_query($con, $sql);
                    }
                }
                header ("Location: http://localhost/WebDev-Dep-master/profile.php");
            }
        }
        else{
            echo "Please <a href=". "login.php" . ">login </a> to edit your Profile.";
        }
    }
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

<body >
    
    <h1> The Book Shop </h1>
    
	<!-- Header - to navigate the site -->
	<nav class="navbar navbar-inverse navbar-default">
		<div class="container-fluid">
			<ul class="nav navbar-nav">
                <li><a href="index.php"> Home </a></li>
                <li><a href="products.php">Books</a></li>
            </ul>
                
            <ul class="nav navbar-nav navbar-right">
                <li class="active dropdown">
                    <a href="#" class="active dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="profile.php"> My Profile </a></li>
                        <li class="active"><a href="editprofile.php"> Edit Profile </a></li>
                        <li><a href="logout.php"> Logout </a></li>
                    </ul>
                </li>
            </ul>
        </div>
            
		<!-- Library Image -->
		<img style="height:20%;width:100%" src="library2crop.jpg"/>
	</nav>

	<div class="container" style="width:50%">
        
    <!-- display any errors from php -->
    <?php
        foreach($errors as $err){
                echo '<p style="color:red">' . $err . '</p>';
        }
    ?>
        
    <h2> Edit Your Details </h2>
    <br>
        <form id= "form" style="padding-left:5%" action="" method="POST" onsubmit="return checkForm();">
            <div class="form-group" style="padding-bottom:3%">
                <label for="username"> Username: </label>
                <input type="text" class="form-control" placeholder="<?php echo $username; ?>" id="username" name="username">
            </div>

            <div class="form-group" style="padding-bottom:3%">
                <label for="email"> E-mail: </label>
                <input type="email" class="form-control" placeholder="<?php echo $email; ?>" id="email" name="email">
            </div>

            <div class="form-group">
                <label for="address"> Shipping Address: </label>
                <input type="text" class="form-control" placeholder="<?php echo $address; ?>" id="address" name="address">
            </div>

            <div class="form-group" style="padding-bottom:3%">
                <label for="password1"> Password: </label>
                <input type="password" class="form-control" placeholder="******" id="password1" name="password1">
            </div>

            <div class="form-group">
                <label for="password2"> Confirm Password: </label>
                <input type="password" class="form-control" placeholder="******" id="password2" name="password2">
            </div>

            <br/>
            <button type="submit" class="btn btn-dark" name="submit"> Save Changes </button>
        </form>
    </div>
    <br>
</body>
</html>