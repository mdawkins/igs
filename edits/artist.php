<?php
// here is what I want. Check it and make sure it sounds like a good idea.
require_once '../functions/regform.php';

$_GET["value"] = $_POST["artist_id"]; // never allow passing thru the browser security reasons
if($_POST["action"] == "Update")
        $_GET["wherefield"] = "artist_id";

$TITLE="Add Artist Information";
$BASE="Artist";
$MAINBASE = "artist";
$dbtable="artist";
// start array
$formfields=array(
		array("field_name" 	=> "artist",
			"label"		=> "Artist Information",
			"title"		=> "Artist Information",
			"type"		=> "title",),

		  array("field_name"	=> "artist_id",    // must 1st because of naming order
			"label"		=> "Artist Id",
			"title"		=> "Artist Id",
			"read_only"	=> "readonly",
			"maxlength"	=> "10",
			"type"		=> "hidden"),
		  
		  array("field_name"	=> "artist_name",
			"label"		=> "Artist Name",
			"title"		=> "Artist Name",
			"maxlength"	=> "30",
			"required"	=> "yes",
			"type"		=> "text"),

		  array("field_name"	=> "artist_keywords",
			"label"		=> "Artist Keywords",
			"cols"		=> "60",
			"rows"		=> "9",
			"type"		=> "desc"),
		  
		  array("field_name"	=> "artist_ls",
			"label"		=> "Artist List",
			"title"		=> "Artist List",
			"type"		=> "checkbox"),

        	array("field_name" 	=> "button_addedit",
        		"type"		=> "button",
         		"list"		=> array("Add", "Reset"),
			"searchlist"	=> array("Update", "Delete", "Reset")),
 
		);
// stop array
regform($BASE, $MAINBASE, $dbtable, $formfields);

?>
