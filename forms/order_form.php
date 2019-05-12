<?php

require_once '../functions/regform.php';
// here is what I want. Check it and make sure it sounds like a good idea.
$BASE="order_info";
$MAINBASE = "order_form"; // page that it goes to
$dbtable="cust_info";
// start array
$formfields=array(
		  array("field_name" => "cust",
			"label"		=> "Customer Information",
			"title"		=> "Customer Information",
			"type"		=> "title"),

		  array("field_name" =>	"cust_info",
			"type"		=>	"cust_info"),

		  array("field_name" => "ship_info",
			"label"		=> "Shipping Information",
			"title"		=> "Shipping Information",
			"type"		=> "title"),
		
		  array("field_name"	=> "ship_copy",    
			"label"		=> "Same",
			"title"		=> "Same",
			"maxlength"	=> "30",
			"add_js"	=> 'OnClick="javascript:copy_fields(this.form);"',
			"type"		=> "checkbox"),
		  
		  array("field_name"	=> "ship_fn",    // must 1st because of naming order
			"label"		=> "Firstname",
			"title"		=> "Firstname",
			"maxlength"	=> "30",
         "required"  => "yes",
			"type"		=> "text"),
		  
		  array("field_name"	=> "ship_ln",    
			"label"		=> "Lastname",
			"title"		=> "Lastname",
			"maxlength"	=> "30",
         "required"  => "yes",
			"type"		=> "text"),
		  
		  array("field_name"	=> "ship_mi",    
			"label"		=> "Middle Initial",
			"title"		=> "Middle Initial",
			"maxlength"	=> "1",
			"type"		=> "text"),
		  
		  array("field_name"	=> "ship_addr1",    
			"label"		=> "Address 1",
			"title"		=> "Address 1",
			"maxlength"	=> "30",
         "required"  => "yes",
			"type"		=> "text"),
		  
		  array("field_name"	=> "ship_addr2",    
			"label"		=> "Address 2",
			"title"		=> "Address 2",
			"maxlength"	=> "30",
			"type"		=> "text"),
		  
		  array("field_name"	=> "ship_city",    
			"label"		=> "City",
			"title"		=> "City",
			"maxlength"	=> "20",
         "required"  => "yes",
			"type"		=> "text"),
		  
		  array("field_name"	=> "ship_state",    
			"label"		=> "State",
			"title"		=> "State",
			"maxlength"	=> "2",
			"size"		=> "2",
         "required"  => "yes",
			"type"		=> "text"),
		  
		  array("field_name"	=> "ship_zip",    
			"label"		=> "Zip",
			"title"		=> "Zip",
         "required"  => "yes",
			"type"		=> "zip"),

		  array("field_name" => "bill_info",
			"label"		=> "Billing Information",
			"title"		=> "Billing Information",
			"type"		=> "title"),
		
		  array("field_name"	=> "card_name",    
			"label"		=> "Card Holder's Name",
			"title"		=> "Card Holder's Name",
			"maxlength"	=> "30",
         "required"  => "yes",
			"type"		=> "text"),
		  
		  array("field_name"	=> "card_num",    
			"label"		=> "Card Number",
			"title"		=> "Card Number",
			"maxlength"	=> "30",
         "required"  => "yes",
			"type"		=> "text"),
	
        array("field_name"    => "card_type",
         "label"         => "Card Type",
         "title"         => "Card Type",
         "maxlength"     => "30",
         "type"          => "custlist",
         "list"          => array("default", "Select Card", "Visa", "Visa", "Master Card", "Master Card", "Discover", "Discover")),

		  array("field_name"	=> "card_exp",    
			"label"		=> "Card Expiration Date",
			"title"		=> "Card Expiration Date",
			"maxlength"	=> "30",
         "required"  => "yes",
			"type"		=> "text"),
		  
		  array("field_name"	=> "card_cvc",    
			"label"		=> "Card Security Code",
			"title"		=> "The 3 digit security code on the back of your card",
			"maxlength"	=> "3",
         "required"  => "yes",
			"type"		=> "text"),
		  
		  array("field_name" => "special_intr_title",
			"label"		=> "Special Instructions",
			"title"		=> "Special Instructions",
			"type"		=> "title"),
		
		  array("field_name"	=> "special_intr",
			"cols"		=>	"90",
			"rows"		=>	"5",
			"type"		=> "textarea"),

		  array("field_name" => "button_cancel",
			"type"		=>	"button",
         		"list"      => array("Cancel", "Continue")),
		  
		);
// stop array
regform($BASE, $MAINBASE, $dbtable, $formfields);

?>
