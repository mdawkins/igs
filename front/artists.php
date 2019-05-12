<div class=tbl_col>
	<h4 class=title_front>Browse by Artist</h4>
<?php 
	$sql='select * from artist where artist_ls like "yes" order by artist_name';
   	$result = query_db($sql);
	while ( $row = $result->fetch_assoc() ) {
		if ( $rewriteurl == "yes" ) {
			$ahref = $WEBSITE.'/artist/'.str_replace(" ","-",$row["artist_name"]);
		} else {
			$ahref = $WEBSITE.'?search='.str_replace(" ","-",$row["artist_name"]); }
		echo"\t".'<a style="padding:4px;" class=dark_med href="'.$ahref.'">'.$row["artist_name"]."</a><br />\n";
	}
?>
</div>
