<?php
session_start();

if(isset($_SESSION['login_user'])){
	session_unset();
	session_destroy();
	//**display a logout successful message**
}
header( 'location: index.php');
?>