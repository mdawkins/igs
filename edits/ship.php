<?php
// here is what I want. Check it and make sure it sounds like a good idea.

require_once '../functions/regform.php';

$_GET["value"] = $_POST["ship_code"]; // never allow passing thru the browser security reasons
if($_POST["action"] == "Update")
        $_GET["wherefield"] = "ship_code";

$BASE="Ship Rate";
$MAINBASE="ship";
$dbtable="ship_rate";
// start array
$formfields=array(
		array("field_name"      => "ship",
			"label"         => "Ship Rate",
			"title"         => "",
			"type"          => "title",),

		  array("field_name"	=> "ship_code",    // must 1st because of naming order
			"label"		=> "Shipping Code",
			"title"		=> "Shipping Code",
			"read_only"	=> "readonly",
			"maxlength"	=> "10",
			"type"		=> "text"),
		  
		  array("field_name"	=> "ship_cost",
			"label"		=> "Shipping Cost",
			"title"		=> "Shipping Cost",
			"maxlength"	=> "30",
			"required"	=> "yes",
			"type"		=> "text"),
        	
		array("field_name" 	=> "button_addedit",
        		"type"		=> "button",
         		"list"		=> array("Add", "Reset"),
			"searchlist"	=> array("Update", "Delete", "Reset")),

		);
// stop array
regform($BASE, $MAINBASE, $dbtable, $formfields);

?>
