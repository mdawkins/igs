<!-- start of registry login page -->
<?php
if ($_COOKIE["cookie_user"] == "anonymous")
	$value_name = ""; 
else 
	$value_name = $_COOKIE["cookie_user"];
?>
<p class=dark_med style="text-align: center;">
<?php
if($_GET["error"] == 'login') {
?>
<font color=red><b>ERROR</b></font><br>
Unknown user or password incorrect.<br>
<?php
} else {
echo 'Welcome to <u>'.$BUSINESSNAME.'</u>.<br><br>';
}
?>
If you are an existing customer. Login to
<?php
if($_COOKIE["check_out"] == "true" && isset($_COOKIE["items_tray"]) ) {
	echo ' continue your order.';
} else {
	echo ' enter your account.';
}
?>
</p>
<?php
require_once "../forms/login_form.php";
?>
<p class=dark_med style="text-align: center;">If you are new to our store, please take a moment to register with us. By registering you avoid reentering your contact information the next time you purchase from us.</p>
<?php
require_once "../forms/cust_form.php";
?>
<p class=dark_med style="text-align: center;">Complete your secure order with<br />
<!-- SSL Site Seal. Do not edit. -->
<script language="Javascript" src=""></script>
<!-- end SSL Site Seal -->
</p>
