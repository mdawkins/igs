<?php

if($_GET["list"] == "year" || (isset($_POST["year"]) && $_POST["year"] != "none") )
{
	$title = 'Monthly Reports';
	$pass_page = 'list_report&list=month';
	$value = 'mnt_name';

	if($_GET["asc"] == 'asc' || $_GET["asc"] == 'desc')
		$asc = $_GET["asc"];
	elseif(empty($_GET["asc"]))
		$asc = "desc";
	if(isset($_GET["order"]) && $_GET["order"] != "Month")
		$orderby = $_GET["order"].' '.$asc.',';
	if($_GET["list"] == "year" )
	{
		#$limit = ' limit 13';
		$where = " where date_format((curdate() - interval 12 month), '%Y-%m') < concat(year(order_date),'-',month(order_date))";
	}
	elseif($_POST["year"])
	{
		$where = ' where year(order_date) like "'.$_POST["year"].'"';
	}

	$main_sql='select concat(monthname(order_date),\' \',year(order_date)) as Month, sum(order_cost) as Subtotal, sum(ship_cost) as Shipping, sum(order_tax) as Tax, avg(order_cost) as Average, count(order_cost) as Orders from order_info'.$where.' group by month order by '.$orderby.' year(order_date) '.$asc.', month(order_date) '.$asc.$limit;

	// default 
	$totals_sql = "select sum(order_cost) as subtot, sum(ship_cost) as shipping, sum(order_tax) as tax, avg(order_cost) as avg_order, count(order_cost) as num_orders from order_info".$where;
}

elseif($_GET["list"] == "month")
{

	$title = 'Monthly Report '.$_GET["value"];
	$pass_page = 'order_info&searchfield=order_id';
	$value = 'order_id';

	if($_GET["asc"] == 'asc' || $_GET["asc"] == 'desc')
	        $asc = $_GET["asc"];
	elseif(empty($_GET["asc"]))
		$asc = "desc";

	if(isset($_GET["order"]) && $_GET["order"] != "Order ID")
	        $orderby = $_GET["order"].' '.$asc;
	elseif(empty($_GET["order"]) || $_GET["order"] == "Order ID")
	        $orderby = 'order_id '.$asc;
	
	$main_sql='select order_id as "Order ID", order_cost as Subtotal, ship_cost as Shipping, order_tax as Tax from order_info where concat(monthname(order_date),\' \',year(order_date)) like "'.$_GET["value"].'" order by '.$orderby;

	$totals_sql= 'select sum(order_cost) as subtot, sum(ship_cost) as shipping, sum(order_tax) as tax from order_info where concat(monthname(order_date)," ",year(order_date)) like "'.$_GET["value"].'" group by concat(monthname(order_date)," ",year(order_date))';
}

elseif($_GET["list"] == "date" && $_POST["date"] != "none")
{
	$title = 'Daily Report '.$_GET["value"];
	$pass_page = 'order_info&searchfield=order_id';
	$value = 'order_id';

	if ($_POST["location"] == "online")
	{
		$main_sql='select order_id as "Order ID", order_cost as Subtotal, ship_cost as Shipping, order_tax as Tax from order_info where trans_location = "'.$_POST["location"].'" and order_date = '.$_POST["date"].' order by order_id';
		$totals_sql='select sum(order_cost) as subtot, sum(ship_cost) as shipping, sum(order_tax) as tax from order_info where trans_location = "'.$_POST["location"].'" group by order_date having order_date = '.$_POST["date"];
	}
	elseif ($_POST["location"] == "store")
	{
		$main_sql='select order_id as "Order ID", order_cost as Subtotal, order_discount as Discount, order_tax as Tax from order_info where trans_location = "'.$_POST["location"].'" and order_date = '.$_POST["date"].' order by order_id;'; 
		$totals_sql='select sum(order_cost) as subtot, sum(order_discount) as discount, sum(order_tax) as tax from order_info where trans_location = "'.$_POST["location"].'" group by order_date having order_date = '.$_POST["date"];
	}
}

elseif($_GET["list"] == "user_id")
{
	$title = 'Orders: '.$_GET["value"];
	$pass_page = 'order_info&searchfield=order_id';
	$value = 'order_id';

	if($_GET["asc"] == 'asc' || $_GET["asc"] == 'desc')
	        $asc = $_GET["asc"];
	elseif(empty($_GET["asc"]))
		$asc = "desc";

	if(isset($_GET["order"]) && $_GET["order"] != "Order ID")
	        $orderby = $_GET["order"].' '.$asc;
	elseif(empty($_GET["order"]) || $_GET["order"] == "Order ID")
	        $orderby = 'order_id '.$asc;
	
	$main_sql='select order_id as "Order ID", order_cost as Subtotal, ship_cost as Shipping, order_tax as Tax from order_info where user_id like "'.$_GET["value"].'" order by '.$orderby;

	$totals_sql= 'select sum(order_cost) as subtot, sum(ship_cost) as shipping, sum(order_tax) as tax from order_info where user_id like "'.$_GET["value"].'" group by user_id';
}
#echo 'main: '.$main_sql."\n";
#echo 'total: '.$totals_sql."\n";
#phpinfo(32);
require_once '../functions/reports.php';
reports($title, $main_sql, $totals_sql, $pass_page );
?>
