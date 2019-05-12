<?php
// here is what I want. Check it and make sure it sounds like a good idea.

require_once '../functions/regform.php';

$_GET["value"] = $_POST["zip_code"]; // never allow passing thru the browser security reasons
if($_POST["action"] == "Update")
        $_GET["wherefield"] = "zip_code";

$BASE="Zip Code";
$MAINBASE="zip_code";
$dbtable="zip_code";
// start array
$formfields=array(
		array("field_name"      => "zip_code",
			"label"         => "Zip Code",
			"title"         => "",
			"type"          => "title",),

		  array("field_name"	=> "zip_code",    // must 1st because of naming order
			"label"		=> "Zip Code",
			"title"		=> "Zip Code",
			"read_only"	=> "readonly",
			"maxlength"	=> "10",
			"type"		=> "text"),
		  
		  array("field_name"	=> "zip_city",
			"label"		=> "Zip City",
			"title"		=> "Zip City",
			"maxlength"	=> "30",
			"required"	=> "yes",
			"type"		=> "text"),
        	
		  array("field_name"	=> "zip_type",
			"title"		=> "Type Type",
			"label"		=> "Type Type",
			"maxlength"	=> "20",
			"type"		=> "custlist",
			"list"          => array("state", "State", "county", "County", "city", "City")),

		array("field_name" 	=> "button_addedit",
        		"type"		=> "button",
         		"list"		=> array("Add", "Reset"),
			"searchlist"	=> array("Update", "Delete", "Reset")),

		);
// stop array
regform($BASE, $MAINBASE, $dbtable, $formfields);

?>
