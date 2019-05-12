<?php
require_once '../functions/regform.php';

if($_POST["action"] == "Update")
{
        $_GET["wherefield"] = "order_id";
	$_GET["value"] = $_POST["order_id"]; // never allow passing thru the browser security reasons
}

$BASE="Order";
$MAINBASE="order";
$dbtable="order_info, cust_info";

$add_stat=' cust_info.user_id = order_info.user_id ';
$columns= "order_id, order_info.user_id, concat(cust_fn,' ',cust_ln) as cust_name, cust_email, order_date";
$tables= 'order_info, cust_info';
$sql_list=array($add_stat,$columns,$tables);
$formfields=array(
		array("field_name"      => "order",
			"label"         => "Order Information",
			"title"         => "",
			"type"          => "title",),

                  array("field_name"    => "order_id",    // must 1st because of naming order
                        "label"         => "Order Id",
                        "title"         => "Order Id",
                        #"read_only"     => "readonly",
                        "maxlength"     => "10",
                        "type"          => "text"),

		  array("field_name"    => "user_id",
                        "label"         => "User ID",
                        "title"         => "User ID",
                        "maxlength"     => "30",
                        "type"          => "text"),
                  
                  array("field_name"    => "cust_fn",
                        "label"         => "First Name",
                        "title"         => "First Name",
                        "maxlength"     => "30",
                        "type"          => "text"),
                  
		  array("field_name"    => "cust_ln",
                        "label"         => "Last Name",
                        "title"         => "Last Name",
                        "maxlength"     => "30",
                        "type"          => "text"),
                  
		  array("field_name"    => "cust_email",
                        "label"         => "E-mail",
                        "title"         => "E-mail",
                        "maxlength"     => "30",
                        "type"          => "text"),

		  array("field_name"    => "order_date",
                        "label"         => "Dates to yyyy-mm-dd from yyyy-mm-dd",
                        "title"         => "Dates to yyyy-mm-dd from yyyy-mm-dd",
                        "type"          => "dates"),

		  array("field_name"    => "order",
                        "label"         => "Order By",
                        "title"         => "Order By",
                        "type"          => "orderby",
			"list" 		=> array("order_id", "Order ID", "order_date", "Order Date", "cust_name", "Customer Name", "user_id", "User ID")),
        	
		array("field_name" 	=> "button_addedit",
        		"type"		=> "button",
         		"list"		=> array("Search", "Add", "Reset"),
			"searchlist"	=> array("Update", "Delete", "Reset")),

		);
regform($BASE, $MAINBASE, $dbtable, $formfields, $sql_list);

?>
