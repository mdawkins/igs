<form name="" method=post action="">
<div class=tbl_front>
	<h4 class=title_form>Bottom Area</h4>
	<div class=spacer>&nbsp;</div>
<?php

$FILE_LOCATION="images/";

if (!empty($_POST["BotArea"])) {
	for ($i=1;$i<=4;$i++) {
		$query = "update botarea set prod_id='". $_POST["prodsel" . $i] . "' where area_id = '" . $i ."'";
		$result = query_db($query);
	}
}

$query = "select prod_name, id, product.id, prod_image_name from product, botarea where botarea.prod_id=product.id order by area_id";
$result = query_db($query);
$i=1;
while($row = mysqli_fetch_array($result)) {
echo '	<div class=tbl_display style="width:24%;display:inline;float:left;">
		<ul class=item>
	        <li><img width=100 height=100 src="',$FILE_LOCATION, $row["prod_image_name"] . '"></li><br />
		<li class=lite_med>' . $row["prod_name"] . '</li><br />';

db_selectboxgroup2("prodsel".$i++, $row["id"], "1", "100%");

	echo "<br />
		</ul>
	</div>";
}

?> 
	<div class=spacer>&nbsp;</div>
	<h4 class=title_button><input name="BotArea" type="submit" value="Update Database" class=submit></h4>
</div>
</form>
