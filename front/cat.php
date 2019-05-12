<div class=tbl_col>
	<h4 class=title_front>Browse by Brand</h4>
<?php 
$query = "select * from cat where cat_ls ='yes' order by cat_name";
$result = query_db($query);
if(($num_rows = mysqli_num_rows($result))!=0) {
	while($row = $result->fetch_assoc()) { 
		if ( $rewriteurl == "yes" ) {
			$ahref = $WEBSITE.'/'.str_replace(" ","-",$row["cat_name"]).'/'.$row["cat_id"];
		} else {
			$ahref = $WEBSITE."?cat_id=".str_replace(" ","-",$row["cat_id"]); }
		echo'	<a style="padding:4px;" class=dark_med href="'.$ahref.'">'.$row["cat_name"]."</a><br />\n";
	}
}
?>
	<a style="padding:4px;" href="/showall.html" class=dark_med><u>Show All</u></a><br />
</div>
