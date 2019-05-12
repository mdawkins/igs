<?php
// here is what I want. Check it and make sure it sounds like a good idea.

require_once '../functions/regform.php';

$_GET["value"] = $_POST["tax_name"]; // never allow passing thru the browser security reasons
if($_POST["action"] == "Update")
        $_GET["wherefield"] = "tax_name";

$BASE="Tax Rates";
$MAINBASE="tax";
$dbtable="tax_rate";
// start array
$formfields=array(
		array("field_name"      => "tax",
			"label"         => "Tax Rate",
			"title"         => "",
			"type"          => "title",),

		  array("field_name"	=> "tax_name",    // must 1st because of naming order
			"label"		=> "Tax Name",
			"title"		=> "Tax Name",
			"read_only"	=> "readonly",
			"maxlength"	=> "10",
			"type"		=> "text"),
		  
		  array("field_name"	=> "tax_rate",
			"label"		=> "Tax Rate",
			"title"		=> "Tax Rate",
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
