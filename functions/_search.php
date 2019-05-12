<?php
global $add_stat, $columns, $tables;
while($sql_list)
{
	$add_stat = $sql_list[$add_stat];	
	$columns = $sql_list[$columns];	
	$tables = $sql_list[$tables];	
}

require_once '../functions/where_stat.php';
if(!isset($_POST["order"]) || !isset($_POST["asc"]))
{
	$_POST["order"] = "sku";
}
	
$query = 'select '.$columns.' from '.$tables.$where_stat.' order by '.$_POST["order"].' '.$_POST["asc"];
#echo "query: $query";
global $result; // again don't know why
$result = query_db($query);

if($num_rows=mysqli_num_rows($result)>1)
{
	if($MAINBASE == "order")
	$MAINBASE = "display_order";
echo '<form method="post" action="?main='.$MAINBASE.'&lsmain='.$MAINBASE.'&searchfield='.mysqli_fetch_field_direct($result,0).'">
<div class=tbl_form>
<select name="value" size="30" width="600">';
	$num_rows = mysqli_num_rows($result);
	for($g=0;$g<$num_rows;$g++)
	{
		$num_cols = mysqli_num_fields($result);
		while(($row = mysqli_fetch_array($result)))
		{
			echo '<option value="'.$row[mysqli_fetch_field_direct($result,0)].'">';
			for($h=0;$h<$num_cols;$h++)
			{
				echo $row[mysqli_fetch_field_direct($result, $h)];
				if($h<($num_cols-1))
					echo ' - ';
			}
		}
	}
	echo '</select><br>
<h4 class=title_form><input type="submit" value="Search"></center></h4>
</div>
</form>
';
	exit();
}
else
{
	$query_result = mysqli_fetch_array($result);
	#	$validfield = TRUE;
	$search_href ='&searchfield='.$formfields[1]["field_name"].'&value='.$query_result[$formfields[1]["field_name"]];
}
?>
