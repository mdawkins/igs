<?php
// Check whether the user is already authenticated or not
if (!authenticateUser( $_COOKIE["cookie_user"], $_COOKIE["cookie_passwd"]))
{
   require_once '../include/registry.php';
   exit();
}
if(!$_GET["filename"] == "")
{
?>
<script LANGUAGE="JavaScript">
 window.open("page.php?filename=<?php echo $_GET["filename"].'s'; ?>","","scrollbar=yes height=auto,width=auto,left=80,top=80");
</script>
<?php
}
?>
<div class=tbl_front>

	<div class=spacer>&nbsp;</div>

	<div class=tbl_display style="width:282px;height:100px;float:left;">
	<h4 class=title_form><u>Welcome to <?php echo $BUSINESSNAME; ?></u></h4>
	<p class=dark_med style="text-align:left;padding:4px;margin:0;">Please check out all the different benefits you may receive as a Registered User of <?php echo $BUSINESSNAME; ?>.</p>
	</div>

	<div class=tbl_display style="width:282px;height:100px;float:left;">
        <h4 class=title_form><a class=lite_med href="<?php echo $PHP_SELF; ?>?main=account_status"><u>Order History</u></a></h4>
	<p class=dark_med style="text-align:left;padding:4px;margin:0;">You can review the status of the orders that you have made here!</p>
	</div>

	<div class=tbl_display style="width:282px;height:100px;float:left;">
        <h4 class=title_form width=100%><a class=lite_med href="<?php echo $PHP_SELF; ?>?main=cust_info&amp;searchfield=user_id"><u>Change Personal Information</u></a></h4>
        <p class=dark_med style="text-align:left;padding:4px;margin:0;">Please click here if you would like to update or change any of your personal information</p>
	</div>

	<div class=tbl_display style="width:282px;height:100px;float:left;">
        <h4 class=title_form><a class=lite_med href="logout.php"><u>Log out</u></a></h4>
        <p class=dark_med style="text-align:left;padding:4px;margin:0;">Please click here if you would like to log out of you account</p>
	</div>
	
	<div class=spacer>&nbsp;</div>

</div>

