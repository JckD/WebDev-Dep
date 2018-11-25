<!DOCTYPE html>
<!--
    Web developement and deployment
    Group Assignment
    Jack Doyle | Casey Ogbovoen
    searchResults.php
    Displays the seach results of a search
-->
<?php 
    //start session
    session_start();
    //display session variable if it is set
    if(isset($_SESSION["user"])){
        echo $_SESSION["user"];
    }
?>

<html>
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
<?php //echo $login_session; ?>

    <body>

        <h1> The Book Shop </h1>
            <!-- Header - to navigate the site -->
        <nav class="navbar navbar-inverse navbar-default">
            <div class="container-fluid">
                <ul class="nav navbar-nav">
                    <!--Home button that links to the home page-->
                    <li><a href="index.php"> Home </a></li>
                    <!--Books button that links to products.php-->
                    <li><a href="products.php">Books</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <!-- Icon Button links to user's cart-->
                     <li>
                        <a href="cart.php" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                    </li>
                    <!--User Icon button dropdown button to log in/out and user porfile pages-->
                    <li class="active dropdown">
                        <a href="#" class="active dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="profile.php"> My Profile </a></li>
                            <li><a href="login.php"> Log In</a></li>
                            <li><a href="logout.php"> Logout </a></li>
                        </ul>
                    </li>
                </ul>
            </div><!--Close Nav bar div-->

            <!-- Library Image -->
            <img style="height:20%;width:100%" src="library2crop.jpg" alt="Our Store"/>
        </nav>
        <br>

            <div style="padding: 0%; margin-left: 0
                        %">
                <!-- Search Bar -->
                <div class="form-group" style="margin-left: 12%">

                    <form action="searchResults.php" class="form-inline justtify-content-center" method="">
                        <input type="text" 
                               class="form-control"
                               name = "search" 
                               placeholder="Something else...?"/>
                        <button type="submit" class="btn btn-dark" href = "searchResults.php"> Search </button>

                    </form>

                <!-- Genre button groups to filter search results-->    
                </div>
                  <div class="btn-group" role="group" aria-label="Basic example" style="margin-left: 12%">
                    <form class="px-4 py-3" method="post">
                        <input name="genre" type="submit" value="Crime" class="btn btn-secondary">
                        <input name="genre" type="submit" value="Horror" class="btn btn-secondary">
                        <input name="genre" type="submit" value="Political" class="btn btn-secondary">
                        <input name="genre" type="submit" value="Autobiography" class="btn btn-secondary">
                    </form>
                </div>       
            </div>
        <br>

        <div style=" width: 75%; display: block; margin-left:12%"> 
            <table class="table table-hover" style="margin-top:20px;
                                         text-align: center;
                                         font-size: 20px;
                                         width: 100%">


                <?php
                    //initialise term and genre vars
                    $term = '';
                    $genre ='';

                    //connect to database
                    $con = mysqli_connect("localhost","root","","dt211");

                    //check connection
                    if(mysqli_connect_errno())
                    {
                        echo "Failed to connect to MYSQL: ". mysqli_connect_errno();
                    }

                    //take the string that the user searchd for
                    if(isset($_REQUEST['search']) && $_REQUEST['search'] != ''){
                        $term = ($_REQUEST['search']);
                    }

                     if(isset($_REQUEST['genre']) && $_REQUEST['genre'] != ''){
                        $genre = ($_REQUEST['genre']);
                    }

                    //prepared statement  
                    //use the string to search for a book,author, publisher,genre or description matching that string
                    $query = "select * from (SELECT * FROM books WHERE  title LIKE ?
                                                OR author LIKE ?
                                                OR publisher LIKE ?
                                                OR genre LIKE ?
                                                OR descr LIKE ?)as search where genre like ?";

                    $filter = $con->prepare($query);


                    //wildcard variables 
                    $term = "%{$term}%";
                    $genre = "%{$genre}%";


                    //bind
                    $filter->bind_param("ssssss", $term, $term, $term, $term, $term, $genre);


                    //execute query
                    $filter->execute();

                    //get result of query        
                    $result = $filter->get_result();



                    //search results dispay echo
                        //display table titles
                        //display table contents
                        //uses the result varible to get the cover image from folder
                        // and link to each books individual page
                    if ($result->num_rows > 0)
                    {

                        echo       '<tr>';
                        echo            '<th scope="col" style="width: 25">Cover</th>';
                        echo            '<th scope="col" style="width: 30%;">Title</th>';
                        echo            '<th scope="col" style="width: 30%; ">Author</th>';
                        echo            '<th scope="col" style="width: 30%; ">Price</th>';
                        echo        '</tr>';

                        while($row = $result->fetch_assoc())
                        {
                            //echo table row
                            //cover, Title, Author, Price
                            echo "<tr>

                                    <td style='text-align: center; vertical-align: middle'>
                                        <a href='"."$row[title]".".php'><img style='width:100%' src='"."$row[title]".".jpg'
                                    </td>

                                    <td style='text-align: center; vertical-align: middle;'>
                                        <a href='"."$row[title]".".php'>"."$row[title]". "
                                    </td>

                                    <td style='text-align: center; vertical-align: middle;'>
                                        <a href='"."$row[title]".".php'>"."$row[author]"."
                                    </td>

                                    <td style='text-align: center; vertical-align: middle;'>
                                        <a href='"."$row[title]".".php'>$"."$row[price]"."
                                    </td>

                                 </tr>";
                        }

                    }

                    //if no titles match the search 
                    else {
                        echo "No results found.";
                    }
                ?>
            </table>
        </div>

        <br/>
    </body>
</html>