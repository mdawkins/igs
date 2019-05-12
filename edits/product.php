<?php

require_once '../functions/regform.php';

if($_POST["action"] == "Update")
{
        $_GET["wherefield"] = "id";
	$_GET["value"] = $_POST["id"]; // never allow passing thru the browser security reasons
}

$BASE="Product";
$MAINBASE = "product";
$dbtable="product";

$add_stat ='';          
$columns= "sku, prod_name, prod_desc, ship_code, prod_price, ship_code";
$tables= 'product';
$sql_list=array($add_stat,$columns,$tables);
// start array
$formfields=array(
		array("field_name"      => "product",
			"label"         => "Product Information",
			"title"         => "",
			"type"          => "title",),

		  array("field_name" 	=> "sku", // sku must be the 1st col in order to satisfy naming order for the imagee
			"label"		=> "Product SKU",
			"title"		=> "This field contains the SKU Number",
			"maxlength"	=> "20",
			//"read_only"	=> "readonly",
			"type"		=> "text"),

		  array("field_name" 	=> "id",
			"label"		=> "database id",
			"title"		=> "This field contains the SKU Number. I don't know what that is but hopefuly you do",
			"maxlength"	=> "20",
			"read_only"	=> "readonly",
			"type"		=> "text"),

		  array("field_name"	=> "prod_name",
			"title"		=> "Product Name", 
			"label"		=> "Product Name",
			"maxlength"	=> "30",
			"type"		=> "text"),

/*		  array("field_name"	=> "prod_new",
			"title"		=> "blah blah blah",
			"label"		=> "New",
			"type"		=> "checkbox"), */

		  array("field_name"	=> "prod_desc",
			"label"		=> "Product Description",
			"cols"		=> "60",
			"rows"		=> "9",
			"type"		=> "desc"),

		  array("field_name"	=> "ship_code",
			"title"		=> "Shipping Code",
			"label"		=> "Shipping Code",
			"maxlength"	=> "1",
			"type"		=> "text"),

/*		  array("field_name"	=> "prod_wt",
			"title"		=> "Product Weight",
			"label"		=> "Product Weight lbs",
			"maxlength"	=> "20",
			"type"		=> "text"), */

/*		  array("field_name"	=> "prod_os",
			"label"		=> "Oversized Packaging",
			"title"		=> "Oversized Packaging",
			"type"		=> "checkbox"), */

		  array("field_name"	=> "prod_price",
			"title"		=> "Product Price",
			"label"		=> "Product Price USD",
			"maxlength"	=> "20",
			"type"		=> "text"),

		  array("field_name"	=> "prod_status",
			"title"		=> "Product Status",
			"label"		=> "Product Status",
			"maxlength"	=> "20",
			"type"		=> "custlist",
			"list"          => array("instock", "In-stock", "preorder", "Preorder", "onorder", "On Order", "direct", "Direct Order")),

		  array("field_name"	=> "subcat_id",
			"label"		=> "Product Category/Sub-Category",
			"title"		=> "Product Category/Sub-Category",
			"maxlength"	=> "20",
			"type"		=> "groupdropdown",
			"grouptable"		=> "cat",
			"groupfield"		=> "cat_name",
			"groupvaluefield"	=> "cat_id",
			"itemtable"		=> "subcat",
			"itemfield"		=> "subcat_name",
			"itemvaluefield"	=> "subcat_id"),

/*		  array("field_name"	=> "order_avail",
			"label"		=> "Available for Ordering",
			"title"		=> "Available for Ordering",
			"type"		=> "checkbox"), */

		  array("field_name"	=> "prod_ls",
			"label"		=> "Available for Online Display",
			"title"		=> "Online Display",
			"type"		=> "checkbox"),

                 array("field_name"	=> "prod_image_name",
                        "label"         => "Product Image",
                        "title"         => "Product Image",
                        "maxlength"     => "20",
			"imagelink"	=> "yes",
                        "type"          => "text"),

                 array("field_name"	=> "prod_image_tn_name",
                        "label"         => "Product Thumbnail Image",
                        "title"         => "Product Thumbnail Image",
                        "maxlength"     => "20",
			"imagelink"	=> "yes",
                        "type"          => "text"),

        	array("field_name" 	=> "button_addedit",
        		"type"		=> "button",
         		"list"		=> array("Add", "Reset"),
			"searchlist"	=> array("Update", "Delete", "Reset")),

		);
// stop array
regform($BASE, $MAINBASE, $dbtable, $formfields);

?>
