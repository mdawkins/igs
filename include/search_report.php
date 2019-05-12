<?php
global $result;	

if($_POST["location"] == "online")
	$online = "selected";
elseif($_POST["location"] == "store")
	$store = "selected";

?>
<div class=tbl_form>
	<h4 class=dark_med>
	<form method=post action="?main=list_report">
<?php
echo "\tYear: "; 

$year_sql = 'select year(order_date) as year from order_info group by year(order_date) desc';
$result = query_db($year_sql);
echo "\t<select name=year size=1 style=\"width:100px;\" class=select>\n";
echo "\t\t<option value=none>Select Year</option>\n";
while($row=mysqli_fetch_array($result))
{
	$selected = '';
	if ($_POST["year"] == str_replace("-","",$row["year"]) )
		$selected = 'selected ';
	echo "\t\t".'<option '.$selected.'value="'.str_replace("-","",$row["year"]).'">'.$row["year"].'</option>'."\n";
}
echo "\t</select>\n";
echo "\t<input type=submit value=Go>\n";
echo "\t</form>\n";

echo "\t<form method=post action=\"?main=list_report&list=date\">\n";
echo "\tDate: "; 

$date_sql = 'select order_date from order_info group by order_date desc';
$result = query_db($date_sql);
echo "\t<select name=date size=1 style=\"width:100px;\" class=select>\n";
echo "\t\t<option value=none>Select Date</option>\n";
while($row=mysqli_fetch_array($result))
{
	$selected = '';
	if ($_POST["date"] == str_replace("-","",$row["order_date"]) )
		$selected = 'selected ';
	echo "\t\t".'<option '.$selected.'value="'.str_replace("-","",$row["order_date"]).'">'.$row["order_date"].'</option>'."\n";
}
echo "\t</select>\n";
?>
	Location: 
	<select name=location>
		<option <?php echo $online; ?> value=online>Online 
		<option <?php echo $store; ?> value=store>Store 
	</select>
	<input type=submit value=Go>
	</h4>
</div></form>
