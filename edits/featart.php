<?php
// here is what I want. Check it and make sure it sounds like a good idea.
// addedit_prod.php?searchfield=sku&value=34
require_once '../functions/regform.php';
$BASE="Frontpage Features";
$MAINBASE = "featart";
$dbtable="featart";
// start array
$formfields=array(
		array("field_name" 	=> "featart",
			"label"		=> "Frontpage Features",
			"title"		=> "",
			"type"		=> "title",),

		array("field_name"    => "featart_id",
                        "label"         => "database id",
                        "title"         => "This field contains the SKU Number. I don't know what that is but hopefuly you do",
                        "maxlength"     => "20",
                        "read_only"     => "readonly",
                        "type"          => "hidden"),

		  array("field_name"	=> "feat_head_a",
			"label"		=> "Row A Header",
			"size"		=> "80",
			"maxlength"	=> "90",
			"type"		=> "text"),

                  array("field_name"    => "feat_headlink_a",
                        "label"         => "Header A Link",
                        "title"         => "Header A Link",
			"size"		=> "80",
                        "maxlength"     => "90",
                        "type"          => "text"),

		  array("field_name"	=> "feat_desc_a1",
			"label"		=> "Row A Line 1",
			"cols"          => "80",
                        "rows"          => "3",
			"type"		=> "desc"),

		  array("field_name"	=> "feat_image_a",
			"label"		=> "Feature Image A",
			"title"		=> "Featured Image",
			"maxlength"	=> "20",
			"type"		=> "text"),

                  array("field_name"    => "feat_link_a",
                        "label"         => "Image A Link",
                        "title"         => "Image A Link",
			"size"		=> "80",
                        "maxlength"     => "90",
                        "type"          => "text"),

		  array("field_name"	=> "feat_head_b",
			"label"		=> "Row B Header",
			"size"		=> "80",
			"maxlength"	=> "90",
			"type"		=> "text"),

                  array("field_name"    => "feat_headlink_b",
                        "label"         => "Header B Link",
                        "title"         => "Header B Link",
			"size"		=> "80",
                        "maxlength"     => "90",
                        "type"          => "text"),

		  array("field_name"	=> "feat_desc_b1",
			"label"		=> "Row B Line 1",
			"cols"          => "80",
                        "rows"          => "3",
			"type"		=> "desc"),

		  array("field_name"	=> "feat_image_b",
			"label"		=> "Feature Image B",
			"title"		=> "Featured Image",
			"maxlength"	=> "20",
			"type"		=> "text"),

                  array("field_name"    => "feat_link_b",
                        "label"         => "Image B Link",
                        "title"         => "Image B Link",
			"size"		=> "80",
                        "maxlength"     => "90",
                        "type"          => "text"),

		  array("field_name"	=> "feat_head_c",
			"label"		=> "Row C Header",
			"size"		=> "80",
			"maxlength"	=> "90",
			"type"		=> "text"),

                  array("field_name"    => "feat_headlink_c",
                        "label"         => "Header C Link",
                        "title"         => "Header C Link",
			"size"		=> "80",
                        "maxlength"     => "90",
                        "type"          => "text"),

		  array("field_name"	=> "feat_desc_c1",
			"label"		=> "Row C Line 1",
			"cols"          => "80",
                        "rows"          => "3",
			"type"		=> "desc"),

		  array("field_name"	=> "feat_image_c",
			"label"		=> "Feature Image C",
			"title"		=> "Featured Image",
			"maxlength"	=> "20",
			"type"		=> "text"),

                  array("field_name"    => "feat_link_c",
                        "label"         => "Image C Link",
                        "title"         => "Image C Link",
			"size"		=> "80",
                        "maxlength"     => "90",
                        "type"          => "text"),

        	array("field_name" 	=> "button_addedit",
        		"type"		=> "button",
         		"list"		=> array("Add", "Reset"),
			"searchlist"	=> array("Update", "Delete", "Reset")),

		);
// stop array
regform($BASE, $MAINBASE, $dbtable, $formfields);
?>
