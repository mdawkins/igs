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

function left_display( $table, $lscol, $idcol, $nmcol, $nmtit ) {
	global $WEBSITE;
	global $rewriteurl;
?>
<div class=tbl_col>
<h4 class=title_front>Browse by <?php echo $nmtit; ?></h4>
<?php 
$query = "SELECT * FROM $table WHERE $lscol = 'yes' ORDER BY $nmcol";
$result = query_db($query);
if ( ($num_rows = mysqli_num_rows($result) )!=0 ) {
	while ( $row = $result->fetch_assoc() ) { 
		$ahref = $WEBSITE;
		if ( $rewriteurl == "yes" ) {
			if ( !empty($idcol) ) {
				$ahref .= '/'.$row[$nmcol].'/'.$row[$idcol];
			} else {
				$ahref .= '/'.$table.'/'.$row[$nmcol];
			}
		} else {
			$ahref .= "/index.php?";
			if ( !empty($idcol) ) {
				$ahref .= "$idcol=".$row[$idcol];
			} else {
				$ahref .= "search=".$row[$nmcol];
			}
		}
		echo"\t<a style=\"padding:4px;\" class=dark_med href=\"".str_replace(" ","-",$ahref).'">'.$row[$nmcol]."</a><br />\n";
	}
}
?>
	<a style="padding:4px;" href="<?php echo $WEBSITE; ?>/showall.html" class=dark_med><u>Show All</u></a><br />
</div>
<?php
}
?>
