<!DOCTYPE html>
<!--
    Web developement and deployment
    Group Assignment
    Jack Doyle | Casey Ogbovoen
    Home Page of The Book Shop
-->
<?php
    //start session
    session_start();
?>

<html lang="en">  
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="stylesheet.css">

        <!-- CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    
<title> The Book Shop </title>
    
    <body >
        <!-- Jquery animation script - Toggles images on page -->
        <script>
            $(document).ready(function(){
                $("h1").click(function(){
                    $("img").animate({
                        height: 'toggle'
                    });
                });
            });
        </script>
        
        <h1> The Book Shop </h1>
        
        <!-- Header - to navigate the site -->
        <nav class="navbar navbar-inverse navbar-default">
            <div class="container-fluid">
                <ul class="nav navbar-nav">
                    <!--Home button that links to the home page-->
                    <li class="active"><a href="index.php"> Home </a></li>
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
                    <!--Icon button that links to user's cart-->
                     <li>
                        <a href="cart.php" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                    </li>
                    <li class="dropdown">
                        <!-- User Icon button dropdown button to log in/out and user porfile pages-->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="profile.php"> My Profile </a></li>
                            <li><a href="login.php"> Log In</a></li>
                            <li><a href="logout.php"> Logout </a></li>
                        </ul>
                    </li>
                </ul>
            </div><!--Close Nav bar div-->

            <!-- Library Image -->
            <img iid="img" style="height:20%;width:100%" src="library2crop.jpg"/>
        </nav>
        <br>
        
        <!-- Page Content -->
        <div style="padding-left: 3%; padding-right: 3%">
            
        <div style="align: center">
            <h1>
                <span class="txt-rotate" data-period="2000" data-rotate='[ "Welcome!" ]'></span>
            </h1>
        </div>
        

        <script>
            /***************************************************************************************
            *    Title: Typing Carousel
            *    Author: Jake Rocheleau
            *    Date: June 10th, 2018
            *    Availability: https://speckyboy.com/css-javascript-text-animation-snippets/
            ***************************************************************************************/
            var TxtRotate = function(el, toRotate, period) {
                this.toRotate = toRotate;
                this.el = el;
                this.loopNum = 0;
                this.period = parseInt(period, 10) || 2000;
                this.txt = '';
                this.tick();
                this.isDeleting = false;
            };

            TxtRotate.prototype.tick = function() {
            var i = this.loopNum % this.toRotate.length;
            var fullTxt = this.toRotate[i];

            if (this.isDeleting) {
                this.txt = fullTxt.substring(0, this.txt.length - 1);
            } else {
                this.txt = fullTxt.substring(0, this.txt.length + 1);
            }
            
            this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

            var that = this;
            var delta = 300 - Math.random() * 100;

            if (this.isDeleting) { delta /= 2; }

            if (!this.isDeleting && this.txt === fullTxt) {
                delta = this.period;
                this.isDeleting = true;
            } else if (this.isDeleting && this.txt === '') {
                this.isDeleting = false;
                this.loopNum++;
                delta = 500;
            }

            setTimeout(function() {
                that.tick();
              }, delta);
            };

            window.onload = function() {
              var elements = document.getElementsByClassName('txt-rotate');
              for (var i=0; i<elements.length; i++) {
                    var toRotate = elements[i].getAttribute('data-rotate');
                    var period = elements[i].getAttribute('data-period');
                  if (toRotate) {
                    new TxtRotate(elements[i], JSON.parse(toRotate), period);
                  }
                }
            
                // INJECT CSS
                var css = document.createElement("style");
                css.type = "text/css";
                css.innerHTML = ".txt-rotate > .wrap { border-right: 0.08em solid #666 }";
                document.body.appendChild(css);
            };
            /**************************************************************************************/
        </script>
        <br>
            
        <p>
            Hello, thank you for visiting our website! We hope you find everything you're looking for. Don't forget to use our handy search box to make finding your next read quicker and easier. Happy Reading!
        </p>
        <br>

        <!-- Search Bar -->
        <form action="searchResults.php" class="form-inline" method="post">
            <div class="form-group">
                <input type="text" 
                       class="form-control"
                       name = "search" 
                       placeholder="Search for a something..."/>
                <button type="submit" class="btn btn-dark" href = "searchResults.php"> Search </button>
            </div>
        </form>

        <br/>
             <!-- Top Picks Div-->
            <div style="padding-bottom: 20%;">
                <div style="text-alignt: left"><h3>Top Picks:</h3></div>
                <div style="padding-bottom: 20%">
                    <div style="width: 30%; float: left">
                        <a href='Dracula.php'><img style='width:62%' src='Dracula.jpg'> </a>
                        <h4 style="margin-left:23%">Dracula</h4>
                    </div>
                    <div style="width: 30%; float: left">
                        <a href='One%20Direction%20Where%20We%20Are.php'><img style='width:70%' src='One%20Direction%20Where%20We%20Are.jpg'> </a>
                        <h4 style="margin-left: 0%">One Direction: Where we are Now</h4>
                    </div>
                    <div style="width: 30%; float: left">
                        <a href='Detective%20Comics%2027.php'><img style='width:65%' src='Detective%20Comics%2027.jpg'> </a>
                        <h4 style="margin-left: 10%">Detective Comis #27</h4>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>