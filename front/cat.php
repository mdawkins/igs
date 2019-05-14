<?php
function left_display( $table, $lscol, $idcol, $nmcol, $nmtit ) {
	global $WEBSITE;
	global $rewriteurl;
?>
<div class=tbl_col>
<h4 class=title_front>Browse by <?php echo $nmtit; ?></h4>
<?php 
$query = "SELECT * FROM $table WHERE $lscol = 'yes' ORDER BY $nmcol";
$result = query_db($query);
if ( ($num_rows = mysqli_num_rows($result) )!=0 ) {
	while ( $row = $result->fetch_assoc() ) { 
		$ahref = $WEBSITE;
		if ( $rewriteurl == "yes" ) {
			if ( !empty($idcol) ) {
				$ahref .= '/'.$row[$nmcol].'/'.$row[$idcol];
			} else {
				$ahref .= '/'.$table.'/'.$row[$nmcol];
			}
		} else {
			$ahref .= "/index.php?";
			if ( !empty($idcol) ) {
				$ahref .= "$idcol=".$row[$idcol];
			} else {
				$ahref .= "search=".$row[$nmcol];
			}
		}
		echo"\t<a style=\"padding:4px;\" class=dark_med href=\"".str_replace(" ","-",$ahref).'">'.$row[$nmcol]."</a><br />\n";
	}
}
?>
	<a style="padding:4px;" href="<?php echo $WEBSITE; ?>/showall.html" class=dark_med><u>Show All</u></a><br />
</div>
<?php
}
?>
