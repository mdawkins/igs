<?php
if($_COOKIE["items_tray"]) {
	$qty_item = 0;
	$cookie_key;
	$cookie_tray;
	while(list($key,$value)=each($_COOKIE["items_tray"])) { 
		$cookie_key[$qty_item] = $key;	
		$cookie_value[$qty_item] = $value;	
		$qty_item++; 
	}
	// Get the description of the selected items
	// Generate the query
	$columns.= "product.id, prod_name as product, product.sku, product.prod_price, ship_rate.ship_cost";
	#$columns.= "product.id, concat(prod_name,' - ',subcat_name,' - ',cat_name) as product, product.sku, product.prod_price, ship_rate.ship_cost";
	$table = "product, cat, subcat, ship_rate";
	for($i=0; $i<$qty_item; $i++) {  
		if ($qty_item == 1)
			$where_stat = 'id = \''.$cookie_key[$i].'\' ';
   		elseif ($qty_item > 1 && $i == 0 )
			$where_stat = '(id = \''.$cookie_key[$i].'\' OR ';
		elseif ($i == ($qty_item-1))
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
	#require "include/change_check.js";
?>
<form method=post action="change_qty.php">
<div class=tbl_front>
			
<?php
	/* This is commented out until I can find out how to get the js to work on an array of remove_item
	if and when it works again, you need to nest it into a table again
	if(mysqli_num_rows($result)>1) {
		<td width="9%" align=center><input type=checkbox onClick="this.value=check(this.form.remove_item)"></td>
		<td width="21%" class=lite_large>Remove All</td>
	} else {
		<td width=10% class=lite_large>&nbsp;</td>
		<td width=20% class=lite_large>&nbsp;</td>
		}
*/
?>	<h4 class=title_form>Following items are in your cart</h4>
	<div class=div_cart style="width:10%;">Remove Item</div>
	<div class=div_cart style="width:5%;">No.</div>
	<div class=div_cart style="width:15%;">SKU</div>
	<div class=div_cart style="width:40%;">Product Name</div>
	<div class=div_cart style="width:5%;">Qty</div>
	<div class=div_cart style="width:14%;">Unit Price</div>
	<div class=div_cart style="width:9%;">Cost</div>
	<br />
<?php 
// Display item info resulted by query 
$j= 0 ;
$total_price = 0;
while(($row = mysqli_fetch_array($result))) {
?>
	<div class=div_cart style="width:10%;"><input type="checkbox" name="remove_item[<?php echo $row["id"]; ?>]"></div>
	<div class=div_cart style="width:5%;"><?php echo $j+1; ?></div>
	<div class=div_cart style="text-align:left;width:15%;"><?php  echo $row["sku"]; ?></div>
	<div class=div_cart style="text-align:left;width:40%;"><?php  echo $row["product"]; ?></div>
	<div class=div_cart style="width:5%;"><input type="text" name="qty<?php echo $row["id"]; ?>" size="1" value="<?php echo $_COOKIE["items_tray"][$row["id"]]; ?>" maxlength="4"></div>
	<div class=div_cart style="width:14%;"><?php echo '$'.$row["prod_price"].'ea'; ?></div>
	<div class=div_cart style="text-align:right;width:9%;"><?php echo '$'; printf("%.2f",($row["prod_price"])*($_COOKIE["items_tray"][$row["id"]])); ?></div>
	<br />
<?php
	$j++ ;
	$total_price = $total_price+($row["prod_price"]*$_COOKIE["items_tray"][$row["id"]]);
	$total_sh = $total_sh+($row["ship_cost"]*$_COOKIE["items_tray"][$row["id"]]);
	if($total_price > $FREE_SHIPPING_LIMIT)
		$total_sh = 0;
	elseif($total_sh > $SHIPPING_LIMIT)
		$total_sh = $SHIPPING_LIMIT;
} // End of while

$tax = $total_price*$tax_rate;
?>
	<br />
	<div style="width:74%;display:inline;float:left;">&nbsp;</div>
	<div style="width:1%;display:inline;float:left;">&nbsp;</div>
	<div class=div_cart style="text-align:left;width:8%;">Subtotal</div>
	<div class=div_cart style="text-align:right;width:15%;">$<?php printf("%.2f",$total_price); ?></div>
	<br />
	
	<div class=div_cart style="text-align:left;width:74%;"><a class=dark_med href="http://<?php echo $_SERVER["HTTP_HOST"]; ?>/policies.html#shipping"><u>Click here</u></a> to see the Shipping &amp; Handling Policy.</div>
	<div style="width:1%;display:inline;float:left;">&nbsp;</div>
	<div class=div_cart style="text-align:left;width:8%;">S&H</div>
	<div class=div_cart style="text-align:right;width:15%;">$<?php printf("%.2f",$total_sh); ?></div>
	<br />
	
	<div class=div_cart style="text-align:left;width:74%;">&nbsp;</div>
	<div style="text-align:left;width:1%;display:inline;float:left;">&nbsp;</div>
	<div class=div_cart style="text-align:left;width:8%;">Total</div>
	<div class=div_cart style="text-align:right;width:15%;">$<?php printf("%.2f",$total_price+$total_sh+$tax); ?></div>
	<br />

	<h4 class=title_form>
	<input type="button" name="button" value="Back to last page" class=submit onClick="history.go(-1)">
	<input type="submit" name="button" value="Remove Item" class=submit>
	<input type="submit" name="button" value="Change Quantity" class=submit>
	<input type="submit" name="button" value="Check Out" class=submit>
	</h4>
</div>
</form>
<?php
}
else
{
?>
<div width=100% align="center">
	<p align="center" class=dark_large>Your cart is empty!</p>
</div>
<?php 
}
?>
