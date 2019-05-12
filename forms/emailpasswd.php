<?php

require_once '../functions/regform.php';
// here is what I want. Check it and make sure it sounds like a good idea.

#$_GET["value"] = $_COOKIE["cookie_user"]; // never allow passing thru the browser security reasons
$_GET["wherefield"] = "cust_email";

$BASE="Customer";
$MAINBASE = "emailpasswd"; // page that it goes to
$MAINBUTTON = "Continue"; // not even sure I need this ??
$dbtable="cust_info";
// start array
$formfields=array(
        array("field_name" => "emailpasswd",
         "label"     => "Please enter in E-mail address and your information will be sent to you.",
         "title"     => "",
         "type"      => "title"),

		  array("field_name"	=> "cust_email",    
			"label"		=> "E-mail Address",
			"title"		=> "E-mail Address",
			"maxlength"	=> "30",
		        "required" 	=> "yes",
			"type"		=> "email"),

        array("field_name" => "button_email_passwd",
         "type"      => "button",
         "list"      => array("Back", "Send E-mail")),
 
		);
// stop array
regform($BASE, $MAINBASE, $dbtable, $formfields);

?>
