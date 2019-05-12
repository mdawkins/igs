<?php

// this should only be used for edits pages 
$sql_query = "delete from ".$dbtable." where ".$formfields[1]["field_name"]."='".$_POST[$formfields[1]["field_name"]]."'";
$result = query_db($sql_query);
for ($i=0;$i<$FIELDCNT;$i++)
{
	unset($_POST[$formfields[$i]["field_name"]]);
}

?>
