<!--
    Web developement and deployment
    Group Assignment
    Jack Doyle | Casey Ogbevoen
    Logs Out the User and returns to Home Page
-->
<?php
    //start session
    session_start();

if(isset($_SESSION["user"])){
	session_unset();
	session_destroy();
}
header( 'location: index.php');
?>