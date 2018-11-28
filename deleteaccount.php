<!DOCTYPE html>
<!--
    Web developement and deployment
    Group Assignment
    Jack Doyle | Casey Ogbovoen
    order.php
    Page that deletes the user's account
-->
<?php
    //initialise variables to empty strings
    $password1 = $password2 = "";

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
            
            function test_input($data) {
              $data = trim($data);
              $data = stripslashes($data);
              $data = htmlspecialchars($data);
              return $data;
            }
            
            //get data from form
            $password = test_input($_POST["password1"]);
            
            if(!$errors){
                $session = $_SESSION["user"];
                
                //get row from database
                $password_sql = "SELECT password FROM user WHERE username = '$session'";
                $result = $con->query($password_sql);
                
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $hashed_password = $row[password];
                    }
                }
                
                //verify password match
                if(password_verify($password,$hashed_password)){
                    //delete user from database
                    $sql = "DELETE FROM user WHERE username = '$session'";
                    mysqli_query($con, $sql);
                    
                    //unset and delete session
                    session_unset();
                    session_destroy();
                    
                    //continue to edit profile
                    header("location: index.php");
                }
                else {
                    //display error
                    array_push($errors, "*Invalid Password, Please try again.");
                }
            }
        }    
    }
?>

<script>
	function checkForm(){
        //Ensure username field isn't empty
        var password1 = document.getElementById("password1");
		var password2 = document.getElementById("password2");
        
		//Ensure username field isn't empty
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
                 <li>
                    <a href="cart.php" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                </li>
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
        
		<h2> Confirm your Password </h2>
		<form style="padding-left:5%" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" onsubmit="return checkForm();">
			<div class="form-group">
                <label for="password1"> Password: </label>
                <input type="password" class="form-control" placeholder="Enter Password" id="password1" name="password1" required>
            </div>

            <div class="form-group">
                <label for="password2"> Confirm Password: </label>
                <input type="password" class="form-control" placeholder="Confirm Password" id="password2" name="password2" required>
            </div>

			<br>
			<!--<button type="submit" class="btn btn-dark" name="submit"> Confirm </button>-->
            
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModalCenter">
              Confirm
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <!--h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5-->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      <h4> Are you sure you want to Delete your Account? </h4>
                      <br>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal"> Close </button>
                    <button type="submit" name="submit" class="btn btn-primary"> Continue </button>
                  </div>
                </div>
              </div>
            </div>
        </form>
    </div>
    </body>
</html>