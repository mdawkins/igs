<?php
$button_value = 'Search';
if ($_GET["lsmain"]=="cat")
{
	echo '<form method="post" action="?main=cat&lsmain=cat&searchfield=cat_id">'."\n";
	echo "<div class=tbl_col>\n";
	db_selectbox("cat", "cat_name", "cat_id", "value", "", "30", "190px");
}
elseif($_GET["lsmain"] == "subcat")
{
echo '<form method="post" action="?main=subcat&lsmain=subcat&searchfield=subcat_id">'."\n";
echo "<div class=tbl_col>\n";
	db_selectboxgroup("cat", "cat_name", "cat_id", "subcat", "subcat_name", "subcat_id", "value", "30", "190px");
}
elseif($_GET["lsmain"] == "event")
{
echo '<form method="post" action="?main=event&lsmain=event&searchfield=event_id">'."\n";
echo "<div class=tbl_col>\n";
	db_selectbox("event", "event_id", "event_id", "value", "", "30", "190px");
}

elseif($_GET["lsmain"] == "product")
{
echo '<form method="post" action="?main=ls_product&lsmain=product&searchfield=prod_id">'."\n";
echo "<div class=tbl_col>\n";
	db_selectboxgroup("cat", "cat_name", "cat_id", "subcat", "subcat_name", "subcat_id", "value", "30", "190px");
}
elseif($_GET["lsmain"] == "cust")
{
echo '<form method="post" action="?main=cust&lsmain=cust&searchfield=user_id">'."\n";
echo "<div class=tbl_col>\n";
	db_selectbox("cust_info", "user_id", "user_id", "value", "", "30", "190px");
}
elseif($_GET["lsmain"] == "zip_code")
{
echo '<form method="post" action="?main=zip_code&lsmain=zip_code&searchfield=zip_code">'."\n";
echo "<div class=tbl_col>\n";
	db_selectbox("zip_code", "zip_code", "zip_code", "value", "", "30", "190px");
}
elseif($_GET["lsmain"] == "tax")
{
echo '<form method="post" action="?main=tax&lsmain=tax&searchfield=tax_name">'."\n";
echo "<div class=tbl_col>\n";
	db_selectbox("tax_rate", "tax_name", "tax_name", "value", "", "30", "190px");
}
elseif($_GET["lsmain"] == "ship")
{
echo '<form method="post" action="?main=ship&lsmain=ship&searchfield=ship_code">'."\n";
echo "<div class=tbl_col>\n";
	db_selectbox("ship_rate", "ship_code", "ship_code", "value", "", "30", "190px");
}
elseif($_GET["lsmain"] == "prod_list")
{
echo '<form method="post" action="formbase.php">'."\n";
echo "<div class=tbl_col>\n";
	db_selectbox("product", "concat(sku,' - ', prod_name)", "id", "value", "", "30", "190px");
	$button_value = "Add Item";
}
elseif($_GET["lsmain"] == "subject")
{
echo '<form method="post" action="?main=subject&lsmain=subject&searchfield=sub_id">'."\n";
echo "<div class=tbl_col>\n";
	db_selectbox("subject", "sub_name", "sub_id", "value", "", "30", "190px");
}
elseif($_GET["lsmain"] == "artist")
{
echo '<form method="post" action="?main=artist&lsmain=artist&searchfield=artist_id">'."\n";
echo "<div class=tbl_col>\n";
	db_selectbox("artist", "artist_name", "artist_id", "value", "", "30", "190px");
}

?>
	<h4 class=title_button><input name="action" type="submit" value="<?php echo $button_value; ?>" class=submit></h4>
</div>
</form>

