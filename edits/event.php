<?php
// here is what I want. Check it and make sure it sounds like a good idea.
// addedit_prod.php?searchfield=sku&value=34

$_GET["value"] = $_POST["event_id"]; // never allow passing thru the browser security reasons
if($_POST["action"] == "Update")
        $_GET["wherefield"] = "event_id";

require_once '../functions/regform.php';
$TITLE="Event Information";
$BASE="Event";
$MAINBASE = "event";
$dbtable="event";
// start array
$formfields=array(
		array("field_name"    => "event_id",
                        "label"         => "database id",
                        "title"         => "This field contains the SKU Number. I don't know what that is but hopefuly you do",
                        "maxlength"     => "20",
                        "read_only"     => "readonly",
                        "type"          => "hidden"),

		  array("field_name"	=> "event_date",
			"label"		=> "Event Date",
                        "title"         => "",
			"size"		=> "30",
			"maxlength"	=> "30",
			"type"		=> "text"),

                  array("field_name"    => "event_time",
                        "label"         => "Event Time",
                        "title"         => "",
			"size"		=> "30",
                        "maxlength"     => "30",
                        "type"          => "text"),

                  array("field_name"    => "event_title",
                        "label"         => "Event Title",
                        "title"         => "",
			"size"		=> "80",
                        "maxlength"     => "90",
                        "type"          => "text"),

		  array("field_name"	=> "event_desc",
			"label"		=> "Event Description",
                        "title"         => "",
			"cols"          => "80",
                        "rows"          => "3",
			"type"		=> "textarea"),

		  array("field_name"	=> "event_image",
			"label"		=> "Event Image",
			"title"		=> "",
			"size"		=> "80",
			"maxlength"	=> "90",
			"type"		=> "text"),

		);
// stop array
regform($BASE, $MAINBASE, $dbtable, $formfields);
?>
