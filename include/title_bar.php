	<h4 class=title_front><?php
if(isset($_GET["search"]))
      echo $_GET["search"]; // change to the webpages postvar i think search
      #echo 'Search Results ... '.$_GET["search"]; // change to the webpages postvar i think search
elseif(isset($_GET["cat_id"]))
{
	$sql = 'select cat_name, cat_desc from cat where cat_id = '.$_GET["cat_id"];
   	$result = query_db($sql);
   	$row = mysqli_fetch_array($result);
	echo $row["cat_name"];
}
elseif($_GET["main"] == "showall")
		echo 'Show All';

elseif($botarea == "show")
		echo 'Browse Our Featured Products';

if(isset($_GET["subcat_id"]))
{
      $query = 'select subcat_name, product.subcat_id, cat_name, prod_name, product.cat_id ';
      $query.= 'from cat, subcat, product ';
      $query.= 'where subcat.subcat_id = product.subcat_id and cat.cat_id = product.cat_id and product.subcat_id ='.$_GET["subcat_id"].' limit 1';
}
elseif(isset($_GET["sku"]))
{
      $query = 'select subcat_name, cat_name, prod_name, product.cat_id, product.subcat_id ';
      $query.= 'from cat, subcat, product ';
      $query.= 'where subcat.subcat_id = product.subcat_id and cat.cat_id = product.cat_id and sku like "'.$_GET["sku"].'" limit 1';
}
if(isset($_GET["showall"]))
{
      $query = 'select subcat_name, cat_name, prod_name, product.cat_id ';
      $query.= 'from cat, subcat, product ';
      $query.= 'where subcat.subcat_id = product.subcat_id and cat.cat_id = product.cat_id and product.cat_id ='.$_GET["showall"].' limit 1';
}

#if($_GET["pp"] == 6)
#{
#      $query = 'select cat_name, cat.cat_id, subcat_name, subcat_id ';
#      $query.= 'from cat, subcat ';
#      $query.= 'where subcat.cat_id = cat.cat_id and cat_ls = "yes" and subcat_ls = "yes" order by cat_name, subcat_name';
#}

if(!isset($_GET["search"]) && !isset($_GET["cat_id"]) && !isset($botarea) )
{
	global $result;
	#echo 'titlebar2 query: '.$query;
	$result = query_db($query);
	$row = mysqli_fetch_array($result);

	if ( $rewriteurl == "yes" ) {
		$cat_hrefstr = '/'.str_replace(" ","-",$row["cat_name"]).'/'.$row["cat_id"];
  		$subcat_hrefstr = '/'.str_replace(" ","-",$row["cat_name"].'/'.$row["subcat_name"]).'/'.$row["subcat_id"];
  		$showall_hrefstr = '/'.str_replace(" ","-",$row["cat_name"]).'/showall/'.$row["cat_id"];
	} else {
		$cat_hrefstr = $WEBSITE."?cat_id=".$row["cat_id"];
		$subcat_hrefstr = $WEBSITE."?subcat_id=".$row["subcat_id"];
		$showall_hrefstr = $WEBSITE."?showall=".$row["cat_id"];
	}

	if(isset($_GET["subcat_id"]))
   		echo  '<a class=lite_med href="'.$cat_hrefstr.'">'.$row["cat_name"].'</a> >> '.$row["subcat_name"];
	elseif(isset($_GET["sku"]))
		echo '<a class=lite_med href="'.$cat_hrefstr.'">'.$row["cat_name"].'</a> >> <a class=lite_med href="'.$subcat_hrefstr.'">'.$row["subcat_name"].'</a> >> '.$row["prod_name"];
	if(isset($_GET["showall"]))
   		echo  '<a class=lite_med href="'.$cat_hrefstr.'">'.$row["cat_name"].'</a> >> Show All';
}
elseif(isset($_GET["search"]))
	$showall_hrefstr = '/subject/'.$_GET["search"];

if(!isset($_GET["startitem"]))
	$_GET["startitem"] = 1;
if(isset($_GET["subcat_id"]))
	$hrefstr=$subcat_hrefstr;
else
	$hrefstr=$showall_hrefstr;

if ($limit < $num_rows)
{
   echo '<font class=lite_med style="text-align:right;"> &gt;&gt; Page ';
   for($i=1;$i<=ceil($num_rows/$limit);$i++)
   {
      if( (($i-1)*$limit)+1 != $_GET["startitem"])
      {
         echo '<a class=lite_med href="',$hrefstr,'/startitem',((($i-1)*$limit)+1),'">';
         echo '&lt;',$i,'&gt; ';
         echo "</a>";
      }
      else
         echo '<font class=med_med>&lt;',$i,"&gt;</font>";
   }
}
echo "</font></h4>\n";
?>
