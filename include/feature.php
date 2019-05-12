<?php
$sql ='select * from featart limit 1';
query_db($sql);
$row= mysqli_fetch_array($result);

if( !empty($row["feat_headlink_a"]))
	$headlink_a = 'href="'.$WEBSITE.'/'.$row["feat_headlink_a"].'"';
if( !empty($row["feat_headlink_b"]))
	$headlink_b = 'href="'.$WEBSITE.'/'.$row["feat_headlink_b"].'"';
if( !empty($row["feat_headlink_c"]))
	$headlink_c = 'href="'.$WEBSITE.'/'.$row["feat_headlink_c"].'"';

if( !empty($row["feat_link_a"]))
	$imagelink_a = 'href="'.$WEBSITE.'/'.$row["feat_link_a"].'"';
if( !empty($row["feat_link_b"]))
	$imagelink_b = 'href="'.$WEBSITE.'/'.$row["feat_link_b"].'"';
if( !empty($row["feat_link_c"]))
	$imagelink_c = 'href="'.$WEBSITE.'/'.$row["feat_link_c"].'"';

echo '
<div id=feature_area>
<!-- First Row -->
	<div class=row>
		<div id=image>
			<a class=image '.$imagelink_a.'><img src="images/'.$row["feat_image_a"].'" alt=""></a> 
		</div>

		<div id=text>
			<ul class=area>
				<li><a class=head '.$headlink_a.'>'.$row["feat_head_a"].'</a></li>
				<li>'.$row["feat_desc_a1"].'</li>
			</ul>
		</div>
	</div>
<!-- Second Row -->
	<div class=row>
		<div id=text>
			<ul class=area>
				<li><a class=head '.$headlink_b.'>'.$row["feat_head_b"].'</a></li>
				<li>'.$row["feat_desc_b1"].'</li>
			</ul>
		</div>

		<div id=image>
			<a class=image '.$imagelink_b.'><img src="images/'.$row["feat_image_b"].'" alt=""></a> 
		</div>
	</div>
<!-- Third Row -->
	<div class=row>
		<div id=image>
			<a class=image '.$imagelink_c.'><img src="images/'.$row["feat_image_c"].'" alt=""></a> 
		</div>

		<div id=text>
			<ul class=area>
				<li><a class=head '.$headlink_c.'>'.$row["feat_head_c"].'</a></li>
				<li>'.$row["feat_desc_c1"].'</li>
			</ul>
		</div>
	</div>
</div>
';
?>
