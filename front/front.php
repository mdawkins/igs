<?php

require '../functions/functions.php';

// Connect to the Database
$link = db_connect($DB_SERVER, $DB_LOGIN, $DB_PASSWORD, $DB);

#require '../functions/record_useragent.php';
#record_useragent ($_SERVER["REMOTE_ADDR"], $_SERVER["HTTP_USER_AGENT"], $_SERVER["REQUEST_URI"]);

#$title= "Intrigue Gift Shop offers Mill Creek Studios, Andrea by Sadek, Kittys Critters, Windstone Editions";

if (!isset($_COOKIE["item_num"]))
        $item_num = 0;
elseif (isset($_COOKIE["item_num"]))
	$item_num = $_COOKIE["item_num"];

if ($_GET["pass_id"] != "") { // this is used by chg_qty
	setcookie('items_tray['.$_GET["pass_id"].']', '1', 0, '/', $SITECOOKIE, FALSE);
}

if(!isset($_COOKIE["cookie_user"])) {
	setcookie("cookie_user", "anonymous", 0, '/', $SITECOOKIE, FALSE);
	setcookie("check_out", "false", 0, '/', $SITECOOKIE, FALSE);
}

//gzip compression
ob_start("ob_gzhandler");

require_once '../config/title_page.php';


echo '<body onContextMenu="return false">'."\n";
echo '<div id=A1>'."\n";
require_once '../front/top.php';
echo '</div>
<div id=cover>
<table width=780px cellspacing=0 cellpadding=0>
	<tr>
		<td width=200 valign=top>
<div id=B2>';
#require_once '../front/search.php';
require_once '../front/artists.php';
require_once '../front/subjects.php';
require_once '../front/cat.php';
require_once '../front/addfav.php';
require_once '../front/copyright.php';
echo '</div>
		</td><td width=580 valign=top class=bg1>'."\n";
if( $_GET["main"] == "display_info" || $_GET["main"] == "account_status" ||
   $_GET["main"] == "cart" || $_GET["main"] == "billing" ||
   $_GET["main"] == "registry" || $_GET["main"] == "user_area" 
  ) {
	echo '<div id=C3>'."\n";
	require_once '../include/'.$_GET["main"].'.php';	
} elseif( $_GET["main"] == "change_pass" || $_GET["main"] == "cust_info" ||
   $_GET["main"] == "emailpasswd" ||
   $_GET["main"] == "order_form" || $_GET["main"] == "update_cust"
	) {
	echo '<div id=C3>'."\n";
	require_once '../forms/'.$_GET["main"].'.php';	
} elseif( $_GET["main"] == "showall" || isset($_GET["cat_id"]) || 
   isset($_GET["subcat_id"]) || isset($_GET["sku"]) ||
   isset($_GET["showall"]) || isset($_GET["search"]) || isset($_POST["search"])
	) {
	echo '<div id=C3>'."\n";
	require_once '../functions/display.php';	
} elseif( $_GET["main"] == "about"    || $_GET["main"] == "contact" ||
       $_GET["main"] == "priv"     || $_GET["main"] == "faq" ||
       $_GET["main"] == "policies" || $_GET["main"] == "instr" ||
       $_GET["main"] == "event"
      ) {
	echo '<div id=C3text>'."\n";
	require_once '../siteinfo/'.$_GET["main"].'.php';
} else {
	echo '<div id=C3>'."\n";
	require_once '../front/cat_front.php';
	echo'</div>';
	echo'<div id=D4>'."\n";
	require_once '../front/botarea.php';
	$botarea = "show";
	require_once '../functions/display.php';	
}  
echo '</div>';
?>
		</td>
	</tr>
</table>
</div>

</body>
</html>
<?php 
#phpinfo(32);
ob_end_flush();
?>
