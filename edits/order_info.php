<?php
require_once '../functions/regform.php';

if($_POST["action"] == "Update")
{
        $_GET["wherefield"] = "order_id";
	$_GET["value"] = $_POST["order_id"]; // never allow passing thru the browser security reasons
}

$TITLE="Order Information";
$BASE="Order Info";
$MAINBASE="order_info";
$dbtable="order_info";

$add_stat='';
$columns= "order_id, user_id, order_date";
$tables= 'order_info';
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
                  
		  array("field_name"    => "display_order",
			"type"          => "display_order"),	

		  array("field_name"    => "order_cost",
                        "label"         => "Subtotal",
                        "title"         => "Subtotal",
                        "maxlength"     => "30",
                        "type"          => "text"),
                  
		  array("field_name"    => "ship_cost",
                        "label"         => "Shipping",
                        "title"         => "Shipping",
                        "maxlength"     => "30",
                        "type"          => "text"),
                  
		  array("field_name"    => "order_tax",
                        "label"         => "Tax",
                        "title"         => "Tax",
                        "maxlength"     => "30",
                        "type"          => "text"),
                  
		  array("field_name"    => "order_conf",
                        "label"         => "Order Confirmation",
                        "title"         => "Order Confirmation",
                        "maxlength"     => "30",
                        "type"          => "custlist",
			"list"          => array("pending", "Pending", "confirmed", "Confirmed", "canceled", "Canceled")),
                  
		  array("field_name"    => "delv_date",
                        "label"         => "Delivery Date yyyy-mm-dd",
                        "title"         => "Delivery Date yyyy-mm-dd",
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
			"list" 		=> array("order_id", "Order ID", "order_date", "Order Date", "user_id", "User ID")),
		
		array("field_name" 	=> "button_addedit",
        		"type"		=> "button",
         		"list"		=> array("Search", "Add", "Reset"),
			"searchlist"	=> array("Update", "Delete", "Reset")),

		);
regform($BASE, $MAINBASE, $dbtable, $formfields, $sql_list);

?>
