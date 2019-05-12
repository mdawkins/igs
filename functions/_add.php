<?php

// We're ADDING a record to the database
$sql_query="insert ".$dbtable." set ";
for ($i=0;$i<$FIELDCNT;$i++)
{
	// we need to copy this file into the appropriate storage location  $FILE_LOCATION
	if ($formfields[$i]["type"] == "file")
	{
		if (!empty($_FILES[$formfields[$i]["field_name"]]["name"]))
		{
			$sql_query .= $formfields[$i]["field_name"]."_name='".$_FILES[$formfields[$i]["field_name"]]["name"]."', ";
			copy($_FILES[$formfields[$i]["field_name"]]["tmp_name"], $FILE_LOCATION.$_FILES[$formfields[$i]["field_name"]]["name"]);
			#echo "QuErY: $sql_query <br>\n";
		}
	}
	elseif ($formfields[$i]["type"] == "checkbox")
	{
		if ($_POST[$formfields[$i]["field_name"]] == "on")
		{
			$sql_query .= $formfields[$i]["field_name"] . "='yes', ";
		}
		else
		{
			$sql_query .= $formfields[$i]["field_name"] . "='no', ";
		}
	}
	elseif ($formfields[$i]["type"] == "zip")
	{
		$sql_query .= $formfields[$i]["field_name"]."='".$_POST[$formfields[$i]["field_name"]."1"];
		if (!empty($_POST[$formfields[$i]["field_name"]."2"]))
			$sql_query .="-" . $_POST[$formfields[$i]["field_name"]."2"];
		$sql_query .= "', ";
	}
	elseif ($formfields[$i]["type"] == "tel")
	{
		$sql_query .= $formfields[$i]["field_name"]."='".$_POST[$formfields[$i]["field_name"]."1"];
		if (!empty($_POST[$formfields[$i]["field_name"]."2"]))
			$sql_query .="-" . $_POST[$formfields[$i]["field_name"]."2"];
		if (!empty($_POST[$formfields[$i]["field_name"]."3"]))
			$sql_query .="-" . $_POST[$formfields[$i]["field_name"]."3"];
		$sql_query .= "', ";
	}
	elseif ($formfields[$i]["type"] == "password")
	{
		if (substr($formfields[$i]["field_name"], -5)!="_conf")
			$sql_query .= $formfields[$i]["field_name"] . "='" . $_POST[$formfields[$i]["field_name"]] . "', ";
	}
	elseif ($formfields[$i]["type"] != "title" && $formfields[$i]["type"] != "button" && $formfields[$i]["type"] != "hidden" && $formfields[$i]["type"] != "orderby" && $formfields[$i]["type"] != "dates")
	{
		$sql_query .= $formfields[$i]["field_name"] . "='" . $_POST[$formfields[$i]["field_name"]] . "', ";
	}
//	else // this else was adding because im merging admin and osourceshop functions why was it removed from oss?
//	{
//		$sql_query .= $formfields[$i]["field_name"] . "='" . $_POST[$formfields[$i]["field_name"]] . "', ";
//	} // removed because of types like title, button, hidden, dates, orderby
}
$sql_query=trim($sql_query);
$sql_query = substr($sql_query, 0, -1);
#echo "query: ".$sql_query."<br>\n";
global $DB;
$result = query_db($sql_query);
for ($i=0;$i<$FIELDCNT;$i++)
{
	unset($_POST[$formfields[$i]["field_name"]]);
}
?>
