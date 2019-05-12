<?php
#phpinfo(32);
require_once '../functions/functions.php';
#require_once '../config/admin_conf.inc'; //to use admin permissions instead of serv_conf
require_once '../config/serv_conf.inc'; // revert this to admin login

// Connect to the Database
$link = db_connect($DB_SERVER, $DB_LOGIN, $DB_PASSWORD, $DB);

// ****************************************************************************************
if ( $_POST["action"] == "Add" || $_POST["action"] == "Update" || $_POST["action"] == "Delete" || $_POST["action"] == "Continue" || $_POST["action"] == "Search")
	require_once '../edits/'.$_GET["main"].'.php';
// ****************************************************************************************
elseif ( $_POST["action"] == "Add Item" )
{ 
	require_once '../functions/change_qty.php';
	exit();
}
// ****************************************************************************************

?>
