<?php
// here is what I want. Check it and make sure it sounds like a good idea.
require_once '../functions/regform.php';

$_GET["value"] = $_POST["sub_id"]; // never allow passing thru the browser security reasons
if($_POST["action"] == "Update")
        $_GET["wherefield"] = "sub_id";

$TITLE="Add Subject Information";
$BASE="Subject";
$MAINBASE = "subject";
$dbtable="subject";
// start array
$formfields=array(
		array("field_name" 	=> "subject",
			"label"		=> "Subject Information",
			"title"		=> "Subject Information",
			"type"		=> "title",),

		  array("field_name"	=> "sub_id",    // must 1st because of naming order
			"label"		=> "Subject Id",
			"title"		=> "Subject Id",
			"read_only"	=> "readonly",
			"maxlength"	=> "10",
			"type"		=> "hidden"),
		  
		  array("field_name"	=> "sub_name",
			"label"		=> "Subject Name",
			"title"		=> "Subject Name",
			"maxlength"	=> "30",
			"required"	=> "yes",
			"type"		=> "text"),

		  array("field_name"	=> "sub_keywords",
			"label"		=> "Subject Keywords",
			"cols"		=> "60",
			"rows"		=> "9",
			"type"		=> "desc"),
		  
		  array("field_name"	=> "sub_ls",
			"label"		=> "Subject List",
			"title"		=> "Subject List",
			"type"		=> "checkbox"),

        	array("field_name" 	=> "button_addedit",
        		"type"		=> "button",
         		"list"		=> array("Add", "Reset"),
			"searchlist"	=> array("Update", "Delete", "Reset")),
 
		);
// stop array
regform($BASE, $MAINBASE, $dbtable, $formfields);

?>
