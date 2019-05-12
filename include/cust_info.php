<?php	

$fields = 'user_id, cust_fn, cust_mi, cust_ln, cust_addr1, cust_addr2, cust_city, cust_state, cust_zip, cust_tel_hm, cust_email';
$tables = 'cust_info';
$wheres = 'user_id=\''.$_COOKIE["cookie_user"].'\'';
$query = 'SELECT '.$fields.' FROM '.$tables.' where '.$wheres;
#echo "query:  $query";
global $result;
$result = query_db($query);
$row = mysqli_fetch_array($result);
list($cust_zip1, $cust_zip2) = explode("-",$row["cust_zip"]);
echo "\t".'<label for=user_id>User Id:</label><font class=dark_med>'.$row["user_id"].'</font><br />
	<label for=cust_name>Name:</label><font class=dark_med>'.$row["cust_fn"].' '.$row["cust_mi"].' '.$row["cust_ln"].'</font><br />
	<label for=cust_addr>Address:</label><font class=dark_med>'.$row["cust_addr1"].'  '.$row["cust_addr2"].'</font><br/>
	<label for=cust_addr>&nbsp;</label><font class=dark_med>'.$row["cust_city"].', '.$row["cust_state"].' '.$row["cust_zip"].'</font><br />
	<label for=cust_email>E-mail:</label><font class=dark_med>'.$row["cust_email"].'</font><br />
	<label for=change_info>&nbsp;</label><a class=field2 href="index.php?main=cust_info"><u>Change Information</u></a><br />

	<input type="hidden" value="'.$row["cust_fn"].'" name="cust_fn">
	<input type="hidden" value="'.$row["cust_mi"].'" name="cust_mi">
	<input type="hidden" value="'.$row["cust_ln"].'" name="cust_ln">
	<input type="hidden" value="'.$row["cust_addr1"].'" name="cust_addr1">
	<input type="hidden" value="'.$row["cust_addr2"].'" name="cust_addr2">
	<input type="hidden" value="'.$row["cust_city"].'" name="cust_city">
	<input type="hidden" value="'.$row["cust_state"].'" name="cust_state">
	<input type="hidden" value="'.$cust_zip1.'" name="cust_zip1">
	<input type="hidden" value="'.$cust_zip2.'" name="cust_zip2">
	<input type="hidden" value="'.$row["cust_zip"].'" name="cust_zip">
	<input type="hidden" value="'.$row["cust_tel_hm"].'" name="cust_tel_hm">
	<input type="hidden" value="'.$row["cust_email"].'" name="cust_email">'."\n";

?>
