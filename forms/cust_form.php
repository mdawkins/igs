<?php
#require_once '../include/tel_next.js';
require_once '../functions/regform.php';
// here is what I want. Check it and make sure it sounds like a good idea.
$BASE="Customer";
$MAINBASE = "registry"; // page that it goes to
$dbtable="cust_info";
// start array
$formfields=array(
        array("field_name" => "register",
         "label"     => "Please enter in your information",
         "title"     => "",
         "type"      => "title"),

		  array("field_name"	=> "cust_fn",    // must 1st because of naming order
			"label"		=> "Firstname",
			"title"		=> "Firstname",
			"maxlength"	=> "30",
         "required"  => "yes",
			"type"		=> "text"),
		  
		  array("field_name"	=> "cust_ln",    
			"label"		=> "Lastname",
			"title"		=> "Lastname",
			"maxlength"	=> "30",
         "required"  => "yes",
			"type"		=> "text"),
		  
		  array("field_name"	=> "cust_mi",    
			"label"		=> "Middle Initial",
			"title"		=> "Middle Initial",
			"maxlength"	=> "1",
			"type"		=> "text"),
		  
		  array("field_name"	=> "user_id",    
			"label"		=> "Create User ID",
			"title"		=> "Create User ID",
			"maxlength"	=> "30",
         "required"  => "yes",
			"type"		=> "user_id"),
		  
		  array("field_name"	=> "cust_passwd",    
			"label"		=> "Password",
			"title"		=> "Password",
			"maxlength"	=> "30",
         "required"  => "yes",
			"type"		=> "password"),
		  
		  array("field_name"	=> "cust_passwd_conf",    
			"label"		=> "Confirm Password",
			"title"		=> "Confirm Password",
			"maxlength"	=> "30",
         "required"  => "yes",
			"type"		=> "password"),
		
		  array("field_name"	=> "cust_addr1",    
			"label"		=> "Address 1",
			"title"		=> "Address 1",
			"maxlength"	=> "30",
         "required"  => "yes",
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
         "required"  => "yes",
			"type"		=> "text"),
		  
		  array("field_name"	=> "cust_state",    
			"label"		=> "State",
			"title"		=> "State",
			"maxlength"	=> "2",
			"size"		=> "2",
         "required"  => "yes",
			"type"		=> "text"),
		  
		  array("field_name"	=> "cust_zip",    
			"label"		=> "Zip",
			"title"		=> "Zip",
         "required"  => "yes",
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
         "required"  => "yes",
			"type"		=> "email"),

        array("field_name" => "button_register",
         "type"      => "button",
         "list"      => array("Register")),
 
		);
// stop array
regform($BASE, $MAINBASE, $dbtable, $formfields);

?>
