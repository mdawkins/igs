<?php
// open connection
// fetch values from database using the array below
// and put the corresponding values into the correct variables
// if no record found, then set $validfield=FALSE and treat this as a new record
// but fill in the corresponding field
// build the sql query
if(isset($_GET["value"])) {
	$value = $_GET["value"];
} elseif(isset($_POST["value"])) {
	$value = $_POST["value"];
}
$sql_query = "select ";
for ($i=0;$i<$FIELDCNT;$i++) {
	if ($formfields[$i]["type"] == "file" && $MAINBASE != "featart") {
		$sql_query .= $formfields[$i]["field_name"] . "_name, ";
	} elseif($formfields[$i]["field_name"] == "user_id" && $MAINBASE != "order_info") {
		$sql_query.= "cust_info.user_id, ";
	} elseif($formfields[$i]["type"] != "orderby" && $formfields[$i]["type"] != "dates" && $formfields[$i]["type"] != "title" && $formfields[$i]["type"] != "button" && $formfields[$i]["type"] != "display_order") {
		$sql_query .= $formfields[$i]["field_name"] . ", ";
	}
}
$sql_query=trim($sql_query);
$sql_query = substr($sql_query, 0, -1);
$sql_query.= " from ".$dbtable;
if($MAINBASE != "featart") {
	$sql_query.= " where ".$_GET["searchfield"]."='".$value."'";
	if(!empty($add_stat)) {
		$sql_query.=' and'.$add_stat; // this is for queries that require 2 or more tables
	}
}
$sql_query.= " limit 1" ;
//echo $sql_query;
$result = query_db($sql_query);
$query_result = mysqli_fetch_array($result);
for ($i=0;$i<$FIELDCNT;$i++) {
	if ($formfields[$i]["type"] == "file") {
		$_POST[$formfields[$i]["field_name"]] = $query_result[$formfields[$i]["field_name"] . "_name"];
	} else {
		$_POST[$formfields[$i]["field_name"]] = $query_result[$formfields[$i]["field_name"]];
	}
}
?>
