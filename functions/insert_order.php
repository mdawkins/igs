<?php
#require_once '../functions/functions.php';

// Check whether the user is already authenticated or not
if (!authenticateUser( $_COOKIE["cookie_user"], $_COOKIE["cookie_passwd"]))
{
	require_once '../include/registry.php';
	exit();
}
if ( $_COOKIE["check_out"] != 'true' )
{
   require_once '../include/cart.php';
   exit();
}
if ( !isset($_COOKIE["items_tray"]) )
{
   require_once '../include/cart.php';
   exit();
}

$sql =  "insert into order_info (user_id, order_date, order_cost, order_tax, state_tax, county_tax, city_tax, ship_cost, order_conf, timestamp, ip_addr) VALUES('".$_COOKIE["cookie_user"]."',curdate(), '".$_POST["order_cost"]."', '".$_POST["order_tax"]."', '".$_POST["state_tax"]."', '".$_POST["county_tax"]."', '".$_POST["city_tax"]."', '".$_POST["ship_cost"]."', 'pending', '".$_POST["filename"]."', '".$_SERVER["REMOTE_ADDR"]."')";

$sql = stripslashes($sql);
#echo "sql:  $sql";

if(!($db = mysqli_connect($DB_SERVER,'igsinsert','igsinsert', $DB)))
{
	DisplayErrMsg(sprintf("internal error %d:%s\n", mysqli_errno(), mysqli_error()));
       	exit() ;
}

if(!(mysqli_select_db($DB)))
{
       	DisplayErrMsg(sprintf("internal error %d:%s\n", mysqli_errno(), mysqli_error()));
       	exit() ;
}

$result = query_db($sql);

$order_id=mysqli_insert_id();
	
$sql_list = 'insert into order_list (order_id, prod_id, order_qty) values ';
while(list($key,$value)=each($_COOKIE["items_tray"]))
{
	$sql_list.= '(\''.$order_id.'\', \''.$key.'\', \''.$value.'\'),';
	setcookie('items_tray['.$key.']', "", 0, '/', $SITECOOKIE, FALSE);
}
$sql_list = substr($sql_list,0,strlen($sql_list)-1);
#echo 'sql_list: '.$sql_list;
$result = query_db($sql_list);

chdir("../orders");
$dir=opendir(".");
$file = fopen($_POST["filename"], "r");
$text = fread($file, filesize($_POST["filename"]));
fclose($file);
$file2 = fopen($_POST["filename"].'s', "r");
$text2 = fread($file2, filesize($_POST["filename"].'s'));
fclose($file2);

//e-mail order
$content_type = "text/html";
include "../config/mime_mail.inc";

# create object instance
$mail = new mime_mail;

# set all data slots
$mail->from    = $orders_email;
$mail->to    = $service_email;
$mail->subject = "Order Number".$order_id;
$mail->body    = "";
$mail->add_attachment($data, $text, $content_type);

# send e-mail
$mail->send();

# create object instance
$mail2 = new mime_mail;

# set all data slots
$mail2->from    = $orders_email;
$mail2->to      = $_POST["cust_email"]; // not getting thru
$mail2->subject = "Your Order ";
$mail2->body    = "";
$mail2->add_attachment($data, $text2, $content_type);

# send e-mail
$mail2->send();

setcookie('check_out', "false", 0, '/', $SITECOOKIE, FALSE);
$header_stat = "main=user_area&filename=".$_POST["filename"];
header('Location:index.php?'.$header_stat );

#phpinfo(32);
?>
