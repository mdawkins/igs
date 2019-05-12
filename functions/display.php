<?php

// Theory of Operation

// Read in displayed fields and IDs from all records and store them in an array.
// This way we only have to hit the db once.  We get the necessary data and record count in one swoop.
// Getting all the records is necessary to be able to reliably count items without having to depend
// on a db field that most likely won't be reliable in the future. (Once we delete a record, there
// will be a whole in the numbering sequence.)

// After we've stored everything in the array, we need to see which items we need to display.
// variables are used.  We need to know:   how many columns, how many rows and which item to start with.
// We also need to know what the href for each item is.

// Added 01/25/03 mdawkins I broke the one function into two. It only seemed to make more sense because
// each part did something different. 1st retrieves all the info from the DB and the 2nd displays it.
// In doing so, the variable list was shorten drastically and global variables were used to pass on the
// variables to display_item function from retrieve item function.

// 07/28/03 mdawkins after playing around with the functions and format and options I decided to give it
// its own file for editting reasons. Eventually I'd like to re-write these two functions ??? nested code ???

// 09/09/03 mdawkins after much thought about cleaning up the code I determined that it was better to recombine
// the 2 functions into 1 and take out the extra function variables ... maybe separate nested php files would be
// better eg the title_bar.php file.

if(isset($_POST["search"])) {
	$search = '%'.$_POST["search"].'%';
	$_GET["search"] = $_POST["search"];
} elseif(isset($_GET["search"])) {
	#$search = '%'.str_replace("-"," ",$_GET["search"]).'%';
	$_GET["search"] = str_replace("-"," ",$_GET["search"]);
	$search = '%'.$_GET["search"].'%';
}

if (empty($_GET["startitem"]) || ($_GET["startitem"]<0))
	$startitem=1;
elseif (isset($_GET["startitem"]))
	$startitem = $_GET["startitem"];

//function display_item($displayfields, $dbtable, $wherefield, $wherevalue, $COLS, $ROWS, $startitem)
//{
	if(isset($_GET["cat_id"])) {
		$COLS ='3';
		$ROWS ='15';
		$query = "select cat.cat_id, cat_name, subcat_id, subcat_name from cat, subcat where cat.cat_id = subcat.cat_id and cat.cat_id = ".$_GET["cat_id"]." and subcat_ls like 'yes' order by subcat_name";
	} elseif(isset($_GET["subcat_id"])) {
		$image_height="110px";
		$image_width="110px";
		$COLS ='4';
		$ROWS ='7';
		$query = "select cat.cat_id, cat_name, subcat.subcat_id, subcat_name, id, sku, prod_name, prod_desc, prod_price, prod_image_tn_name from cat, subcat, product where cat.cat_id = subcat.cat_id and subcat.subcat_id = product.subcat_id and subcat.subcat_id = ".$_GET["subcat_id"]." and subcat_ls like 'yes' and prod_ls like 'yes' order by prod_name";
	} elseif(isset($_GET["sku"])) {
		$image_height="250px";
		$image_width="250px";
		$COLS ='1';
		$ROWS ='1';
		$query = "select cat.cat_id, cat_name, subcat.subcat_id, subcat_name, sku, id, prod_name, prod_desc, prod_image_name, prod_price, prod_status, ship_rate.ship_cost from cat, subcat, product, ship_rate where cat.cat_id = subcat.cat_id and subcat.subcat_id = product.subcat_id and sku like '".$_GET["sku"]."' and subcat_ls like 'yes' and prod_ls like 'yes' and product.ship_code = ship_rate.ship_code order by prod_name";
	} elseif(isset($_GET["search"])) {
		$image_height="110px";
		$image_width="110px";
		$COLS ='4';
		$ROWS ='7';
		$query ='select cat_name,subcat_name,prod_name,id,sku,prod_price,prod_image_tn_name from product,subcat,cat where cat.cat_id = subcat.cat_id and subcat.subcat_id = product.subcat_id and (subcat_name like "'.$search.'" or prod_name like "'.$search.'" or prod_desc like "'.$search.'") and prod_ls = "yes" and subcat_ls = "yes" order by prod_name';
	} elseif(isset($_GET["showall"])) { // this is showall of one category
		$image_height="110px";
		$image_width="110px";
		$COLS ='4';
		$ROWS ='7';
		$query ='select product.cat_id, product.subcat_id, subcat_name, cat_name, prod_name, id, sku, prod_price, prod_ls, sku, prod_image_tn_name from cat, subcat, product where subcat.subcat_id = product.subcat_id and cat.cat_id = product.cat_id and cat.cat_id = '.$_GET["showall"].' and prod_ls = "yes" order by prod_name';
	} elseif($_GET["main"] == "showall") { // this is showall categories and subcategories
		$COLS ='3';
		$ROWS ='85';
		$query='select cat_name, cat.cat_id, subcat_name, subcat_id from cat, subcat where subcat.cat_id = cat.cat_id and cat_ls = "yes" and subcat_ls = "yes" order by cat_name, subcat_name';
	} elseif($botarea == "show") {
		$image_height="110px";
		$image_width="110px";
		$COLS ='4';
		$ROWS ='1';
		$query = "select prod_name, prod_price, sku, prod_id, product.id, prod_image_tn_name, subcat_name, cat_name from product, botarea, subcat, cat where botarea.prod_id=product.id and cat.cat_id = subcat.cat_id and subcat.subcat_id = product.subcat_id order by area_id";
	}

	$SERVER_DIRECTORY=".";
	$FILE_LOCATION="/images/";
	$limit = $COLS * $ROWS;
	//echo 'display: '.$query;
	$result = query_db($query);
	$searchSuccess="NO";
	if(($num_rows = mysqli_num_rows($result)) !=0 ) {  
		$searchSuccess="YES";
	}
	$rowcount = 0;
	while($row = $result->fetch_assoc()) {
		$dis_item[$rowcount] = $row;
		$rowcount++;
	}
	if(isset($_GET["cat_id"]) && $num_rows > 1) { // this auments the number for the showall link
		$num_rows++;
		$dis_item[$rowcount]["subcat_id"] = "showall";
		$dis_item[$rowcount]["subcat_name"] = "Show All";
	}
	if(!isset($startitem))
		$startitem=0;
	$start=$startitem-1;
	if($num_rows < $limit || $num_rows-$startitem<$limit)
		$end=$num_rows;
	else 
		$end=$limit+$startitem-1;

	echo "<div class=tbl_front>\n";
	require_once '../include/title_bar.php';
	echo "\t<div class=spacer>&nbsp;</div>\n";

	// Now, we actually display the item(s)
	for($i=$start;$i<$end;$i++) {
		// start of display
		if (isset($_GET["subcat_id"]) || isset($_GET["showall"]) || isset($_GET["search"]) || $botarea == "show") {	
			include '../functions/_search_products.php'; // also includes Showall from a cat
		} elseif (isset($_GET["sku"])) {	
			include '../functions/_product.php';
		} elseif($_GET["main"] == "showall") {
			include '../functions/_showall.php';
		} elseif(isset($_GET["cat_id"])) { // to show subcats under a cat formally known as pp2
			include '../functions/_subcat.php';
		}
	}

        if($searchSuccess=="NO")
                echo '<p class=dark_med align="center"><b>No items were found.</b><p><hr>';

	echo "\t<div class=spacer>&nbsp;</div>\n";
	if(!isset($botarea))
		include '../include/title_bar.php';
	echo "</div>\n";
	if ( isset($_GET["cat_id"])) include_once '../include/cat_desc.php';
//}
?>
