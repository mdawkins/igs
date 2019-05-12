<?php

$sql = 'select prod_id, order_qty, ship_company, track_number, unit_price from order_list where order_id = "'.$_GET["value"].'"'; 

$result = query_db($sql);
$x=0;
while(($row = mysqli_fetch_array($result)))
{
	$prod_id[$x] = $row["prod_id"];
	$qty[$x] = $row["order_qty"];
	$ship_company[$x] = $row["ship_company"];
	$track_number[$x] = $row["track_number"];
	$unit_price[$x] = $row["unit_price"];
	$x++;
}

// Get the description of the selected items
// Generate the query
$columns.= "id, concat(prod_name,' - ', cat_name) as product, sku ";
$table = "product, cat";
for($i=0; $i<$x; $i++)
{
   if ($x == 1)
      $where_stat = 'id = \''.$prod_id[$i].'\' ';
   else if ($x > 1 && $i == 0 )
      $where_stat = '(id = \''.$prod_id[$i].'\' OR ';
   else if ($i == ($x-1))
      $where_stat.= 'id = \''.$prod_id[$i].'\') ';
   else
      $where_stat.= 'id = \''.$prod_id[$i].'\' OR ';
}
$where_stat.= "AND product.cat_id = cat.cat_id ";
$query= 'select '.$columns.' from '.$table.' where '.$where_stat.' order by prod_name';
#echo $query;
$result = query_db($query);
?>
<div>
	<div class=div_cart style="width:5%;">No.</div>
	<div class=div_cart style="width:10%;">SKU</div>
	<div class=div_cart style="width:40%;">Product Name</div>
	<div class=div_cart style="width:5%;">Qty</div>
	<div class=div_cart style="width:15%;">Price/Total</div>
	<div class=div_cart style="width:15%;">Shipping Co</div>
	<div class=div_cart style="width:10%;">Tracking #</div>
 	<br />
<?php
// Display item info resulted by query 
$j= 0 ;
$total_price = 0;
while(($row1 = mysqli_fetch_array($result)))
{
	$prod_price = number_format(($unit_price[$j])*($qty[$j]), 2, '.', '');
	echo '
	<div class=div_cart style="width:5%;">'.($j+1).'</div>
	<div class=div_cart style="width:10%;">'.$row1["sku"].'</div>
	<div class=div_cart style="width:40%;">'.$row1["product"].'</div>
	<div class=div_cart style="width:5%;">'.$qty[$j].'</div>
	<div class=div_cart style="width:15%;">$'.$unit_price[$j].'ea/$'.$prod_price.'</div>
	<div class=div_cart style="width:15%;">'.$ship_company[$j].'</div>
	<div class=div_cart style="width:10%;">'.$track_number[$j].'</div>
 	<br />'."\n";
   $j++ ;
} // End of while
?>
</div>

