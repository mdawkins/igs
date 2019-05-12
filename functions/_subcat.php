	<div class=tbl_display style="width:186px;height:20px;display:inline;float:left;"><?php
// to show subcats under a cat formally known as pp2
if($dis_item[$i]["subcat_id"] == "showall")
{
	if ( $rewriteurl == "yes" ) {
		$hrefstr = $dis_item[$i]["subcat_id"].'/'.$_GET["cat_id"];
	} else {
		$hrefstr = $WEBSITE."?showall=".$_GET["cat_id"]; }
	echo '<a class=dark_med href="'.$hrefstr.'"><u>'.$dis_item[$i]["subcat_name"].'</u></a>';
}
else
{
	if ( $rewriteurl == "yes" ) {
		$hrefstr = str_replace(" ","-",'/'.$dis_item[$i]["cat_name"].'/'.$dis_item[$i]["subcat_name"].'/'.$dis_item[$i]["subcat_id"]);
	} else {
		$hrefstr = $WEBSITE."?subcat_id=".$dis_item[$i]["subcat_id"]; }
	echo '<a class=dark_med href="'.$hrefstr.'">'.$dis_item[$i]["subcat_name"].'</a>';
}
?></div>
