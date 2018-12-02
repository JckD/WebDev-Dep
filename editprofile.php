<!DOCTYPE html>
<!--
    Web developement and deployment
    Group Assignment
    Jack Doyle | Casey Ogbevoen
    Home Page of The Book Shop
-->
<?php 
    session_start();
    //display session variable if it is set
    if(isset($_SESSION["user"])){
        echo $_SESSION["user"];
    }
?>

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
        
        $username = $email = $address = $password = "";
        
        //test input function
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
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
                    
                    $username = test_input($_POST["username"]);
                    
                    //username - only alphanumeric characters
                    if (!preg_match("/^[a-zA-Z0-9_ ]*$/",$username)) {
                      array_push($errors, "*Only alphanumeric characters allowed in the Username field."); 
                    }
                    else{
                        //update username
                        $sql = "UPDATE user SET username = '$username' WHERE username = '$session'";
                        mysqli_query($con, $sql);

                        //update session variable
                        $_SESSION["user"] = $username;
                    }
                }
                if(!empty($_POST["email"])){
                    
                    $email = test_input($_POST["email"]);
                    
                    //email - valid email address
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                      array_push($errors,"*Invalid email format."); 
                    }
                    else{
                        //update email
                        $sql = "UPDATE user SET email = '$email' WHERE username = '$session'";
                        mysqli_query($con, $sql);
                    }
                }
                if(!empty($_POST["address1"])){
                    //update address
                    $address1 = test_input($_POST["address1"]);
                    $address2 = test_input($_POST["address2"]);
                    //concatonate address line 1 and line 2
                    $address = $address1 . ", " . $address2;
                    
                    //address - allow alphanumeric characters
                    if (!preg_match("/^[a-zA-Z0-9_, ]*$/",$address)) {
                      array_push($errors, "*Only alphanumeric characters allowed in the Address fields."); 
                    }
                    else{
                        $sql = "UPDATE user SET address = '$address' WHERE username = '$session'";
                        mysqli_query($con, $sql);
                    } 
                }
                if(!empty($_POST["password1"])){
                    //if passwords do not match
                    if ($_POST["password1"] != $_POST["password2"]) {
                        array_push($errors, "*Passwords do not match.");
                     }
                    
                    $password1 = test_input($_POST["password1"]);
                    
                    //password - only letters numbers and underscores
                    if (!preg_match("/^[a-zA-Z0-9_ ]*$/",$password1)) {
                      array_push($errors, "*Only alphanumeric characters allowed in the Password fields."); 
                    }
                    else{
                        //encrypt the password
                        $password = password_hash($password1, PASSWORD_DEFAULT);
                        
                        //update database password
                        $sql = "UPDATE user SET password = '$password' WHERE username = '$session'";
                        mysqli_query($con, $sql);
                    }
                }
                header ("location: profile.php");
            }
        }
        else{
            echo "Please <a href=". "login.php" . ">login </a> to edit your Profile.";
        }
    }
?>

<script>
	function checkForm(){
        //Ensure username field isn't empty
		var username = document.getElementById("username");
        var email = document.getElementById("email");
        var address = document.getElementById("address");
        var password1 = document.getElementById("password1");
		var password2 = document.getElementById("password2");
        
        //ensure required fields are not left empty
		if(username == null || username == ""){
			alert("Please enter a Username!");
			return false;
		}
		if(email == null || email == ""){
			alert("Please enter an Email Address!");
			return false;
		}
		if(address == null || address1 == ""){
			alert("Please enter a Shipping Address!");
			return false;
		}
		if(password1 == null || password1 == ""){
			alert("Please enter a Password!");
			return false;
		}
		if(password2 == null || password2 == ""){
			alert("Plese confirm your Password!");
			return false;
		}
        
        //ensure passwords match
		if(!password1.equals(password2)){
			alert("Passwords do not match!");
			return false;
		}
	}//end checkForm()
</script>

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
                 <li>
                    <a href="cart.php" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                </li>
                <li class="active dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span></a>
                    <ul class="dropdown-menu">
                        <li class="active"><a href="profile.php"> My Profile </a></li>
                        <li><a href="login.php"> Log In</a></li>
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
        <!-- Display Profile Picture -->
        <?php
            $sql = "SELECT image FROM user WHERE username = '$session'";
            
            $result = $con->query($sql);
        
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo "<div align='center'><img style='height: 300px; width: 300px' class='img-circle' src='" . "$row[image]" . "'/><br><br></div>";
                }
            }
        ?>
        <form id= "form" style="padding-left:5%" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" onsubmit="return checkForm();">
            <div class="form-group" style="padding-bottom:3%">
                <label for="username"> Username: </label>
                <input type="text" class="form-control" value="<?php echo $username; ?>" id="username" name="username">
                <span id="username-error" style="color: red"></span>
            </div>

            <div class="form-group" style="padding-bottom:3%">
                <label for="email"> E-mail: </label>
                <input type="email" class="form-control" value="<?php echo $email; ?>" id="email" name="email">
                <span id="email-error" style="color: red"></span>
            </div>

            <div class="form-group">
                <label for="address"> Shipping Address: </label>
                <input type="text" class="form-control" value="<?php echo $address; ?>" id="address" name="address">
                <span id="address-error" style="color: red"></span>
            </div>

            <div class="form-group" style="padding-bottom:3%">
                <label for="password1"> Password: </label>
                <input type="password" class="form-control" placeholder="Enter New Password" id="password1" name="password1">
            </div>

            <div class="form-group">
                <label for="password2"> Confirm Password: </label>
                <input type="password" class="form-control" placeholder="Confirm New Password" id="password2" name="password2">
                <span id="password-error" style="color: red"></span>
            </div>

            <br/>
            <button type="submit" class="btn btn-dark" name="submit"> Save Changes </button>
            <a href="upload.php"><button class="btn btn-dark"> Upload Profile Picture </button></a>
        </form>
    </div>
    <br>
</body>
</html>