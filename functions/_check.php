<?php
// we must check to make sure required fields are indeed filled out.
$submitattempt="no";
for ($i=0;$i<$FIELDCNT;$i++) {
	switch ($formfields[$i]["type"]) {
		case "zip":
			if(!empty($_POST[$formfields[$i]["field_name"]."1"])) {
				$_POST[$formfields[$i]["field_name"]] = $_POST[$formfields[$i]["field_name"]."1"];
				if(!empty($_POST[$formfields[$i]["field_name"]."2"]))
					$_POST[$formfields[$i]["field_name"]].='-'.$_POST[$formfields[$i]["field_name"]."2"];
			}
			break;

		case  "password":
			if(($formfields[$i]["field_name"]."_conf" == $formfields[$i+1]["field_name"] && $_POST[$formfields[$i]["field_name"]] != $_POST[$formfields[$i+1]["field_name"]]) || ($formfields[$i]["field_name"] == $formfields[$i-1]["field_name"]."_conf" && $_POST[$formfields[$i]["field_name"]] != $_POST[$formfields[$i-1]["field_name"]])) {
				$badentry[$i]="yes";
				unset($_POST["action"]);
				$submitattempt="yes";
			} elseif(substr($formfields[$i]["field_name"],0,4) == "old_") {
				$sql_passwd='select cust_passwd from cust_info where user_id="'.$_COOKIE["cookie_user"].'"';
				global $DB;
				$result = query_db($sql_passwd);
				while($row=$result->fetch_assoc()) {
					if($row[substr($formfields[$i]["field_name"],4)] != $_POST[$formfields[$i]["field_name"]]) {
						$badentry[$i]="yes";
						$submitattempt="yes";
					}
				}
			}
			break;

		case "tel":
			if(!empty($_POST[$formfields[$i]["field_name"]."1"]) && !empty($_POST[$formfields[$i]["field_name"]."2"]) && !empty($_POST[$formfields[$i]["field_name"]."3"]))
				$_POST[$formfields[$i]["field_name"]] = $_POST[$formfields[$i]["field_name"]."1"].'-'.$_POST[$formfields[$i]["field_name"]."2"].'-'.$_POST[$formfields[$i]["field_name"]."3"];
			break;

		case "email":
			if(!eregi("^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$", $_POST[$formfields[$i]["field_name"]])) {
				$badentry[$i]="yes";
				unset($_POST["action"]);
				$submitattempt="yes";
			}
			$sql_email="select user_id, cust_email from cust_info where cust_email = '".$_POST[$formfields[$i]["field_name"]]."'";
			$sql_email=stripslashes($sql_email);
			$result = query_db($sql_email);
			$row = $result->fetch_assoc();
			if(!isset($row["cust_email"]) && $_POST["action"] == "Send E-mail") {
				$badentry[$i]="yes";
                                unset($_POST["action"]);
                                $submitattempt="yes";
			}
			break;
		case "user_id":
			$sql_user = 'select user_id from cust_info where '.$formfields[$i]["field_name"].' ="'.$_POST[$formfields[$i]["field_name"]].'"';
			global $DB;
			$result = query_db($sql_user);
			while($row=mysqli_fetch_array($result)) {
				if($row[$formfields[$i]["field_name"]] == $_POST[$formfields[$i]["field_name"]]) {
					$duplicateentry="yes";
					$submitattempt="yes";
				}
			}
			break;

	}
	
	if (($formfields[$i]["required"] == "yes") && empty($_POST[$formfields[$i]["field_name"]])) {
		#unset($_POST["action"]); // hopefully this is unneccesary
		$submitattempt="yes";
	}
}

?>
