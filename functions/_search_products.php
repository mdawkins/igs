	<div class=tbl_display style="width:138px;height:170px;display:inline;float:left;">
	<ul class=item>
<?php
if ( $rewriteurl == "yes" ) {
	$hrefstr = str_replace(" ","-",'/'.$dis_item[$i]["cat_name"].'/'.$dis_item[$i]["subcat_name"].'/'.$dis_item[$i]["prod_name"].'/'.$dis_item[$i]["sku"]);
} else {
	$hrefstr = $WEBSITE."?sku=".$dis_item[$i]["sku"]; }
$image = $FILE_LOCATION.$dis_item[$i]["prod_image_tn_name"];

echo "\t".'<li><a class=dark_small href="'.$hrefstr.'" title="'.$dis_item[$i]["prod_name"].'"><img src="';
if(file_exists($SERVER_DIRECTORY.$image))
	echo $image;
else	
	echo $FILE_LOCATION.'imageunavailable_tn.png';

echo '" height="'.$image_height.'" width="'.$image_width.'" name="'.$dis_item[$i]["prod_name"].'" alt="'.$dis_item[$i]["prod_name"].'" border="0"></a></li>'."\n";
			
echo "\t<li>Price $".$dis_item[$i]["prod_price"].'</li>'."\n";
echo "\t".'<li><a class=dark_small href="'.$hrefstr.'" title="Click for details about '.$dis_item[$i]["prod_name"].'"><font class="font1">';
if(strlen($dis_item[$i]["prod_name"]) > 18)
	echo substr($dis_item[$i]["prod_name"],0,15).'...';
else
	echo $dis_item[$i]["prod_name"];

echo '</a></li>'."\n";
if ( $rewriteurl == "yes" ) {
	        $ahref = "change_qty.html";
} else {
	        $ahref = "change_qty.php"; }
echo "\t".'<li><a class=button href="/'.$ahref.'?pass_id=',$dis_item[$i]["id"],'">Add to Cart</a></li>'."\n";
?>
	</ul>
	</div>

