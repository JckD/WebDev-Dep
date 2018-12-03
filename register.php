<!DOCTYPE html>
<!--
    Web developement and deployment
    Group Assignment
    Jack Doyle | Casey Ogbevoen
    Registration Page of The Book Shop
-->
<?php
    //initialise variables to empty strings
    $username = $email = $address1 = $address2 = $password1 = $password2 = "";
        
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
            //prepare statement for sql insertion
            $sql = $con->prepare("INSERT INTO user (username, email, address, password, image) VALUES (?, ?, ?, ?, ?)");
            
            //if any field is empty
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
                array_push($errors,"*Please Confirm Password.");
            }
            
            //test input function
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            
            //get data from form
            $username = test_input($_POST["username"]);
            $email = test_input($_POST["email"]);
            
            $address1 = test_input($_POST["address1"]);
            $address2 = test_input($_POST["address2"]);
            //concatonate address line 1 and line 2
            $address = $address1 . ", " . $address2;
            
            //if passwords do not match
            if ($_POST["password1"] != $_POST["password2"]) {
                array_push($errors, "*Passwords do not match.");
             }
            $password1 = test_input($_POST["password1"]);
            $password2 = test_input($_POST["password2"]);
            
            //password must be greater than 8 characters
            if(strlen($password1) < 8){
                array_push($errors, "*Password must be at least 8 characters.");
            }
            
            //ensure only valid data is entered
            //username - only letters and white space
            if (!preg_match("/^[a-zA-Z0-9_,' ]*$/",$username)) {
              array_push($errors, "*Only alphanumeric characters allowed in the Username field."); 
            }
            //email - valid email address
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              array_push($errors,"*Invalid email format."); 
            }
            //address - allow letters, numbers and commas
            if (!preg_match("/^[a-zA-Z0-9_,' ]*$/",$address)) {
              array_push($errors, "*Only alphanumeric characters are allowed in the Address fields."); 
            }
            //password - only letters numbers and underscores
            if (!preg_match("/^[a-zA-Z0-9_,' ]*$/",$password1)) {
              array_push($errors, "*Only alphanumeric characters are allowed in the Password field."); 
            }

            if(!$errors){
                //$sql = $con->prepare("INSERT INTO user (username, email, address, password, image) VALUES ('$username', '$email', '$address', '$password', 'uploads/user.jpg')");
                
                //encrypt the password
                $password = password_hash($password1, PASSWORD_DEFAULT);
                
                //initialise image
                $image = "uploads/user.jpg";
                
                //insert data into database    
                $sql->bind_param("sssss", $username, $email, $address, $password, $image);
                $sql->execute();
                
                //set username as session variable
                $_SESSION["user"] = $username;
                
                //close connection
                $sql->close();
                
                //view user profile
                header("location: profile.php");
            }
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
                <li>
                    <!-- Display profile picture adn link to profile page if user is logged in -->
                    <div><a href="profile.php">
                            <?php
                                include("userloggedin.php");
                            ?>
                        </a>
                    </div>
                </li>
                <!--Icon button that links to user's cart-->
                 <li>
                    <a href="cart.php" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                </li>
                <li class="active dropdown">
                    <!-- User Icon button dropdown button to log in/out and user porfile pages-->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="profile.php"> My Profile </a></li>
                        <li class="active"><a href="login.php"> Log In</a></li>
                        <li><a href="logout.php"> Logout </a></li>
                    </ul>
                </li>
            </ul>
        </div><!--Close Nav bar div-->
            
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
        <form novalidate id= "form" style="padding-left:5%" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            
            <div class="form-group" style="padding-bottom:3%">
                <label for="username"> Username: </label>
                <input type="text" class="form-control" placeholder="Enter your Username" id="username" name="username" value="<?php echo $username; ?>" required>
            </div>

            <div class="form-group" style="padding-bottom:3%">
                <label for="email"> E-mail: </label>
                <input type="email" class="form-control" placeholder="Enter E-mail Address" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>

            <div class="form-group">
                <label for="address"> Shipping Address: </label>
                <input type="text" class="form-control" placeholder="Shipping Address Line 1" id="address1" name="address1" value="<?php echo $address1; ?>" required>
            </div>

            <div style="padding-bottom:3%">
                <input type="text" class="form-control" placeholder="Shipping Address Line 2" id="address2" name="address2" value="<?php echo $address2; ?>">
            </div>

            <div class="form-group" style="padding-bottom:3%">
                <label for="password1"> Password: </label>
                <input type="password" class="form-control" placeholder="Enter Password" id="password1" name="password1" min="8" required>
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