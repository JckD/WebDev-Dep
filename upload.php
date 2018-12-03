<!DOCTYPE html>
<!--
    Web developement and deployment
    Group Assignment
    Jack Doyle | Casey Ogbevoen
    Page that allows User to Upload a Profile Picture
-->
<?php
    //start session
    session_start();

    $result = array();
    if(isset($_POST["submit"])){

        $img_name = $_SESSION["user"];

        //connect to database
        $con = mysqli_connect("localhost","root","","dt211");

        //check connection
        if(mysqli_connect_errno()){
            array_push($result, "Failed to connect to MYSQL: ". mysqli_connect_errno());
        }
        else{

            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Check if image file is an image
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                //array_push($result, "File is an image - " . $check["mime"] . ".");
                $uploadOk = 1;
            } else {
                array_push($result, "*File is not an image.");
                $uploadOk = 0;
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                array_push($result, "*Sorry, file already exists.");
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                array_push($result, "*Sorry, your file is too large.");
                $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                array_push($result, "*Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                array_push($result, "*Sorry, your file was not uploaded.");

            // if everything is ok, try to upload file
            }
            else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $img_name . "." . $imageFileType)) {
                    //insert path into database
                    $img = $target_dir . $img_name . "." . $imageFileType;
                    $sql = "UPDATE user SET image = '$img' WHERE username = '$img_name'";
                    mysqli_query($con, $sql);

                    array_push($result, "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.");
                    
                    header("Location: editprofile.php");
                } else {
                    array_push($result, "*Sorry, there was an error uploading your file.");
                }
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
                    <!-- Display profile picture adn link to profile page if user is logged in -->
                    <div><a href="profile.php">
                            <?php
                                include("userloggedin.php");
                            ?>
                        </a>
                    </div>
                </li>
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
    <?php
        foreach($result as $re){
            echo "<p style='color:red'>" . $re . "</p>";
        }
    ?>

    <form action="" method="post" enctype="multipart/form-data" style="padding-left: 5%">
        <div class="form-inline" style="padding-bottom: 3%">
            <h1> Upload your Profile Picture: </h1>
            <br>
            <button class="btn btn-dark"><input type="file" name="fileToUpload" id="fileToUpload"></button>
            <br>
            <button class="btn btn-dark"><input type="submit" value="Upload Image" name="submit"></button>
        </div>
    </form>
</body>
</html>