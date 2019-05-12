<?php
if(!isset($_GET["asc"]))
	$asc = 'asc';
else
	$asc = $_GET["asc"];
if($_GET["pp"] == 1)
{
	if(!isset($_GET["orderby"]))
		$orderby = 'prod_id';
	else
		$orderby = $_GET["orderby"];
	$query="select prod_id, concat(prod_name,' - ', subcat_name) as name, cat_name, count(order_qty) as count from order_list, cat, subcat, product where prod_id=id and cat.cat_id = product.cat_id and subcat.subcat_id=product.subcat_id group by prod_id order by ".$orderby." ".$asc;
	$pp=1;
	$titlelabel='List of Products Ordered Report';
}
elseif($_GET["pp"] == 2)
{
	if(!isset($_GET["orderby"]))
                $orderby = 'search_term';
        else
                $orderby = $_GET["orderby"];
        $query="select search_term, count(*) as count from search group by search_term order by ".$orderby." ".$asc;
	$pp=2;
	$titlelabel='List of Products Searched Report';
}
?>
<table class=bg2 width=100%>
        <tr>
                <td align=center><font class=font2><b><?php echo $titlelabel; ?> </b></font></td>
        </tr>
</table>
<table width=100%>
        <tr>
<?php
//echo $query;
$result = query_db($query);
$num_fields = mysqli_num_fields($result);
for($i=0;$i<$num_fields;$i++) {
	$asc = 'asc';
	$namefield = mysqli_fetch_field_direct($result, $i);
	if($namefield->name == $orderby && $_GET["asc"] == 'asc')
		$asc = 'desc';
        echo '<td><a href="'.$PHP_SELF.'?main=spread&orderby='.$namefield->name.'&asc='.$asc.'&pp='.$pp.'"><font class=font1><b>'.$namefield->name.'</b></font></td>';
}
        echo '</tr>';
while($row=mysqli_fetch_array($result)) {
        echo '<tr>';
        for($i=0;$i<$num_fields;$i++) {
		$namefield = mysqli_fetch_field_direct($result, $i);
        	echo '<td><font class=font1><b>'.$row[$namefield->name].'</b></font></td>';
        }
        echo '</tr>';
}
?>
</table>

