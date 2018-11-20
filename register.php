<!DOCTYPE html>

<?php
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
        
        if(isset($_POST["submit"])){
            
            //if any fields are empty
            if (empty($_POST["username"])) {
                array_push($errors,"*Username is required.");
            }
            if(empty($_POST["email"])){
                array_push($errors, "*E-mail is required.");
            }
            if(empty($_POST["address1"])){
                array_push($errors, "*Shipping Address is required.");
            }
            if(empty($_POST["password1"])){
                array_push($errors, "*Password is required.");
            }
            if(empty($_POST["password2"])){
                array_push($errors,"*Confirm Password.");
            }

            //if passwords do not match
            if ($_POST["password1"] != $_POST["password2"]) {
                array_push($errors, "*Passwords do not match.");
             }
            
            if(!$errors){
                //get data from form
                $username = $_POST["username"];
                $email = $_POST["email"];
                $address1 = $_POST["address1"];
                $address2 = $_POST["address2"];
                //concatonate address line 1 and line 2
                $address = $address1 . ", " . $address2;
                $password = $_POST["password1"];
                
                //set username as session variable
                $_SESSION["user"] = $username;

                /*
                //prepare insert statement
                $sql = 'INSERT INTO user (username, email, address, password) VALUES (:username, :email, :address, :password)';
                $query = $con->prepare($sql);
                $query->bindParam(':username' ,$username);
                $query->bindParam(':email' ,$email);
                $query->bindParam(':address' ,$address);
                $query->bindParam(':password' ,$password);

                //insert row
                $query->execute();
                */

                $sql = "INSERT INTO user (username, email, address, password) VALUES ('$username', '$email', '$address', '$password')";

                mysqli_query($con, $sql);
                
                header("Location: upload.php");
            }
        }
    }
?>

<script>
	function checkForm(){
		//Ensure username field isn't empty
		var username = document.getElementById("username");
		if(username == null || username == ""){
			alert("Please enter a Username");
			return false;
		}

		//ensure email field isn't empty
		var email = document.getElementById("email");
		if(email == null || email == ""){
			alert("Please enter an Email Address");
			return false;
		}

		//ensure the first address field is not empty
		var address1 = document.getElementById("address1");
		if(address1 == null || address1 == ""){
			alert("Please enter a Shipping Address");
			return false;
		}

		//ensure password was entered
		var password1 = document.getElementById("password1");
		var password2 = document.getElementById("password2");
		if(password1 == null || password1 == ""){
			alert("Please enter a Password");
			return false;
		}

		//ensure password was confirmed
		if(password2 == null || password2 == ""){
			alert("Plese confirm your Password");
			return false;
		}

		//ensure passwords match
		if(!password1.equals(password2)){
			alert("Passwords do not match");
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
                    <a href="#" class="active dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="profile.php"> My Profile </a></li>
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
        
    <h2> Create an Account </h2>
    <br>
        <form id= "form" style="padding-left:5%" action="" method="POST" onsubmit="return checkForm();">
            
            <div class="form-group" style="padding-bottom:3%">
                <label for="username"> Username: </label>
                <input type="text" class="form-control" placeholder="Enter your Username" id="username" name="username" required>
            </div>

            <div class="form-group" style="padding-bottom:3%">
                <label for="email"> E-mail: </label>
                <input type="email" class="form-control" placeholder="Enter E-mail Address" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="address"> Shipping Address: </label>
                <input type="text" class="form-control" placeholder="Shipping Address Line 1" id="address1" name="address1" required>
            </div>

            <div style="padding-bottom:3%">
                <input type="text" class="form-control" placeholder="Shipping Address Line 2" id="address2" name="address2">
            </div>

            <div class="form-group" style="padding-bottom:3%">
                <label for="password1"> Password: </label>
                <input type="password" class="form-control" placeholder="Enter Password" id="password1" name="password1" required>
            </div>

            <div class="form-group">
                <label for="password2"> Confirm Password: </label>
                <input type="password" class="form-control" placeholder="Confirm Password" id="password2" name="password2" required>
            </div>

            <br/>
            <button type="submit" class="btn btn-dark" name="submit"> Create My Account </button>
        </form>
    </div>
    <br>
</body>
</html>