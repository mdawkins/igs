<div class=tbl_col>
	<h4 class=title_front>Browse by Subject</h4>
<?php 
	$sql='select * from subject where sub_ls like "yes" order by sub_name';
	$result = query_db($sql);
	while ( $row = $result->fetch_assoc() ) {
		if ( $rewriteurl == "yes" ) {
			$ahref = $WEBSITE.'/subject/'.str_replace(" ","-",$row["sub_name"]);
		} else {
			$ahref = $WEBSITE.'?search='.str_replace(" ","-",$row["sub_name"]); }
		echo"\t".'<a style="padding:4px;" class=dark_med href="'.$ahref.'">'.$row["sub_name"]."</a><br />\n";
	}
?>
</div>
