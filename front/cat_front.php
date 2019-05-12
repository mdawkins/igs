<?php

$sql = 'select cat_id, cat_name, cat_desc, cat_image_name from cat where cat_ls like "yes" order by cat_name';
$result = query_db($sql);
?>
<div class=tbl_front>
	<h4 class=title_front>Browse by Brand</h4>
	<div class=spacer>&nbsp;</div>
<?php 
$rowcount=0;
while ( $row = $result->fetch_assoc() ) {
	if ( $rewriteurl == "yes" ) {
		$cat_link = $WEBSITE.'/'.str_replace(" ","-",$row["cat_name"]).'/'.$row["cat_id"];
	} else {
		$cat_link = $WEBSITE."?cat_id=".str_replace(" ","-",$row["cat_id"]); }
	if(strlen($row["cat_name"]) > 26 )
		$cat_name = substr($row["cat_name"],0,24).'...';
	else
		$cat_name = $row["cat_name"];
	if(strlen($row["cat_desc"]) > 100 )
		$cat_desc = substr($row["cat_desc"],0,100).'...';
	else
		$cat_desc = $row["cat_desc"];

echo "\t".'<div class=tbl_display style="width:138px;height:155px;float:left;">
		<ul class=item>
		<li><a title="'.stripslashes($cat_desc).'" class=dark_small href="'.$cat_link.'"><img src="/images/'.$row["cat_image_name"].'" alt="'.stripslashes($cat_desc).'" border="0" height="110" width="110"></a></li>
		<li><a title="'.$row["cat_name"].'" class=dark_small href="'.$cat_link.'">'.$cat_name.'</a></li>
		</ul>
	</div>'."\n";
	$rowcount++;
	if($rowcount == 4) {
		$rowcount=0;
		#echo "</tr><tr>\n";
	}
}
?>
	<div class=spacer>&nbsp;</div>
</div>
