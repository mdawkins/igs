<?php

require '../config/serv_conf.inc' ;

// Display error messages
function DisplayErrMsg( $message ) {
printf("<blockquote><blockquote><blockquote><h3><font color=\"#cc0000\">
        %s</font></h3></blockquote></blockquote></blockquote>\n", $message);
}

function db_connect($host, $DB_LOGIN, $DB_PASSWORD, $DB) {
	if (!($link = mysqli_connect($host, $DB_LOGIN, $DB_PASSWORD, $DB))) {
		DisplayErrMsg(sprintf("internal error %d:%s\n", mysqli_errno($link), mysqli_error($link)));
   		exit();
	}
	return $link;
}

function query_db($query, $showquery) {
	global $link;
	unset($result);
	if ( $showquery == TRUE || $showquery == "1" ) {
		echo "SQL: $query<br>\n";
	}

	if (!($result = mysqli_query($link, $query))) {
		DisplayErrMsg(sprintf("internal error %d:%s\n", mysqli_errno(), mysqli_error()));
    		exit();
	}
	return $result;
}

function authenticateUser($user_id, $cust_password) {
	global $link;
	$sql = "SELECT user_id, cust_passwd FROM cust_info WHERE user_id=\"$user_id\" ";
	if(!($result = mysqli_query($link, $sql))) {
		DisplayErrMsg(sprintf("internal error %d:%s\n", mysqli_errno(), mysqli_error()));
		return 0;
	}

	if ( ($row = mysqli_fetch_array($result)) && ($cust_password == $row['cust_passwd'] && $cust_password != "") ) {
   		return 1;
	} else {
   		return 0;
	}
}

function html_head($title) {
echo '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
 <head>
  <title>'.$title.'</title>';
  //<link rel="stylesheet" type="text/css" href="default.css.php">';
}

function html_head_end($scripts) {
echo "
$scripts	      
 </head>";
}

?>
