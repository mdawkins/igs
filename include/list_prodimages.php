<table class=bg2 width=100%>
	<tr>
		<td align=center><font class=font2><b>Product Images</b></font></td>
	</tr>
</table>
<table width=100%>
	<tr>
<?php
$query='select id, prod_name, sku, prod_ls, prod_image_name, prod_image_tn_name from product;';
echo $query;
$result = query_db($query);
$num_fields=mysqli_num_fields($result);
for($i=0;$i<$num_fields;$i++) {
#echo $num_fields;
	echo '<td><font class=font1><b>'.mysqli_fetch_field_direct($result,$i)->name.'</b></font></td>';
}
	echo '</tr>';
while($row=mysqli_fetch_array($result)) {
	if(!is_file("images/".$row["prod_image_name"]) || !is_file("images/".$row["prod_image_tn_name"])) {
	echo '<tr>';
   	echo '<td><a href="index.php?main=product&lsmain=product&searchfield=id&value='.$row["id"].'"><font class=font1><b>edit</b></font></a></td>';
   	echo '<td><font class=font1><b>'.$row["prod_name"].'</b></font></a></td>';
   	echo '<td><font class=font1><b>'.$row["sku"].'</b></font></a></td>';
   	echo '<td><font class=font1><b>'.$row["prod_ls"].'</b></font></a></td>';
if(is_file("/home/www/intriguegiftshop.com/images/".$row["prod_image_name"])) 
	$found_file = "green";
else
	$found_file = "red";
   	echo '<td><a href="images/'.$row["prod_image_name"].'"><font color='.$found_file.'><b>'.$row["prod_image_name"].'</b></font></a></td>';
if(is_file("images/".$row["prod_image_tn_name"]))
        $found_file = "green";
else
        $found_file = "red";

   	echo '<td><a href="images/'.$row["prod_image_tn_name"].'"><font color='.$found_file.'><b>'.$row["prod_image_tn_name"].'</b></font></a></td>';
echo '</tr>';
	}
}
?>
</table>

