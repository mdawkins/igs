<?php
// Check whether the user is already authenticated or not
if (!authenticateUser( $_COOKIE["cookie_user"], $_COOKIE["cookie_passwd"])) {
  require_once '../include/registry.php';
  exit();
}

require_once '../functions/regform.php';
$_GET["searchfield"] = "user_id";
$_GET["value"] = $_COOKIE["cookie_user"]; // never allow passing thru the browser security reasons
if($_POST["action"] == "Update")
	$_GET["wherefield"] = "user_id";

// here is what I want. Check it and make sure it sounds like a good idea.
$BASE="Customer";
$MAINBASE = "cust_info"; // page that it goes to
$MAINBUTTON = "Continue";
$dbtable="cust_info";
// start array
$formfields=array(
	array("field_name" => "personal",
	"label"     => "Personal Information: ".$_COOKIE["cookie_user"],
	"title"     => "",
	"type"      => "title"),

	array("field_name"	=> "cust_fn",    // must 1st because of naming order
	"label"		=> "Firstname",
	"title"		=> "Firstname",
	"maxlength"	=> "30",
	"required"	=> "yes",
	"type"		=> "text"),
		  
	array("field_name"	=> "cust_ln",    
	"label"		=> "Lastname",
	"title"		=> "Lastname",
	"maxlength"	=> "30",
	"required"	=> "yes",
	"type"		=> "text"),
		  
	array("field_name"	=> "cust_mi",    
	"label"		=> "Middle Initial",
	"title"		=> "Middle Initial",
	"maxlength"	=> "1",
	"type"		=> "text"),
		  
	array("field_name"	=> "cust_addr1",    
	"label"		=> "Address 1",
	"title"		=> "Address 1",
	"maxlength"	=> "30",
	"required"	=> "yes",
	"type"		=> "text"),
		  
	array("field_name"	=> "cust_addr2",    
	"label"		=> "Address 2",
	"title"		=> "Address 2",
	"maxlength"	=> "30",
	"type"		=> "text"),
		  
	array("field_name"	=> "cust_city",    
	"label"		=> "City",
	"title"		=> "City",
	"maxlength"	=> "20",
	"required"	=> "yes",
	"type"		=> "text"),
		  
	array("field_name"	=> "cust_state",    
	"label"		=> "State",
	"title"		=> "State",
	"maxlength"	=> "2",
	"size"		=> "2",
	"required"	=> "yes",
	"type"		=> "text"),
		  
	array("field_name"	=> "cust_zip",    
	"label"		=> "Zip",
	"title"		=> "Zip",
	"required"	=> "yes",
	"type"		=> "zip"),
		  
	array("field_name"	=> "cust_tel_hm",    
	"label"		=> "Home Telephone",
	"title"		=> "Home Telephone",
	"required"  => "yes",
	"type"		=> "tel"),
		  
	array("field_name"	=> "cust_tel_cel",    
	"label"		=> "Cellular Telephone",
	"title"		=> "Cellular Telephone",
	"type"		=> "tel"),
		 
	array("field_name"	=> "cust_tel_wk",    
	"label"		=> "Work Telephone",
	"title"		=> "Work Telephone",
	"type"		=> "tel"),
		 
	array("field_name"	=> "cust_tel_add",    
	"label"		=> "Additional Telephone",
	"title"		=> "Additional Telephone",
	"type"		=> "tel"),
		 
	array("field_name"	=> "cust_email",    
	"label"		=> "E-mail",
	"title"		=> "E-mail",
	"maxlength"	=> "30",
       	"required"	=> "yes",
	"type"		=> "email"),

       	array("field_name" => "button_register",
       	"type"      => "button",
       	"searchlist"      => array("Back", "Update", "Change Password")),
 
		);
// stop array
regform($BASE, $MAINBASE, $dbtable, $formfields);

?>
