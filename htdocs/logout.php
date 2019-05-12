<?php
require '../functions/functions.php';

// Check whether the user is already authenticated or not
if (!authenticateUser( $_COOKIE["cookie_user"], $_COOKIE["cookie_passwd"])){
   header("Location:index.php");
   exit();
}

// Delete all user info cookies 
setcookie("cookie_user","");
setcookie("cookie_passwd","");

// Redirect to the main page
header("Location:index.php");
exit();
?>
