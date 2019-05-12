<?php

function lsprod( $wherevalue) {
$searchSuccess="NO";
global $DB;
echo '
<form method="post" action="?main=product&lsmain=product&searchfield=id">
<div class=tbl_form>
<select class=select name="value" size="30" style="width:100%;">
';
$query = 'select id, prod_ls, sku, prod_name, cat_name, subcat_name from product, cat, subcat where cat.cat_id = product.cat_id and subcat.subcat_id = product.subcat_id and subcat.subcat_id = "'.$wherevalue.'"';
//echo "QUERY: " . $query . "<br>\n";
if($query == "") {
	//continue;    // Skipping NULL querires
}
$result = query_db($query);
if(($num_rows = mysqli_num_rows($result))!=0) {
	$searchSuccess="YES";
	while($row = mysqli_fetch_array($result)) {
  //<a href="'.$_SERVER["PHP_SELF"].'?main=product&lsmain=product&searchfield=id&value='.$row["id"].'"><b>'.$row["id"].'</B></a><br></td>
echo '
<option value="'.$row["id"].'">'.$row["prod_ls"].' - '.$row["sku"].' - '.$row["prod_name"].' - '.$row["cat_name"].' - '.$row["subcat_name"];

	} // end of while loop
} 	// end of if

if($searchSuccess=="NO")
   echo "<P><center><B> No item has been found .</B></center><P>";

echo '</select><br>
<h4 class=title_button><input class=submit name="action" type="submit" value="Search"></h4>
</div>
</form>
';
}
?>
