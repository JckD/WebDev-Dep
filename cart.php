<!DOCTYPE html>
<!--
    Web developement and deployment
    Group Assignment
    Jack Doyle | Casey Ogbevoen
    1984.php
    Web page that displays the user's
    cart
-->
<?php 
    //Start session
    session_start();
    $user = $_SESSION["user"];
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
    <link rel="icon" href="http://icons.iconarchive.com/icons/icons8/windows-8/128/Printing-Book-icon.png" type="image/ico"> 

    <body>

        <h1> The Book Shop </h1>

        <!-- Header - to navigate the site -->
        <nav class="navbar navbar-inverse navbar-default">
            <!--Open Nav bar div-->
            <div class="container-fluid">
                <ul class="nav navbar-nav">
                    <!--Home button that links to home page-->
                    <li><a href="index.php"> Home </a></li>
                    <!--Books button that links to products.php-->
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
                    <!--Icon Button that links to user's cart-->
                    <li class="active">
                        <a href="cart.php" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                    </li>
                    <!--User Icon button dropdown to log iun/out and user profile pages-->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="profile.php"> My Profile </a></li>
                            <li><a href="login.php"> Log In</a></li>
                            <li><a href="logout.php"> Logout </a></li>
                        </ul>
                    </li>

                </ul>
            </div><!--Close nav bar div-->

            <!-- Library Image -->
            <img style="height:20%;width:100%" src="library2crop.jpg"/>
        </nav>

            <div style=" width: 75%; display: block; margin-left:12%"> 
                
                <h3>Your Shopping Cart:</h3>
                
                <table class="table table-hover" style = "margin-top:20px;
                                             text-align: center;
                                             font-size: 20px;
                                             width: 100%" id='table'>

                    <?php 

                        //Check if the suer is logged in to view cart
                        if(isset ($_SESSION["user"])){
                             //connect to database
                            $con = mysqli_connect("localhost","root","","dt211");

                            //check connection
                            if(mysqli_connect_errno())
                            {
                                echo "Failed to connect to MYSQL: ". mysqli_connect_errno();
                            }
                            //statement to select the user's cart from the oders table
                            $sql = "SELECT title,price,quantity FROM orders where username = '".$user."'";

                            //excute query
                            $result = $con->query($sql);
                            //set tiem variable  =1 to number cart items for reference
                            $item = 1;
                            $name = '';
                            
                            
                            //Echo user's cart
                            if ($result->num_rows > 0)
                            {
                                //echo table titles
                                echo       '<tr>';
                                echo            '<th scope="col" style="width: 20%;text-align: center; vertical-align: middle">Cover</th>';
                                echo            '<th scope="col" style="width: 20%;text-align: center; vertical-align: middle">Title</th>';
                                echo            '<th scope="col" style="width: 20%;text-align: center; vertical-align: middle">Price</th>';
                                echo            '<th scope="col" style="width: 20%;text-align: center; vertical-align: middle">Quantity</th>';
                                echo        '</tr>';

                                //while loop to echo user's cart use $row[title] to link to item pages
                                //Quantity column uses increase() and decrease() script functions onlick pass the "item" var 
                                while($row = $result->fetch_assoc())
                                {
                                    //store each title to pass later
                                    $t = json_encode($row['title']);
                              
                                    echo "<tr>

                                            <td style='text-align: center; vertical-align: middle'>
                                            <a href='"."$row[title]".".php'><img style='width:25%' src='"."$row[title]".".jpg'
                                            </td>

                                            <td style='text-align: center; vertical-align: middle;'>
                                            <a href='"."$row[title]".".php'>"."$row[title]". "
                                            </td>
                                            <td style='text-align: center; vertical-align: middle;'>
                                            <a href='"."$row[title]".".php'>$"."$row[price]"."
                                            </td>
                                            <td style='text-align: center; vertical-align: middle;'id='quantity'>
                                            <p id='"."$item"."'>"."$row[quantity]"."</p><br>
                                            <button  class='btn btn-dark' style='margin-right:3px;margin-left: 5px' onclick='increase($item,$t)' >+</button>
                                            <button  class='btn btn-dark' onclick='decrease("."$item".",$t)' >-</button>
                                            </td>
                                        </tr>"; 
                                    //increment $item to ref each book in the table
                                    $item = $item +1;

                                }//end while

                                  //echo buttons to "Continue Shopping" "empty cart" and "Place order
                                  echo " <div style='float: left; margin-right: 0px' class='btn-group' role='group' aria-label='Basic example'>
                                            <form class='px-4 py-3' action='products.php'>
                                                <input class='btn btn-secondary' type='submit' style='margin-left: 10px' value='Continue Shopping' href='products.php'>
                                           </form>
                                        </div>

                                        <div style='float: left; margin-right: 0px' class='btn-group' role='group' aria-label='Basic example'>

                                            <form class='px-4 py-3' action='delete.php'>

                                                <input class='btn btn-secondary' type='submit' style='margin-left: 10px' value='Delete Cart'> 
                                            </form>

                                        </div>
                                        <div style='float: right; margin-bottom: 100px'>

                                            <form action='order.php' method='post'>
                                                <input class='btn btn-dark' type='submit' style='margin-left: 10px'
                                                value='Place Order' onlcik=checkval()>

                                            </form>
                                        </div>";

                            }//end if

                            //if there is nothing in the user's cart echo that it is empty
                            else {
                                echo "Your cart is empty!";
                            }//end else
                        }//end if

                        //if the user's is not loffed in they can't view cart link to login page
                        else{
                            echo "Please <a href=". "login.php" . ">login </a> to see your Cart.";
                        }//end else
                    //emd php
                    ?>

                </table><!--End table-->
            </div><!--end div-->
    </body>
    <script>
        //Increase Function takes "Item" variable
        //Increases "Quantity" column for each book
        function increase(item, title){
            
            //get the current quantity number from the table
            var amount = document.getElementById(item)
            //get the text content of "amount" convert it to a number
            var quantity = Number(amount.textContent) ;
            //increment quantity
            quantity++;
            //set max limit of 99 to quantity
            //if quantity is 99 keep it at 99
            if (quantity > 99){
                 quantity = 99;
            };//end if
            
            //make the text content of "amount" = "quantity"
            amount.textContent = quantity;
            
            //Asnychronous Communication to upadte order table
            $.ajax({
                url : 'updatequantity.php',
                method : 'post',
                data : {title:title,quantity: quantity},
                success : function(response){
                    
                }
            })
            
        };//end increase function

        //Decrease Funtion takes "Item" variable 
        //Decreases "Quantity" column for each book
        function decrease(item, title){
            
            //get the current quantity number from the table
            var amount = document.getElementById(item)
            //get the text content of "amount" convert it to a number
            var quantity = Number(amount.textContent);
            //decrement the quantity 
            quantity--;
            //set the limit of 99 to quantity
            //if quantity is 0 keept it at 0
            if (quantity <= 0){
                quantity =0;
                       
            };//end if
            
            //make the text content of "amount" = "quantity"
            amount.textContent = quantity;
            console.log(quantity);
            //Asynchronous Communication to update orer table
             $.ajax({
                url : 'updatequantity.php',
                method : 'post',
                data : {title:title, quantity: quantity},
                success : function(response){
                    
                }
             })
            
            
        };//end decrease
        
  
        //fucntion for popover on "+" button
        $(function () {
             $('[data-toggle="popover"]').popover()
        })
        
    
    </script>
</html>