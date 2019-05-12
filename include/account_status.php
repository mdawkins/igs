<?php 

// Check whether the user is already authenticated or not
if (!authenticateUser( $_COOKIE["cookie_user"], $_COOKIE["cookie_passwd"])){
   require_once 'include/registry.php';
   exit();
}

?>
<div class=tbl_front>
	<h4 class=title_front>Users Account: <font class=font_green><?php echo $_COOKIE["cookie_user"]; ?></font></h4>
	<div class=dark_med style="width:10%;display:inline;float:left;">Order No.</div>
	<div class=dark_med style="width:63%;display:inline;float:left;">Title</div>
	<div class=dark_med style="width:10%;display:inline;float:left;">Quantity</div>
	<div class=dark_med style="width:15%;display:inline;float:left;">Date</div>
<!--    <div width=10% align=center class=dark_med>Status</div> -->
	<br />

<?php

// Read all the transaction records of the user
$columns = 'user_id, order_info.order_id, concat(prod_name,\' - \', subcat_name,\' - \', cat_name) as product, order_date, order_qty, order_conf';
$tables = 'order_info, product, subcat, cat, order_list';
$wheres ='user_id=\''.$_COOKIE["cookie_user"].'\' and order_list.prod_id = product.id ';
$wheres.='and order_info.order_id=order_list.order_id ';
$wheres.='and subcat.subcat_id=product.subcat_id and cat.cat_id=product.cat_id';
$sql1 = 'select '.$columns.' from '.$tables.' where '.$wheres.' order by order_info.order_id';
$result1 = query_db($sql1);

while (($row=mysqli_fetch_array($result1)))  
{ ?>
	<div class=dark_med style="width:10%;display:inline;float:left;"><?php echo $row["order_id"]; ?></div>
	<div class=dark_med style="width:63%;display:inline;float:left;"><?php echo $row["product"]; ?></div>
	<div class=dark_med style="width:10%;display:inline;float:left;"><?php echo $row["order_qty"]; ?></div>
	<div class=dark_med style="width:15%;display:inline;float:left;"><?php echo substr($row["order_date"],5).'-'.substr($row["order_date"],0,4); ?></div>
<!--    <div width=10% align=center>
    <?php if($row["order_conf"] == "pending")
    	{ $color = "red"; }
	elseif($row["order_conf"] == "confirmed")
	{ $color = "green"; } 
	else { $color = "blue"; }?> 
    <FONT color=<?php //echo "$color" ?> ><?php //echo($row["order_conf"]) ?></FONT></div> -->
	<br />

<?php 
 } /* End of while */ 
?>

	<h4 class=title_form><a class=lite_med href="<?php echo $PHP_SELF; ?>?main=user_area"><u>Back to User Area</u></a></h4>
</div>
