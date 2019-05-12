<?php

if (authenticateUser($_POST["user_id"], $_POST["cust_passwd"])) {
   	setcookie("cookie_passwd", $_POST["cust_passwd"], 0, '/', $SITECOOKIE, FALSE);
   	setcookie("cookie_user", $_POST["user_id"], 0, '/', $SITECOOKIE, FALSE);
	if ($_COOKIE["check_out"] == "true" && isset($_COOKIE["items_tray"]) ) {
   		header('Location:index.php?main=display_info'); 
   		exit();
	} else {
		header('Location:index.php?main=user_area');
                exit();
	}
} else {
   header("Location:index.php?main=registry&error=login");
   exit() ;
}
?>
