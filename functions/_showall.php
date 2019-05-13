<?php
if (!isset($count)) {
	echo "\t".'<div style="display:inline;float:left;width:188px;vertical-align:top;text-align:left">'."\n";
	$count=0;
	$totalcount=0;

}
if ($dis_item[$i]["cat_name"] != $dis_item[$i-1]["cat_name"]) {
	if($count != 0) {
		echo "\t<br>\n";
		$count++;
		$totalcount++;
	}
	if ( $rewriteurl == "yes" ) {
		$cat_hrefstr = str_replace(" ","-",'/'.$dis_item[$i]["cat_name"]).'/'.$dis_item[$i]["cat_id"];
	} else {
		$cat_hrefstr = $WEBSITE."?cat_id=".$dis_item[$i]["cat_id"];
	}
	echo "\t".'<a class=dark_med href="'.$cat_hrefstr.'"><u>'.$dis_item[$i]["cat_name"].'</u></a><br>'."\n";
	$count++;
	$totalcount++;
}
if ( $rewriteurl == "yes" ) {
	$subcat_hrefstr = '/'.str_replace(" ","-",$dis_item[$i]["cat_name"].'/'.$dis_item[$i]["subcat_name"]).'/'.$dis_item[$i]["subcat_id"];
} else {
	$subcat_hrefstr = $WEBSITE."?subcat_id=".$dis_item[$i]["subcat_id"];
}
echo "\t".'<a style="padding:8px;" class=dark_med href="'.$subcat_hrefstr.'" title="'.$dis_item[$i]["subcat_name"].'">';
if(strlen($dis_item[$i]["subcat_name"]) > 20)
	echo substr($dis_item[$i]["subcat_name"],0,18).'...';
else
	echo $dis_item[$i]["subcat_name"];
$count++;
$totalcount++;
echo '</a><br>'."\n";
if ($count >= $ROWS+24 || $i == $end-1) { // restart column or check to see that the array is done
	echo "\t</div>\n";
	unset($count);
}
?>
