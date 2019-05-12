<?php
	$sql = 'select cat_desc from cat where cat_id = '.$_GET["cat_id"];
   	$result = query_db($sql);
   	$row = mysqli_fetch_array($result);
?>
<div class=tbl_display style="width:auto;padding:0 4px 0 4px;margin:0 0 0 2px"><p><?php echo stripslashes($row["cat_desc"]) ?></p></div>
