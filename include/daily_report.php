<?php

$title = 'Daily Report '.$_GET["pass_name"];

if ($_POST["location"] == "online")
{
	$main_sql='select order_id as "Order ID", order_cost as Subtotal, ship_cost as Shipping, order_tax as Tax, pay_type as Payment from order_info where trans_location = "'.$_POST["location"].'" and order_date = '.$_POST["date"].' order by order_id';
	$totals_sql='select sum(order_cost) as subtot, sum(ship_cost) as shipping, sum(order_tax) as tax from order_info where trans_location = "'.$_POST["location"].'" group by order_date having order_date = '.$_POST["date"];
}
elseif ($_POST["location"] == "store")
{
	$main_sql='select order_id as "Order ID", order_cost as Subtotal, order_discount as Discount, order_tax as Tax, pay_type as Payment from order_info where trans_location = "'.$_POST["location"].'" and order_date = '.$_POST["date"].' order by order_id;'; 
	$totals_sql='select sum(order_cost) as subtot, sum(order_discount) as discount, sum(order_tax) as tax from order_info where trans_location = "'.$_POST["location"].'" group by order_date having order_date = '.$_POST["date"];
}

if(isset($_POST["location"]))
{
	$pass_page = 'order_info&searchfield=order_id';
	$pass_name = 'order_id';

	require_once '../functions/reports.php';
	reports($title, $main_sql, $totals_sql, $pass_page, $pass_name);
}

/*
#echo $query; 
$result = query_db($query);
while ($field = mysqli_fetch_field($result))
	$col[]=$field->name;

echo "\t<td class=dark_med>".implode("</td><td class=dark_med>",$col)."</td>\n";
echo '</tr>';

$num_fields=mysqli_num_fields($result);
while($row=mysqli_fetch_array($result))
{
	echo '<tr>';
	for($i=0;$i<$num_fields;$i++)
	{
		$href = $PHP_SELF.'?main=order_info&searchfield=order_id&value='.$row[mysqli_field_name($result,0)];
   		echo '<td class=dark_med><a href="'.$href.'">'.$row[mysqli_field_name($result,$i)].'</a></td>';
	}
	echo '</tr>';
}
	$result = query_db($query);
	echo '</table><table class=tb3 width=100%><tr><td class=title>Totals</td>';
	while ($row = mysqli_fetch_row($result))
		echo "\t<td class=title>".implode('</td><td class=title>',$row)."</td>\n";
	
	echo '<td class=title>Totals</td>';
	echo '</tr>';

echo '</table>';
}
else
{
echo '<table align=center>
	<tr>
		<td><font class=font1><b>Choose a date and location</b></font></td>
	</tr>
</table>';
}
#phpinfo(32);
*/
?>
