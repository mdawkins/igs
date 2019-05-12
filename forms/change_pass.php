<?php

// Check whether the user is already authenticated or not
if (!authenticateUser( $_COOKIE["cookie_user"], $_COOKIE["cookie_passwd"]))
{
  require_once '../include/registry.php';
  exit();
}
require_once '../functions/regform.php';
$_GET["value"] = $_COOKIE["cookie_user"]; // never allow passing thru the browser security reasons
if($_POST["action"] == "Update")
	$_GET["wherefield"] = "user_id";
elseif($_POST["action"] == "Change Password")
{
   $_GET["wherefield"] = "user_id";
	unset($_POST["action"]);
}
elseif($_POST["action"] == "Update Password")
{
   $_GET["wherefield"] = "user_id";
}
// here is what I want. Check it and make sure it sounds like a good idea.
$BASE="Customer";
$MAINBASE = "change_pass"; // page that it goes to
$dbtable="cust_info";
// start array
$formfields=array(
        array("field_name" => "password",
         "label"     => "Change Password",
         "title"     => "",
         "type"      => "title"),

		  array("field_name"	=> "old_cust_passwd",    
			"label"		=> "Old Password",
			"title"		=> "Password",
			"maxlength"	=> "30",
         "required"  => "yes",
			"type"		=> "password"),
		  
		  array("field_name"	=> "cust_passwd",    
			"label"		=> "New Password",
			"title"		=> "New Password",
			"maxlength"	=> "30",
         "required"  => "yes",
			"type"		=> "password"),
		  
		  array("field_name"	=> "cust_passwd_conf",    
			"label"		=> "Confirm New Password",
			"title"		=> "Confirm New Password",
			"maxlength"	=> "30",
         "required"  => "yes",
			"type"		=> "password"),
		
        array("field_name" => "button_update",
         "type"      => "button",
         "list"      => array("Back", "Update Password")),
 
		);
// stop array
regform($BASE, $MAINBASE, $dbtable, $formfields);

?>
