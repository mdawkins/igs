<?php
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

include "../include/copy_fields.js";
include '../forms/order_form.php';
?>
