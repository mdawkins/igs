<?php
ob_start("ob_gzhandler");
#include_once"../include/functions.php";

require_once '../functions/functions.php';
require_once '../functions/regform.php';
require_once '../functions/selectbox.php';
require_once '../functions/lsitems.php';
require_once '../functions/lsprod.php';

// Connect to the Database
$link = db_connect($DB_SERVER, $DB_LOGIN, $DB_PASSWORD, $DB);

$title= "Administration";
$script= "";

html_head($title, $scripts);
echo '<link rel="stylesheet" type="text/css" href="default.css.php">';
echo "$html_body\n";

echo '<div id=A1>';
require_once "../front/topmenu.php";
echo '</div>';

?>
<div id=cover>
<div id=B2>
<table width="100%">
	<tr>
<?php

if (isset($_GET["lsmain"])) {
	echo "\t<td width=25%>\n";
	require_once '../include/lsmain.php';
	echo "\t</td>
		<td width=75% valign=top>\n";
} else {
	echo "\t<td width=100% valign=top>\n"; }

if ( $_GET["main"] == "cat" || $_GET["main"] == "subcat" || $_GET["main"] == "product" || $_GET["main"] == "subject"
	|| $_GET["main"] == "toparea" || $_GET["main"] == "botarea" || $_GET["main"] == "featart" 
	|| $_GET["main"] == "artist"
	|| $_GET["main"] == "file" || $_GET["main"] == "cust" || $_GET["main"] == "ship"
	|| $_GET["main"] == "event" || $_GET["main"] == "tax" || $_GET["main"] == "zip_code"
	|| $_GET["main"] == "search" || $_GET["main"] == "order" ||  $_GET["main"] == "order_info" ) {
        require "../edits/".$_GET["main"].".php";
} else if ($_GET["main"] == "cust_form" || $_GET["main"] == "order_form" || $_GET["main"] == "list_orders"
	|| $_GET["main"] == "list_cust" || $_GET["main"] == "display_cust" || $_GET["main"] == "display_order"
	|| $_GET["main"] == "pos" || $_GET["main"] == "list_prodimages" || $_GET["main"] == "uploadimage"
	|| $_GET["main"] == "list_report" || $_GET["main"] == "spread") {
	require '../include/'.$_GET["main"].'.php';
} else if($_GET["main"] == "ls_product") {
	lsprod($_POST["value"]);	
} else { // DEFAULT
}
?>
		</td>
	</tr>
</table>
</div>
</div>

</body>
</html>
<?php //*/
#phpinfo(32); 
ob_end_flush();
?>
