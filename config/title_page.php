<?php
$show_subcat = FALSE;

if(isset($_GET["search"])) {
	$_GET["search"] = str_replace("-"," ",$_GET["search"]);
	$search = '%'.$_GET["search"].'%';
	$query ='select cat_name,subcat_name,prod_name,id,sku,prod_price,prod_image_tn_name from product,subcat,cat where cat.cat_id = subcat.cat_id and subcat.subcat_id = product.subcat_id and (subcat_name like "'.$search.'" or prod_name like "'.$search.'" or prod_desc like "'.$search.'") and prod_ls = "yes" and subcat_ls = "yes" order by prod_name';
	$name = "prod_name";
} elseif(isset($_GET["cat_id"])) {
	$query = "select cat_name, cat_desc, subcat_name from cat, subcat where cat.cat_id = subcat.cat_id AND subcat_ls = 'yes' AND cat.cat_id = '".$_GET["cat_id"]."' order by subcat_name";
	$name = "subcat_name";
	$show_cat = TRUE;
} elseif(isset($_GET["subcat_id"])) {
	$query = "select prod_name, subcat_name, cat_name from product, subcat, cat where product.subcat_id = subcat.subcat_id AND cat.cat_id = subcat.cat_id AND prod_ls = 'yes' AND subcat.subcat_id = '".$_GET["subcat_id"]."' order by prod_name";
	$name = "prod_name";
	$show_cat = TRUE;
	$show_subcat = TRUE;
} elseif(isset($_GET["sku"])) {
	$query = "select prod_name, prod_desc, subcat_name, cat_name from product, subcat, cat where cat.cat_id = subcat.cat_id AND subcat.subcat_id = product.subcat_id AND sku = '".$_GET["sku"]."' order by prod_name";
	$name = "prod_name";
	$show_cat = TRUE;
	$show_subcat = TRUE;
	$show_prod_desc = TRUE;
} else {
	$query = "select cat_name from cat where cat_ls = 'yes' order by cat_name";
	$name = "cat_name";
	$name_desc = "";
}
#echo $query;

$result = query_db($query);
if ( empty($result) ) {
	DisplayErrMsg(sprintf("internal error %d:%s\n", mysqli_errno(), mysqli_error()));
	exit() ;
}

if(($num_rows = mysqli_num_rows($result))!=0) {
	$searchSuccess="YES";
	while($row = $result->fetch_assoc()) {
		if ( isset( $search ) ) {
			$list = $_GET["search"].' :: ';
			unset( $search );
		}
		if ( $show_cat == TRUE ) {
			$list = $row["cat_name"].' :: ';
			$desc = $row["cat_desc"];
			$show_cat = FALSE;
		}
		if ( $show_subcat == TRUE ) {
			$list.= $row["subcat_name"].' :: ';
			$show_subcat = FALSE;
		}
		$list.=$row["$name"].", ";
		if ( $show_prod_desc == TRUE && !empty($row["prod_desc"]) ) {
			$list.= $row["prod_desc"].", ";
			$desc = $row["prod_desc"];
		}
	}
	$list = addslashes(substr($list, 0 ,-2));
}
if ( isset($_GET["main"]) && $_GET["main"] != "showall" ) // policies about  contact etc
	$title = $BUSINESSNAME.' :: '.$_GET["main"];

elseif ($_SERVER["REQUEST_URI"] == "./index.php" || $_SERVER["REQUEST_URI"] == "./" || $_GET["main"] == "showall" ) {
	$title="Figurines Collectible Figurines Collectable Animal Figurines Wildlife Figurines";
} else 
	$title = $list;

if (empty($desc))
	$desc="Figurines Collectible Figurines Collectable Animal Figurines Wildlife Figurines";

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?php echo $title; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="robots" content="Index">
<meta name="revisit-after" content="5 days">
<meta name="URL" content="<?php echo $_SERVER["HTTP_HOST"]; ?>">
<meta name="keywords" content="<?php echo $list; ?>">
<meta name="description" content="<?php echo $desc; ?>">
<meta name="classification" content="">
<meta name="distribution" content="Global">
<meta name="rating" content="General">
<meta name="language" content="en-us">
<meta name="subject" content="">
<link rel="stylesheet" type="text/css" href="/default.css.php">
</head>
