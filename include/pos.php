<?php
if($_COOKIE["items_tray"])
{
require_once '../functions/regform.php';
$BASE="Invoice";
$MAINBASE="pos";
$dbtable="cust_info";

$formfields=array(
		array("field_name"     => "invoice",
			"label"         => "Invoice",
			"title"         => "",
			"type"          => "title",),
	
		array("field_name"    => "cust_id",
			"label"         => "Customer",
			"title"         => "Customer",
			"maxlength"     => "30",
			"table"         => "cust_info",
			"field"         => "concat(cust_ln,', ',cust_fn)",
			"valuefield"    => "user_id",
			"type"          => "dropdown"),
		
		);
//regform($BASE, $MAINBASE, $dbtable, $formfields);
	
include '../include/autoadd.js';
$qty_item = 0;
$cookie_key;
$cookie_tray;
while(list($key,$value)=each($_COOKIE["items_tray"]))
{ 
	$cookie_key[$qty_item] = $key;	
	$cookie_value[$qty_item] = $value;	
	$qty_item++; 
}
// Get the description of the selected items
// Generate the query
$columns.= "product.id, prod_name as product, product.sku, product.prod_price, prod_image_name, ship_rate.ship_cost";
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
	
?>
<form method=post name="form" action="change_qty.php">
<div class=tbl_front>

	<h4 class=title_form>Invoice</h4>
	<div class=div_cart style="width:10%;">Remove</div>
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
while(($row = mysqli_fetch_array($result)))
{
$cost = number_format(($row["prod_price"]*$_COOKIE["items_tray"][$row["id"]]),"2",".","");
echo '
	<div class=div_cart style="width:10%;"><input type="checkbox" name="remove_item['.$row["id"].']"></div>
	<div class=div_cart style="width:5%;">'.($j+1).'</div>
	<div class=div_cart style="width:15%;"><a class=dark_med href="images/'.$row["prod_image_name"].'">'.$row["sku"].'</a></div>
	<div class=div_cart style="width:40%;"><a class=dark_med href="images/'.$row["prod_image_name"].'">'.$row["product"].'</a></div>
	<div class=div_cart style="width:5%;"><input type="text" name="qty'.$row["id"].'" size="1" value="'.$_COOKIE["items_tray"][$row["id"]].'" maxlength="4" align=right></div>
	<div class=div_cart style="width:14%;">$'.$row["prod_price"].'</div>
	<div class=div_cart style="width:9%;">$'.$cost.'</div>
	<br />'."\n";

$j++ ;
$total_price = $total_price+($row["prod_price"]*$_COOKIE["items_tray"][$row["id"]]);
if($total_price > 29.99)
	$total_sh = 0;
else
	$total_sh = $total_sh+($row["ship_cost"]*$_COOKIE["items_tray"][$row["id"]]);
} // End of while



$tax = $total_price*$tax_rate;
?>
	<div class=div_cart style="width:69%;">&nbsp;</div>
	<div class=div_cart style="width:1%;">&nbsp;</div>
	<div class=div_cart style="width:18%;">Subtotal</div>
	<div class=div_cart style="width:12%;"><input type=number name="subtotal" value=<?php printf("%.2f",$total_price); ?> size=6 align=right readonly></div>
	<br />
		
	<div class=div_cart style="width:69%;">&nbsp;</div>
	<div class=div_cart style="width:1%;">&nbsp;</div>
	<div class=div_cart style="width:18%;">Discount</div>
	<div class=div_cart style="width:12%;"><input type=number name="discount" size=6 onBlur="javascript:autoadd(this.name)" align=right value=0.00></div>
	<br />
		
	<div class=div_cart style="width:69%;">&nbsp;</div>
	<div class=div_cart style="width:1%;">&nbsp;</div>
	<div class=div_cart style="width:18%;">Tax</div>
	<div class=div_cart style="width:12%;"><input type=number name="tax" size=6 align=right readonly></div>
	<br />
		
	<div class=div_cart style="width:69%;">&nbsp;</div>
	<div class=div_cart style="width:1%;">&nbsp;</div>
	<div class=div_cart style="width:18%;">Total</div>
	<div class=div_cart style="width:12%;"><input type=text name="total" size=6 align=right readonly></div>
	<br />
		
	<div class=div_cart style="width:69%;">
	<input type="radio" name="group" value="cash">Cash
	<input type="radio" name="group" value="check">Check
	<input type="radio" name="group" value="credit">Credit
	<input type="radio" name="group" value="certificate">Gift Certificate
	</div>
	<div class=div_cart style="width:1%;">&nbsp;</div>
	<div class=div_cart style="width:18%;">Tendered</div>
	<div class=div_cart style="width:12%;"><input type=number name="tendered" size=6 onBlur="javascript:autoadd(this.name)" align=right></div>
	<br />
		
	<div class=div_cart style="width:69%;">&nbsp;</div>
	<div class=div_cart style="width:1%;">&nbsp;</div>
	<div class=div_cart style="width:18%;">Balance</div>
	<div class=div_cart style="width:12%;"><input type=number name="invoice_balance" size=6 align=right readonly></div>
	<br />

	<h4 class=title_button><input type="submit" name="button" value="Remove Item" class=submit><input type="submit" name="button" value="Change Quantity" class=submit><input type="submit" name="button" value="Done" class=submit></h4>
</div>
</form>
<?php
}
else
{
?>
<table width=100% align="center">
	<tr><td align="center" class=dark_large>Add item, cart is empty!</td></tr>
</table>
<?php 
}
?>
