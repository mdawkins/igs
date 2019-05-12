<?php
#require_once './functions/functions.php';
function reports($title, $main_sql, $totals_sql, $pass_page)
{
	global $link;
require_once "../include/search_report.php";
?>
<div class=tbl_front>
	<h4 class=title_form><?php echo $title; ?></h4>
	<div class=spacer>&nbsp;</div>
<?php
if(!empty($_GET["value"]))
	$current_value = '&amp;value='.$_GET["value"];

global $result;	
$result = query_db($main_sql);
$num_fields = mysqli_num_fields($result);
$width = 100/$num_fields;

// header
while ($field = mysqli_fetch_field($result))
	$col[] = $field->name;

$href_up = $PHP_SELF.'?main='.$_GET["main"].'&amp;list='.$_GET["list"].$current_value.'&amp;order='.mysqli_fetch_field_direct($result,$i)->name.'&amp;asc=asc';
$href_down = $PHP_SELF.'?main='.$_GET["main"].'&amp;list='.$_GET["list"].$current_value.'&amp;order='.mysqli_fetch_field_direct($result,$i)->name.'&amp;asc=desc';
$start_div = "\t".'<div class=dark_med style="display:inline;float:left;width:'.$width.'%;"><a class=dark_med href="'.$href_up.'">/\</a> [ ';
$end_div = ' ] <a class=dark_med href="'.$href_down.'">\/</a></div>'."\n";

echo $start_div;
echo implode($end_div.$start_div,$col);
echo $end_div;
echo "\t<br />\n";

// data
while($row=mysqli_fetch_array($result))
{
	for($i=0;$i<$num_fields;$i++)
	{
		$href = $PHP_SELF.'?main='.$pass_page.'&amp;value='.$row[mysqli_fetch_field_direct($result,0)->name];
   		echo "\t".'<div class=dark_med style="display:inline;float:left;width:'.$width.'%;"><a class=dark_med href="'.$href.'">'.$row[mysqli_fetch_field_direct($result,$i)->name].'</a></div>'."\n";
	}
	echo "\t<br />\n";
}

#unset($result);
// totals
$result = query_db($totals_sql);
#echo "\t<div class=title_form style=\"height:24px;\">\n";
echo "\t".'<div class=title_form style="display:inline;float:left;width:'.$width.'%;padding:5px 0 5px 0;">Totals</div>'."\n";
while($row=mysqli_fetch_row($result))
{
        $start_div = "\t".'<div class=title_form style="display:inline;float:left;width:'.$width.'%;padding:5px 0 5px 0;">';
	$end_div = '</div>'."\n";
	echo $start_div;
	echo implode($end_div.$start_div,$row);
	echo $end_div;
	
}
echo "\t<br />\n";
echo "\t<div class=spacer>&nbsp;</div>\n";
?>
</div>
<?php
}
#phpinfo(32);
?>
