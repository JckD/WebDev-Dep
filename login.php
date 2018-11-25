<!DOCTYPE html>
<!--
    Web developement and deployment
    Group Assignment
    Jack Doyle | Casey Ogbovoen
    login.php
    page that lets user log in
-->
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
            if(empty($_POST["password"])){
                array_push($errors, "*Password is required.");
            }
            
            if(!$errors){
                // username and password sent from form 
                $username = $_POST["username"];
                $password = $_POST["password"];

                //set username as session variable
                $_SESSION["user"] = $username;

                $sql = "SELECT username FROM user WHERE username = '$username' and password = '$password'";

                $result = $con->query($sql);

                // If result matched $myusername and $mypassword, table row must be 1 row
                if($result->num_rows == 1) {
                    echo("Logged In as: " . $_SESSION["user"]);
                    header("Location: profile.php");
                }
                else {
                    $form["username"] = $form["password"] =  '';
                    array_push($errors, "*Invalid Login Details.");
                }
            }
        }    
    }
?>

<script>
	function checkForm(){
		//Ensure username field isn't empty
		var username = document.getElementById("username");
		if(username == null || username == ""){
			alert("Please enter your Username.");
			return false;
		}

		//ensure password was entered
		var password = document.getElementById("password");
		if(password == null || password == ""){
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
                <!--Home button that links to the home page-->
                <li><a href="index.php"> Home </a></li>
                <!--Books button that links to porducts.php-->
                <li><a href="products.php">Books</a></li>
            </ul>
                
            <ul class="nav navbar-nav navbar-right">
                <!--Icon that links to the user's cart-->
                 <li>
                    <a href="cart.php" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                </li>
                <!--User Icon button dropdown button to log in/out and user porfile pages-->
                <li class="active dropdown">  
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="profile.php"> My Profile </a></li>
                        <li class="active"><a href="login.php"> Log In</a></li>
                        <li><a href="logout.php"> Logout </a></li>
                    </ul>
                </li>
            </ul>
        </div><!--Close nav bar div-->
            
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
        
		<h2> Log In </h2>
		<form style="padding-left:5%" action="login.php" method="post" onsubmit="return checkForm();">
			<div class="form-group">
				<label for="username"> Username: </label>
				<input type="text" class="form-control" placeholder="Enter Username" id="username" name="username" required>
			</div>

			<div class="form-group">
				<label for="password"> Password: </label>
				<input type="password" class="form-control" placeholder="Enter Password" id="password" name="password" required>
			</div>

			<br>
			<button type="submit" class="btn btn-dark" name="submit"> Login </button>
            
            <br>
            <br>
			<p>
				Don't have an account yet? <a href="register.php"> Sign Up! </a>
			</p>
		</form>
	</div>
    </body>
</html>