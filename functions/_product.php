	<div class=tbl_display style="height:275px;">
	<ul class=item style="text-align:left;">
<?php
$image = $FILE_LOCATION.$dis_item[$i]["prod_image_name"];
echo "\t".'<li><img class=floatleft src="';
if(file_exists($SERVER_DIRECTORY.$image))
	echo $image;
else	
	echo $FILE_LOCATION.'imageunavailable.png';
				
echo '" height="'.$image_height.'" width="'.$image_width.'" name="'.$dis_item[$i]["prod_name"].'" alt="'.$dis_item[$i]["prod_name"].'" border="0"></li>'."\n";
echo "\t<li>Price: $".$dis_item[$i]["prod_price"]."</li>\n";
#echo "\t<li>S&amp;H: $".$dis_item[$i]["ship_cost"]."</li>\n";
echo "\t<li>Item #: ".$dis_item[$i]["sku"]."</li>\n";
require '../siteinfo/prod_status.php';
echo "\t<li>".$dis_item[$i]["prod_name"]."</li>\n";
echo "\t<li>".$dis_item[$i]["prod_desc"]."</li>\n";
echo "\t<li>".$$dis_item[$i]["prod_status"]."</li>\n";
if ( $rewriteurl == "yes" ) {
	$ahref = "change_qty.html";
} else {
	$ahref = "change_qty.php"; }
echo "\t".'<li style="text-align:center;"><a class=button href="/'.$ahref.'?pass_id='.$dis_item[$i]["id"].'">Add to Cart</a></li>'."\n";
?>
	</ul>
	</div>
