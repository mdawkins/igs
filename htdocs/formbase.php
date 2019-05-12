<?php
require_once '../functions/functions.php';
// Connect to the Database
$link = db_connect($DB_SERVER, $DB_LOGIN, $DB_PASSWORD, $DB);

#phpinfo(32);
// billing-include-Done -- but uses insert_order functions
if ( $_POST["action"] == "Done" )
	require_once '../functions/'.$_GET["main"].'.php';

// email_pass-forms-Send E-mail
// cust_info-forms-Update
// change_passwd-forms-Update Password
// display_info-include-Continue -- but uses order_form

elseif ( $_POST["action"] == "Send E-mail" || $_POST["action"] == "Update" || $_POST["action"] == "Update Password" || $_POST["action"] == "Continue" )
	require_once '../forms/'.$_GET["main"].'.php';

// ****************************************************************************************
elseif ($_POST["action"] == "Change Password")
	header('Location:index.php?main=change_pass');

elseif ($_POST["action"] == "Login")
	include '../functions/login.php';

elseif ($_POST["action"] == "Register")
	require_once '../forms/cust_form.php';

elseif ($_POST["action"] == "Cancel") {
	setcookie('check_out',"");
	if ( $rewriteurl == "yes" ) {
		header('Location:/cart.html');
	} else {
	header('Location:/index.php?main=cart'); }
} elseif ($_POST["action"] == "Back") {	
	if ($_GET["main"] == "cust_info" && $_COOKIE["check_out"] != "true")
		header('Location:/index.php?main=user_area');
	elseif ($_GET["main"] == "emailpasswd")
		header('Location:/registry.html');
	elseif ($_GET["main"] == "change_pass")
		header('Location:/index.php?main=cust_info&searchfield=user_id');
//	elseif ($_GET["main"] == "insert_order") {
		#echo 'here: '.$_POST["action"].' '.$_GET["main"];
//		header('Location:index.php?main=display_info');
//		}
	elseif ($_COOKIE["check_out"] == "true")
		header('Location:/index.php?main=display_info');
}

?>
