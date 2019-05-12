<form name="" method=post action="">
<div class=tbl_front>
	<h4 class=title_form>Top Area</h4>
	<div class=spacer>&nbsp;</div>
<?php

$FILE_LOCATION="images/";

if (!empty($_POST["TopArea"]))
{
	#echo "MODIFY: !" . $HTTP_IF_MODIFIED_SINCE . "!<br>\n";

	for ($i=1;$i<=5;$i++)
	{
		$query = "update toparea set cat_id='".$_POST["catsel".$i]."' where area_id = '".$i."'";
		$result = query_db($query);
	}
}

$query = "select cat_name, area_id, cat.cat_id, cat_image_name from cat, toparea where toparea.cat_id=cat.cat_id order by area_id";
$result = query_db($query);
$i=1;
while($row = mysqli_fetch_array($result))
{
	echo '<div class=tbl_display style="width:19.2%;display:inline;float:left;">
	<ul class=item>
        <li><img width=100 height=100 src="'.$FILE_LOCATION,$row["cat_image_name"].'"></li><br />
        <li class=lite_med>' . $row["cat_name"] . '</li><br />';
	db_selectbox("cat", "cat_name", "cat_id", "catsel" . $i++, $row["cat_id"], "none", "100%");
	echo '<br />
	</ul>
</div>';
}
?>
	<div class=spacer>&nbsp;</div>
	<h4 class=title_button><input name="TopArea" type="submit" value="Update Database" class=submit></h4>
</div>
</form>
