<?php
$sql ='select * from event order by event_date desc';
$result = query_db($sql);

echo '<table width=100% class=bg2 border=0 cellspacing=3 cellpadding=1>
	<tr>
		<td cellspacing=1 cellpadding=1 border=1>';
while($row = mysqli_fetch_array($result))
{
	echo '<table width=100% class=bg1 border=0 cellspacing=3 cellpadding=1>
	<tr>
		<td class=dark_med width=10% align=left><img src="images/'.$row["event_image"].'" height=55 weight=55 border=1></td>
		<td class=dark_small width=15% align=center>'.$row["event_date"].'<br>'.$row["event_time"].'</td>
		<td class=dark_small width=75% align=left><u>'.$row["event_title"].'</u><br>'.$row["event_desc"].'</td>
	</tr>
</table>';
}
echo '</td>
	</tr>
</table>';

?>
