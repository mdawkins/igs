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


if(isset($_COOKIE["cookie_post"]))
{
   $line=split(";",$_COOKIE["cookie_post"]);
   foreach ($line as $postvar)
   {
      list($postname, $postvarible)=split(",",$postvar);
      $_POST[$postname] = $postvarible;
   }
   setcookie('cookie_post', "", 0, '/', $SITECOOKIE, FALSE); // this was commentted out but i don't know why yet
}

global $DB;
echo '<form name="billing" method=post action="formbase.php?main=insert_order">'."\n";
$page ='<div class=tbl_title_front>

	<h4 class=title_form>Customer Information</h4>
	<label for=user_id>User Id:</label><font class=dark_med>'.$_COOKIE["cookie_user"].'</font><br />
	<label for=cust_name>Name:</label><font class=dark_med>'.$_POST["cust_fn"].' '.$_POST["cust_mi"].' '.$_POST["cust_ln"].'</font><br />
	<label for=cust_addr>Address:</label><font class=dark_med>'.$_POST["cust_addr1"].'  '.$_POST["cust_addr2"].'</font><br />
	<label for=cust_addr>&nbsp;</label><font class=dark_med>'.$_POST["cust_city"].', '.$_POST["cust_state"].' '.$_POST["cust_zip"].'</font><br />
	<label for=cust_tel>Home Telephone:</label><font class=dark_med>'.$_POST["cust_tel_hm"].'</font><br />
	<label for=cust_email>E-mail:</label><font class=dark_med>'.$_POST["cust_email"].'</font><br />

	<h4 class=title_form>Shipping Information</h4>'."\n";

if($_POST["ship_copy"] == "on")
{
$page.="\t".'<label for=same style="width:auto;">Same as Customer Information</label><br />';
}
else{
$page.="\t".'<label for=ship_name>Name:</label><font class=dark_med>'.$_POST["ship_fn"].' '.$_POST["ship_mi"].' '.$_POST["ship_ln"].'</font><br />
	<label for=ship_addr>Address:</label><font class=dark_med>'.$_POST["ship_addr1"].'  '.$_POST["ship_addr2"].'</font><br />
	<label for=ship_addr>&nbsp;</label><font class=dark_med>'.$_POST["ship_city"].', '.$_POST["ship_state"].' '.$_POST["ship_zip"].'</labfont><br />';
}
echo $page;
$page_bill='
	<h4 class=title_form>Billing Information</h4>
	<label for=card_name>Card Holders Name:</label><font class=dark_med>'.$_POST["card_name"].'</font><br />
	<label for=card_name>Card Number:</label><font class=dark_med>'; $page_bill2='</font><br />
	<label for=card_type>Card Type:</label><font class=dark_med>'.$_POST["card_type"].'</font><br />
	<label for=card_exp>Card Expiration Date:</label><font class=dark_med>'.$_POST["card_exp"].'</font><br />
	<label for=card_exp>Card Security Code:</label><font class=dark_med>'.$_POST["card_cvc"].'</font><br />'."\n";

echo $page_bill;
#echo $_POST["card_num"]; // display entire number
$card_num = $_POST["card_num"];
$card_replace = strlen($card_num)-4;
for($i=0;$i<$card_replace;$i++)
	$card_replace_string.="*";
$card_num_safe = (substr($_POST["card_num"], -4, 4));
$card_num_safe = $card_replace_string.$card_num_safe;
echo $card_num_safe; // display safe card number
echo $page_bill2;
$qty_item = 0;
$cookie_key;
$cookie_tray;
while(list($key,$value)=each($_COOKIE["items_tray"]))
{
        $cookie_key[$qty_item] = $key;
        $cookie_value[$qty_item] = $value;
        $qty_item++;
}

// cart section
// Get the description of the selected items
// Generate the query
#$columns.= "product.id, concat(product.prod_name,' - ', cat.cat_name,' - ', subcat.subcat_name) as product, product.sku, product.prod_price, ship_rate.ship_cost";
$columns.= "product.id, prod_name as product, product.sku, product.prod_price, ship_rate.ship_cost";
$table = "product, cat, subcat, ship_rate";
for($i=0; $i<$qty_item; $i++)
{
   if ($qty_item == 1)
      $where_stat = 'id = \''.$cookie_key[$i].'\' ';
   else if ($qty_item > 1 && $i == 0 )
      $where_stat = '(id = \''.$cookie_key[$i].'\' OR ';
   else if ($i == ($qty_item-1))
      $where_stat.= 'id = \''.$cookie_key[$i].'\') ';
   else
      $where_stat.= 'id = \''.$cookie_key[$i].'\' OR ';
}
$where_stat.= "AND product.cat_id = cat.cat_id ";
$where_stat.= "AND product.subcat_id = subcat.subcat_id ";
$where_stat.= "AND product.ship_code = ship_rate.ship_code";
$query= 'select '.$columns.' from '.$table.' where '.$where_stat.' order by prod_name';
#echo $query;
$result = query_db($query);
// determine if inside tax areas
$query2 = 'select zip_code, zip_type, tax_name, tax_rate from zip_code, tax_rate where zip_code = \''.$_POST["ship_zip"].'\'';
// old way when I matched zip_type and tax_name
#$query2 = 'select zip_code, tax_name, tax_rate from zip_code, tax_rate where zip_code = \''.$_POST["ship_zip"].'\' AND tax_name = zip_type';
$result2 = query_db($query2);
$page_cart='
 	<h4 class=title_form>Following items are in your cart</h4>
	<div class=div_cart style="width:10%;">No.</div>
	<div class=div_cart style="width:15%;">SKU</div>
	<div class=div_cart style="width:38%;">Product Name</div>
	<div class=div_cart style="width:10%;">Qty</div>
	<div class=div_cart style="width:15%;">Unit Price</div>
	<div class=div_cart style="text-align:right;width:10%;">Cost</div>
 	<br />';

// Display item info resulted by query 
$j= 0 ;
$total_price = 0;
while($row1 = mysqli_fetch_array($result))
{
	$prod_price = number_format(($row1["prod_price"])*($_COOKIE["items_tray"][$row1["id"]]), 2, '.', '');
	$ship_cost = number_format(($row1["ship_cost"])*($_COOKIE["items_tray"][$row1["id"]]), 2, '.', '');
	$page_cart.='
	<div class=div_cart style="width:10%;">'.++$j.'</div>
	<div class=div_cart style="text-align:left;width:15%;">'.$row1["sku"].'</div>
	<div class=div_cart style="text-align:left;width:38%;">'.$row1["product"].'</div>
	<div class=div_cart style="width:10%;">'.$_COOKIE["items_tray"][$row1["id"]].'</div>
	<div class=div_cart style="width:15%;">$'.$row1["prod_price"].'ea</div>
	<div class=div_cart style="text-align:right;width:10%;">$'.$prod_price.'</div>
 	<br />';
	#   $j++ ;
	$total_price = $total_price+($row1["prod_price"]*$_COOKIE["items_tray"][$row1["id"]]);
	$total_sh = $total_sh+($row1["ship_cost"]*$_COOKIE["items_tray"][$row1["id"]]);
} // End of while

// old way when I matched zip_type and tax_name
#$row2 = mysqli_fetch_array($result2);
// old way when I matched zip_type and tax_name
#$tax_rate = $row2["tax_rate"]; 
while($row2 = mysqli_fetch_array($result2))
{
	if($row2["tax_name"] == 'state' && ($row2["zip_type"] == 'state' || $row2["zip_type"] == 'county' || $row2["zip_type"] == 'city') )
	{
		$tax_rate = $row2["tax_rate"];
		$state_tax = number_format($row2["tax_rate"]*$total_price, 2, '.', '');
	}
	elseif($row2["tax_name"] == 'county' && ($row2["zip_type"] == 'county' || $row2["zip_type"] == 'city') )
	{
		$tax_rate = $tax_rate+$row2["tax_rate"];
		$county_tax = number_format($row2["tax_rate"]*$total_price, 2, '.', '');
	}
	elseif($row2["tax_name"] == 'city' && $row2["zip_type"] == 'city')
	{
		$tax_rate = $tax_rate+$row2["tax_rate"];
		$city_tax = number_format($row2["tax_rate"]*$total_price, 2, '.', '');
	}
#echo 'tax_rate: '.$tax_rate."<br>";
#echo 'zip_type: '.$row2["zip_type"].'<br>';
#echo 'tax_name: '.$row2["tax_name"].'<br>';
}

$tax = $total_price*$tax_rate;

$total_price = number_format($total_price, 2, '.', '');
if($total_price > $FREE_SHIPPING_LIMIT)
	$total_sh = 0;
elseif($total_sh > $SHIPPING_LIMIT)
        $total_sh = $SHIPPING_LIMIT;

$total_sh = number_format($total_sh, 2, '.', '');
$tax = number_format($tax, 2, '.', '');
$total = number_format(($total_price+$total_sh+$tax), 2, '.', '');
$page_cart.='
	<br />
	<div style="width:72%;display:inline;float:left;">&nbsp;</div>
	<div style="width:1%;display:inline;float:left;">&nbsp;</div>
	<div class=div_cart style="text-align:left;width:15%;">Subtotal</div>
	<div class=div_cart style="text-align:right;width:10%;">$'.$total_price.'</div>
        <br />

	<div class=div_cart style="text-align:left;width:72%;"><a href="http://'.$_SERVER["HTTP_HOST"].'/policies.html#tax" class=dark_med><u>Click here</u></a> to see the taxable areas.</div>
	<div style="text-align:left;width:1%;display:inline;float:left;">&nbsp;</div>
	<div class=div_cart style="text-align:left;width:10%;">Tax</div>
	<div class=div_cart style="text-align:right;width:15%;">$'.$tax.'</div>
	<br />

	<div class=div_cart style="text-align:left;width:72%;"><a href="http://'.$_SERVER["HTTP_HOST"].'/policies.html#shipping" class=dark_med><u>Click here</u></a> to see the Shipping &amp; Handling Policy.</div>
	<div style="text-align:left;width:1%;display:inline;float:left;">&nbsp;</div>
	<div class=div_cart style="text-align:left;width:10%;">S&H</div>
	<div class=div_cart style="text-align:right;width:15%;">$'.$total_sh.'</div>
        <br />

	<div class=div_cart style="text-align:left;width:72%;">&nbsp;</div>
	<div style="text-align:left;width:1%;display:inline;float:left;">&nbsp;</div>
	<div class=div_cart style="text-align:left;width:10%;">Total</div>
	<div class=div_cart style="text-align:right;width:15%;">$'.$total.'</div>
	<br />';

if(!empty($_POST["special_intr"]))
{
	$special_intructions='
	<h4 class=title_form>Special Instructions</h4>
	<p>'.$_POST["special_intr"].'</p>';
}
chdir("../siteinfo");
$dir1=opendir(".");
if($file1=fopen("greeting.php", "r"))
{
	$greeting=fread($file1,filesize("greeting.php"));
	fclose($file1);
}

$css_header='<link rel="stylesheet" type="text/css" href="http://www.intriguegiftshop.com/default.css.php">'."\n";
$buttons_print ='
	<h4 class=title_button><input name="print" type="button" value="Print"ONCLICK="varitext()">
	<input name="print" type="button" value="Close"ONCLICK="window.close()"></h4>
</div>';

chdir("../");
$dir2=opendir(".");	
echo $page_cart;
echo $special_intructions;

$timestamp = time();
chdir("orders");
$dir=opendir(".");

$replace_div_cart = 'style="display:inline; float:left; color: '.$color_dark.'; font-size: 12px; text-decoration: none; background-color: transparent; font-weight: bold;" ';
$page_cart = str_replace('class=div_cart style=', $replace_div_cart, $page_cart);

if($file=fopen($timestamp, "w"))
{
	fwrite($file, "$css_header"."$page"."$page_bill"."$card_num"."$page_bill2"."$page_cart"."$special_intructions"."</div>");
	fclose($file);
}

if($file=fopen($timestamp."s", "w"))
{
	fwrite($file, "$css_header"."$greeting"."$page"."$page_bill"."$card_num_safe"."$page_bill2"."$page_cart"."$special_intructions"."$buttons_print");
	fclose($file);
}

?>
	<input type=hidden name="total_cost" value="<?php echo $total; ?>">
	<input type=hidden name="order_cost" value="<?php echo $total_price; ?>">
	<input type=hidden name="ship_cost" value="<?php echo $total_sh; ?>">
	<input type=hidden name="order_tax" value="<?php echo $tax; ?>">
	<input type=hidden name="state_tax" value="<?php echo $state_tax; ?>">
	<input type=hidden name="county_tax" value="<?php echo $county_tax; ?>">
	<input type=hidden name="city_tax" value="<?php echo $city_tax; ?>">
	<input type=hidden name="filename" value="<?php echo $timestamp; ?>">
	<input type=hidden name="cust_email" value="<?php echo $_POST["cust_email"]; ?>">
	<h4 class=title_form><input name="action" class=submit type="submit" value="Back"><input name="action" class="submit" type=submit value="Done"></h4>
</div>
</form>
