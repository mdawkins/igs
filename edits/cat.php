<?php
// here is what I want. Check it and make sure it sounds like a good idea.
require_once '../functions/regform.php';
#$_GET["searchfield"] = "user_id";
$_GET["value"] = $_POST["cat_id"]; // never allow passing thru the browser security reasons
if($_POST["action"] == "Update")
        $_GET["wherefield"] = "cat_id";

$BASE="Category";
$MAINBASE = "cat";
$dbtable="cat";
// start array
$formfields=array(
	array("field_name" 	=> "cat",
		"label"		=> "Category Information",
		"title"		=> "",
		"type"		=> "title",),

	array("field_name"	=> "cat_id",    // must 1st because of naming order
		"label"		=> "Category Id",
		"title"		=> "Category Id",
		"read_only"	=> "readonly",
		"maxlength"	=> "10",
		"type"		=> "hidden"),
  
	array("field_name"	=> "cat_name",
		"label"		=> "Category Name",
		"title"		=> "Category Name",
		"maxlength"	=> "30",
		"required"	=> "yes",
		"type"		=> "text"),

	array("field_name"	=> "cat_desc",
		"label"		=> "Category Description",
		"cols"		=> "60",
		"rows"		=> "9",
		"type"		=> "desc"),
  
	array("field_name"	=> "cat_ls",
		"label"		=> "Category List",
		"title"		=> "Category List",
		"type"		=> "checkbox"),

	array("field_name"    => "cat_image_name",
		"label"         => "Category Image",
		"title"         => "Category Image",
		"maxlength"     => "20",
		"type"          => "text"),

	array("field_name" 	=> "button_addedit",
		"type"		=> "button",
		"list"		=> array("Add", "Reset"),
		"searchlist"	=> array("Update", "Delete", "Reset")),
); // stop array

regform($BASE, $MAINBASE, $dbtable, $formfields);

?>
