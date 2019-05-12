<?php
// things passed:
// dbhost, DB, dbtable, dbfield, dbuser, dbpass, wherefield, wherevalue
function lsitems($dbtable, $dbnamefield, $dbvaluefield, $wherefield, $wherevalue) {
global $DB;
echo '
<table cellspacing="0" cellpadding="0" width="168">
<font class=font2>
';

$query = "select " . $dbnamefield . ", " . $dbvaluefield . " from " . $dbtable . " where " . $wherefield . " like '" . $wherevalue . "' order by " . $dbnamefield;
// echo "QUERY: " . $query . "<br>\n";
if($query == "") {
//	continue;    // Skipping NULL queries
}
$result = query_db($query);
if(($num_rows = mysqli_num_rows($result))!=0) {
	$searchSuccess="YES";
	while($row = mysqli_fetch_array($result)) {
echo '
 <tr class=bg2>
  <td width ="30">&nbsp;</td> 
  <td align="left">
	  <a href="'.$_SERVER["PHP_SELF"].'?main='.$dbtable.'&lsmain='.$dbtable.'&searchfield='.$dbvaluefield.'&value='.$row[$dbvaluefield].'">
	  <b>'.$row[$dbnamefield].'</B></a><br>
  </td>
  <td width ="10">&nbsp;</td>
 </tr>
';

	} // end of while loop
} 	// end of if

if($searchSuccess=="NO")
	echo "<P><B> No item has been found .</B><P><HR>";
echo '
</font>
</table>
';
} 
?>
