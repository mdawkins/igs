<?php
// here is what I want. Check it and make sure it sounds like a good idea.

require_once '../functions/regform.php';

$_GET["value"] = $_POST["subcat_id"]; // never allow passing thru the browser security reasons
if($_POST["action"] == "Update")
        $_GET["wherefield"] = "subcat_id";

$BASE="Subcategory";
$MAINBASE="subcat";
$dbtable="subcat";
// start array
$formfields=array(
		array("field_name"      => "subcat",
			"label"         => "Subcategory Information",
			"title"         => "",
			"type"          => "title",),

		  array("field_name"	=> "subcat_id",
			"label"		=> "Subcategory Id",
			"title"		=> "Subcategory Id",
			"read_only"	=> "readonly",
			"maxlength"	=> "10",
			"type"		=> "hidden"),
		  
		  array("field_name"	=> "subcat_name",
			"label"		=> "Subcategory Name",
			"title"		=> "Subcategory Name",
			"maxlength"	=> "30",
			"type"		=> "text"),

		  array("field_name"	=> "subcat_desc",
			"label"		=> "Subcategory Description",
			"cols"		=> "60",
			"rows"		=> "9",
			"type"		=> "desc"),
		  
		  array("field_name"	=> "subcat_ls",
			"label"		=> "Subcategory List",
			"title"		=> "Subcategory List",
			"type"		=> "checkbox"),

		  array("field_name"	=> "subcat_new",
			"label"		=> "Subcategory New",
			"title"		=> "Subcategory New ",
			"type"		=> "checkbox"),

		  array("field_name"	=> "cat_id",
			"label"		=> "Category Id",
			"title"		=> "Category Id",
			"maxlength"	=> "10",
			"table"		=> "cat",
			"field"		=> "cat_name",
			"valuefield"	=> "cat_id",
			"type"		=> "dropdown"),
		  
                 array("field_name"	=> "subcat_pic_name",
                        "label"         => "Subcategory Image",
                        "title"         => "Subcategory Image",
                        "maxlength"     => "20",
                        "type"          => "text"),

        	array("field_name" 	=> "button_addedit",
        		"type"		=> "button",
         		"list"		=> array("Add", "Reset"),
			"searchlist"	=> array("Update", "Delete", "Reset")),
		  
		);
// stop array
regform($BASE, $MAINBASE, $dbtable, $formfields);

?>
