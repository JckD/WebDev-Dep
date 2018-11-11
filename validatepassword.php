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
            if (empty($_POST["password1"])) {
                array_push($errors,"*Password is required.");
            }
            if(empty($_POST["password2"])){
                array_push($errors, "*Password is required.");
            }
            //if passwords do not match
            if ($_POST["password1"] != $_POST["password2"]) {
                array_push($errors, "*Passwords do not match.");
             }
            
            if(!$errors){
                // username and password sent from form 
                $password1 = $_POST["password1"];
                $password2 = $_POST["password2"];
                
                $session = $_SESSION["user"];

                $sql = "SELECT password FROM user WHERE username = '$session' and password = '$password1'";

                $result = $con->query($sql);

                // If result matched $myusername and $mypassword, table row must be 1 row
                if($result->num_rows == 1) {
                    header("Location: http://localhost/WebDev-Dep-master/editprofile.php");
                }
                else {
                    //$form["password1"] = $form["password2"] =  '';
                    array_push($errors, "*Error, re-Confirm your Password.");
                }
            }
        }    
    }
?>

<script>
	function checkForm(){
		//Ensure username field isn't empty
		var password1 = document.getElementById("password1");
		if(password1 == null || password1 == ""){
			alert("Please enter your Password.");
			return false;
		}

		//ensure password was entered
		var password2 = document.getElementById("password2");
		if(password2 == null || password2 == ""){
			alert("Please enter your Password.");
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

<body>
    
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="profile.php"> My Profile </a></li>
                        <li class="active"><a href="validatepassword.php"> Edit Profile </a></li>
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
        
        <!-- display any errors -->
        <?php
            foreach($errors as $err){
                echo '<p style="color:red">' . $err . '</p>';
            }
        ?>
        
		<h2> Please Confirm your Password to Change your Details </h2>
		<form style="padding-left:5%" action="login.php" method="post" onsubmit="return checkForm();">
			<div class="form-group">
                <label for="password1"> Password: </label>
                <input type="password" class="form-control" placeholder="Enter Password" id="password1" name="password1" required>
            </div>

            <div class="form-group">
                <label for="password2"> Confirm Password: </label>
                <input type="password" class="form-control" placeholder="Confirm Password" id="password2" name="password2" required>
            </div>

			<br>
			<button type="submit" class="btn btn-dark" name="submit"> Confirm </button>
            <br>
		</form>
	</div>
    </body>
</html>