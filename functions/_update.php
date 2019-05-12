<?php
$sql_query="update " . $dbtable . " set ";
for ($i=0;$i<$FIELDCNT;$i++) {
// determing form input type
	if ($formfields[$i]["type"] == "file") {
		if (!empty($_FILES[$formfields[$i]["field_name"]]["name"])) {
        		$quick_sql = 'select * from '.$dbtable.' where '.$formfields[0]["field_name"]."='".$_POST[$formfields[0]["field_name"]].'\'';
			$result = query_db($quick_sql);
         		while($row = mysqli_fetch_array($result)) {
				$str_image=str_replace("image/", "", $_FILES[$formfields[$i]["field_name"]]["type"]);
				$image_name = $row[$formfields[0]["field_name"]].'.'.$str_image;
			}
         		$sql_query .= $formfields[$i]["field_name"]."_name='".$image_name."', ";
         		copy($_FILES[$formfields[$i]["field_name"]]["tmp_name"], $FILE_LOCATION.$image_name);
		}
	} elseif ($formfields[$i]["type"] == "checkbox") {
	  	if ($_POST[$formfields[$i]["field_name"]] == "on") {
	     		$sql_query .= $formfields[$i]["field_name"]."='yes', ";
		} else {
     			$sql_query .= $formfields[$i]["field_name"]."='no', ";
     		}
	} elseif ($_POST["update_passwd"] == "yes") { // this is a special case envolves several forms
		if (substr($formfields[$i]["field_name"],0,5) == "cust_" && substr($formfields[$i]["field_name"],-5,5) != "_conf") {
			$sql_query .= "cust_passwd = '".$_POST[$formfields[$i]["field_name"]]."', ";
			$_POST["new_passwd"] = $_POST[$formfields[$i]["field_name"]];
		}
	} elseif ($_GET["main"] == "emailpasswd") { // this is a special case forgotten password
		$sql_email="select user_id, cust_email from cust_info where cust_email = '".$_POST["cust_email"]."'";
		$sql_email=stripslashes($sql_email);
                $result = query_db($sql_email);
                #$result = query_db($sql_email);
		$row = mysqli_fetch_array($result);
		if(isset($row["cust_email"])) {
        		$rand_num = rand(6,8);
        		for($i=0;$i<$rand_num;$i++) {
                		$rand_passwd .= rand (0,9);
        		}
        		$sql_query .= "cust_passwd ='".$rand_passwd."', ";
			$_GET["value"] = $_POST["cust_email"];
			$_POST["email_address"] = $_POST["cust_email"];
			$_POST["user_id"] = $row["user_id"];
			$_POST["rand_passwd"] = $rand_passwd;
		}
	} elseif ($formfields[$i]["type"] != "orderby" && $formfields[$i]["type"] != "dates" && $formfields[$i]["type"] != "title" && $formfields[$i]["type"] != "button" && ($formfields[$i]["type"] != "passwd" &&  (substr($formfields[$i]["field_name"],0,4) != "old_" && substr($formfields[$i]["field_name"],-5,5) != "_conf")) && $formfields[$i]["type"] != "hidden") {
  		$sql_query .= $formfields[$i]["field_name"]."='".$_POST[$formfields[$i]["field_name"]]."', ";
  	}
  	// end of determing form input type
}
$sql_query = trim($sql_query);
$sql_query = substr($sql_query, 0, -1);
$sql_query .= " where ".$_GET["wherefield"]."='".$_GET["value"]."'";
#echo "query: $sql_query";
$result = query_db($sql_query);	
for ($i=0;$i<$FIELDCNT;$i++) {
  	unset($_POST[$formfields[$i]["field_name"]]);
}

?>
