<?php
// here is what I want. Check it and make sure it sounds like a good idea.
require_once '../functions/regform.php';

if($_POST["action"] == "Update")
{
        $_GET["wherefield"] = "user_id";
	$_GET["value"] = $_POST["user_id"]; // never allow passing thru the browser security reasons
}

$BASE="Customer";
$MAINBASE = "cust";
$dbtable="cust_info";

$add_stat ='';
$columns= "user_id, concat(cust_fn,' ',cust_ln) as cust_name, cust_email, start_date";
$tables= 'cust_info';
$sql_list=array($add_stat,$columns,$tables);
// start array
$formfields=array(
		array("field_name"      => "cust",
			"label"         => "Customer Information",
			"title"         => "",
			"type"          => "title",),

		  array("field_name"	=> "user_id",    // must 1st because of naming order
			"label"		=> "User Id",
			"title"		=> "User Id",
			"maxlength"	=> "30",
			"orderlink"	=> "yes",
			"type"		=> "text"),
		  
		  array("field_name"	=> "cust_fn",
			"label"		=> "Customer Name",
			"title"		=> "Customer Name",
			"maxlength"	=> "30",
			"required"	=> "yes",
			"type"		=> "text"),

		  array("field_name"	=> "cust_ln",
			"label"		=> "Customer Lastname",
			"title"         => "Customer Name",
                        "maxlength"     => "30",
                        "required"      => "yes",
                        "type"          => "text"),
		
		  array("field_name"	=> "cust_addr1",
			"label"		=> "Customer Address",
			"title"         => "Customer Address",
                        "maxlength"     => "30",
                        "required"      => "yes",
                        "type"          => "text"),
		
		  array("field_name"	=> "cust_addr2",
			"label"		=> "Customer Address 2",
			"title"         => "Customer Address 2",
                        "maxlength"     => "30",
                        "type"          => "text"),
		
		  array("field_name"	=> "cust_city",
			"label"		=> "City",
			"title"         => "City",
                        "maxlength"     => "30",
                        "required"      => "yes",
                        "type"          => "text"),
		
		  array("field_name"	=> "cust_state",
			"label"		=> "State",
			"title"         => "State",
                        "maxlength"     => "30",
                        "required"      => "yes",
                        "type"          => "text"),
		
		  array("field_name"	=> "cust_zip",
			"label"		=> "Zip Code",
			"title"         => "Zip Code",
                        "maxlength"     => "30",
                        "required"      => "yes",
                        "type"          => "text"),
		
		  array("field_name"	=> "cust_tel_hm",
			"label"		=> "Telephone Number",
			"title"         => "Telephone Number",
                        "maxlength"     => "30",
                        "required"      => "yes",
                        "type"          => "text"),
		
		  array("field_name"	=> "cust_tel_cel",
			"label"		=> "Celullar Telephone Number",
			"title"         => "Celullar Telephone Number",
                        "maxlength"     => "30",
                        "type"          => "text"),
		
		  array("field_name"	=> "cust_tel_wk",
			"label"		=> "Work Telephone Number",
			"title"         => "Work Telephone Number",
                        "maxlength"     => "30",
                        "type"          => "text"),
		
		  array("field_name"	=> "cust_tel_add",
			"label"		=> "Additional Telephone Number",
			"title"         => "Additional Telephone Number",
                        "maxlength"     => "30",
                        "type"          => "text"),
		
		  array("field_name"	=> "cust_email",
			"label"		=> "Customer E-mail",
			"title"         => "Customer E-mail",
                        "maxlength"     => "30",
                        "required"      => "yes",
                        "type"          => "text"),

		  array("field_name"    => "start_date",
                        "label"         => "Dates to yyyy-mm-dd from yyyy-mm-dd",
                        "title"         => "Dates to yyyy-mm-dd from yyyy-mm-dd",
                        "type"          => "dates"),

                  array("field_name"    => "order",
                        "label"         => "Order By",
                        "title"         => "Order By",
                        "type"          => "orderby",
                        "list"          => array("start_date", "Start Date", "cust_name", "Customer Name", "user_id", "User ID")),
			  
        	array("field_name" 	=> "button_addedit",
        		"type"		=> "button",
         		"list"		=> array("Search", "Add", "Reset"),
			"searchlist"	=> array("Update", "Delete", "Reset")),
 
		);
// stop array
regform($BASE, $MAINBASE, $dbtable, $formfields);
#regform($BASE, $MAINBASE, $dbtable, $formfields, $sql_list);

?>
