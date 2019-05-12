<?php

$orderby = FALSE;
$dates = FALSE;
if(isset($_GET["lsmain"]))
	$LISTMAIN = '&lsmain='.$_GET["lsmain"];

echo '<form id="custForm" name="'.$BASE.'" method=post action="formbase.php?main='.$MAINBASE.$LISTMAIN.'">'."\n";
echo "<div class=tbl_title_front>\n";

for ($i=0;$i<$FIELDCNT; $i++) {
	if ($formfields[$i]["type"] == "orderby" && (isset($_GET["searchfield"]) && (isset($_GET["value"]) || isset($_POST["value"])) )) {
		$orderby = TRUE;
	}
	if ($formfields[$i]["type"] == "dates" && (isset($_GET["searchfield"]) && (isset($_GET["value"]) || isset($_POST["value"])) )) {
		$dates = TRUE;
	}
	if ($formfields[$i]["type"] != "hidden" && $formfields[$i]["type"] != "title" && $formfields[$i]["type"] != "textarea" && $formfields[$i]["type"] != "button" && $formfields[$i]["type"] != "cust_info" && $dates != TRUE && $orderby != TRUE && $formfields[$i]["type"] != "display_order") {
		echo "\t<label for=".$formfields[$i]["field_name"].">";
		if ($formfields[$i]["required"] == "yes" && $submitattempt=="yes" && empty($_POST[$formfields[$i]["field_name"]]))
			echo '<font class=font_red>'.$formfields[$i]["label"].'</font>';
		elseif ($formfields[$i]["required"] == "yes" && $submitattempt=="yes" && $badentry[$i]=="yes")
			echo '<font class=font_green>'.$formfields[$i]["label"].'</font>';
		elseif ($formfields[$i]["field_name"] == "user_id" && $duplicateentry=="yes")
			echo '<font class=font_blue>'.$formfields[$i]["label"].'</font>';
		else
			echo $formfields[$i]["label"];

		if ($formfields[$i]["required"] == "yes")
			echo '<font color="red">*</font>';
		echo '</label>';
	}

	// -- field entry

	//	if ($formfields[$i]["type"] != "hidden" && $formfields[$i]["type"] != "title" && $formfields[$i]["type"] != "textarea" && $formfields[$i]["type"] != "button" && $formfields[$i]["type"] != "cust_info" && $dates != TRUE && $orderby != TRUE)
	//	{
	//	        echo '<td class=field>';
	//	}
	if ($formfields[$i]["type"] == "password") {
		echo '<input class=text title="'.$formfields[$i]["title"];
		echo '" name="'.$formfields[$i]["field_name"];
		echo '" type="'.$formfields[$i]["type"];
		echo '" size="'.$formfields[$i]["size"];
		echo '" maxlength="'.$formfields[$i]["maxlength"].'"';
		if (isset($formfields[$i]["read_only"])) {
			echo ' '.$formfields[$i]["read_only"].' ';
		}
		echo ' value="'.$_POST[$formfields[$i]["field_name"]].'">';
	} elseif ($formfields[$i]["type"] == "desc") {
		echo '<textarea name="' . $formfields[$i]["field_name"] . '" rows="'.$formfields[$i]["rows"]  .'" cols="'. $formfields[$i]["cols"] . '">'. $_POST[$formfields[$i]["field_name"]] .'</textarea><br />';
	} elseif ($formfields[$i]["type"] == "textarea") {
		echo "\t".'<textarea name="' . $formfields[$i]["field_name"] . '" rows="'.$formfields[$i]["rows"]  .'" cols="'. $formfields[$i]["cols"] . '">'. $_POST[$formfields[$i]["field_name"]] .'</textarea><br />'."\n";
	}
	elseif ($formfields[$i]["type"] == "cust_info") {
		require_once '../include/cust_info.php';
	} elseif ($formfields[$i]["type"] == "display_order" && isset($_GET["searchfield"]) && isset($_GET["value"]) ) {
		require_once '../include/display_order.php';
	} elseif ($formfields[$i]["type"] == "hidden") {
		echo "\t".'<input type="hidden" name="'.$formfields[$i]["field_name"].'" value="'.$_POST[$formfields[$i]["field_name"]].'">'."\n";
	} elseif ($formfields[$i]["type"] == "checkbox") {
		echo '<input name="'.$formfields[$i]["field_name"].'" type="'.$formfields[$i]["type"].'" '.$formfields[$i]["add_js"];
		if ($_POST[$formfields[$i]["field_name"]] == "yes") {
			echo 'checked';
		}
		echo ' >';
	} elseif ($formfields[$i]["type"] == "dates" && (!isset($_GET["searchfield"]) && (!isset($_GET["value"]) || !isset($_POST["value"])) )) {
		echo '<input class=text type="text" name="start_date" maxlength=10 size=11> - <input name="end_date" type="text" maxlength=10 size=11>';
	} elseif ($formfields[$i]["type"] == "zip") {
		if(isset($_POST[$formfields[$i]["field_name"]])) {
			list($_POST[$formfields[$i]["field_name"]."1"],$_POST[$formfields[$i]["field_name"]."2"])=explode("-",$_POST[$formfields[$i]["field_name"]]);
		}
		echo '<input class=text type="text" name="'.$formfields[$i]["field_name"].'1" value="'.$_POST[$formfields[$i]["field_name"]."1"].'" maxlength=5 size=5> - <input class=text name="'.$formfields[$i]["field_name"].'2" value="'.$_POST[$formfields[$i]["field_name"]."2"].'" type="text" maxlength=4 size=4>';
	} elseif ($formfields[$i]["type"] == "tel") {
		if(isset($_POST[$formfields[$i]["field_name"]])) {
			list($_POST[$formfields[$i]["field_name"]."1"],$_POST[$formfields[$i]["field_name"]."2"],$_POST[$formfields[$i]["field_name"]."3"])=explode("-",$_POST[$formfields[$i]["field_name"]]);
		}
		echo '(<input class=text tabindex= "1" type="text" name="'.$formfields[$i]["field_name"].'1" value="'.$_POST[$formfields[$i]["field_name"]."1"].'" maxlength=3 size=3 onkeyup="checkLen(this,this.value)">)<input class=text tabindex= "2" name="'.$formfields[$i]["field_name"].'2" value="'.$_POST[$formfields[$i]["field_name"]."2"].'" type="text" maxlength=3 size=3 onkeyup="checkLen(this,this.value)">-<input class=text tabindex= "3" name="'.$formfields[$i]["field_name"].'3" value="'.$_POST[$formfields[$i]["field_name"]."3"].'" type="text" maxlength=4 size=4 onkeyup="checkLen(this,this.value)">';
	} elseif ($formfields[$i]["type"] == "title") {
		echo "\n\t".'<h4 class=title_form>'.$formfields[$i]["label"]."</h4>\n";
	} elseif ($formfields[$i]["type"] == "custlist") {
		$counter=0;
		while(list($key, $value) = each($formfields[$i]["list"])) {
			$counter++;
		}
		echo '<select class=text name="'. $formfields[$i]["field_name"] .'">';
		for($z=0;$z<$counter;$z++) {
			if($_POST[$formfields[$i]["field_name"]] == $formfields[$i]["list"][$z])
				echo '<option selected value="'. $formfields[$i]["list"][$z] . '">' . $formfields[$i]["list"][++$z];
			else
				echo '<option value="' . $formfields[$i]["list"][$z] . '">' . $formfields[$i]["list"][++$z];
		}
		echo '</select>';
	} elseif($formfields[$i]["type"] == "button") {
		echo "\n\t".'<h4 class=title_button>';
		$counter=0;
		if($_POST["action"] == "Search" || (isset($_GET["searchfield"]) && isset($_GET["value"])) )
			$button_list = "searchlist";
		else
			$button_list = "list";

		while(list($key, $value) = each($formfields[$i][$button_list])) {
			$counter++;
		}
		for($z=0;$z<$counter;$z++) {
			$button_type = "submit";
			if($formfields[$i][$button_list][$z] == "Reset")
				$button_type = "reset";
			echo '<input class=submit name="action" type="'.$button_type.'" value="'.$formfields[$i][$button_list][$z] . '">';
		}
		echo "</h4>\n";
	} elseif ($formfields[$i]["type"] == "file") {
		echo '<input class=text name="'.$formfields[$i]["field_name"].'" size='.$formfields[$i]["size"].' type="'.$formfields[$i]["type"].'">';
		echo '<input type="hidden" name="MAX_FILE_SIZE" value="2000000">'."\n";
	} elseif ($formfields[$i]["type"] == "dropdown") {
		global $DB;
		$sql_query = "select ".$formfields[$i]["field"]." , ".$formfields[$i]["valuefield"]." from ".$formfields[$i]["table"]." order by ".$formfields[$i]["field"];
		$result = query_db($sql_query);
		// print out option list
		echo '<select class=text name="'. $formfields[$i]["field_name"] .'">';
		while($row = mysqli_fetch_array($result)) {
			echo '<option ';
			if ($_POST[$formfields[$i]["field_name"]] == $row[$formfields[$i]["valuefield"]]) {
				echo 'selected';
			}
			echo ' value="' . $row[$formfields[$i]["valuefield"]] . '">' . $row[$formfields[$i]["field"]];
		}
		echo '</select>';
	} elseif ($formfields[$i]["type"] == "groupdropdown") {
		global $DB;
		echo '<select class=text name="'.$formfields[$i]["field_name"]."\">\n";
		if (!empty($_POST[$formfields[$i]["field_name"]])) {
			$sql_query="select " . $formfields[$i]["itemfield"] . " from " . $formfields[$i]["itemtable"] . " where " . $formfields[$i]["field_name"]  . " = " . $_POST[$formfields[$i]["field_name"]]." order by ".$formfields[$i]["itemfield"];
			#echo $sql_query;
			$result = query_db($sql_query);
			$row = mysqli_fetch_array($result);
			// echo '--->' . $formfields[$i]["field_name"];
			echo '<option selected value="'.$_POST[$formfields[$i]["field_name"]].'">'.$row[$formfields[$i]["itemfield"]]."</option>\n";
		} else
			echo '<option selected value="">None</option>'."\n"; // remove value=none for search reasons

		$sql_query = "select " . $formfields[$i]["groupvaluefield"] . ", " . $formfields[$i]["groupfield"] . " from " . $formfields[$i]["grouptable"]." order by ". $formfields[$i]["groupfield"];
		//echo "query: " . $sql_query;
		//read from group table
		$result = query_db($sql_query);
		// print out option list
		while($row = mysqli_fetch_array($result)) {
			$sql_subquery = "select " . $formfields[$i]["itemfield"] . ", " .  $formfields[$i]["itemvaluefield"] . " from " . $formfields[$i]["itemtable"] . " where " . $formfields[$i]["groupvaluefield"] . "='" . $row[$formfields[$i]["groupvaluefield"]] . "' order by ".$formfields[$i]["itemfield"];
			//echo "subquery: " . $sql_subquery;
			$subresult = query_db($sql_subquery);
			if (mysqli_num_rows($subresult)!=0) {
				echo '<optgroup label="' . $row[$formfields[$i]["groupfield"]] . "\">\n";
				while($subrow = mysqli_fetch_array($subresult)) {
					echo "\t".'<option value="' . $subrow[$formfields[$i]["itemvaluefield"]] . '">' . $subrow[$formfields[$i]["itemfield"]] . "</option>\n";
				}
			echo "</optgroup>\n";
			}
		}
		echo "</select>\n";

	} elseif ($formfields[$i]["type"] == "orderby" && (!isset($_GET["searchfield"]) && (!isset($_GET["value"]) || !isset($_POST["value"])) )) {
		$counter=0;
		while(list($key, $value) = each($formfields[$i]["list"])) {
			$counter++;
		}
		echo '<select class=text name="'. $formfields[$i]["field_name"] .'">';
		for($z=0;$z<$counter;$z++) {
			echo '<option ';
			echo ' value="' . $formfields[$i]["list"][$z] . '">' . $formfields[$i]["list"][++$z]."\n";
		}
		echo '</select>
		<select class=text name="asc">
			<option value="ASC">Ascending
			<option value="DESC">Descending
		</select>';
	} elseif ($formfields[$i]["type"] == "custlist") {
		$counter=0;
		while(list($key, $value) = each($formfields[$i]["list"])) {
			$counter++;
		}
		echo '<select class=text name="'.$formfields[$i]["field_name"].'">';
		if(empty($_POST[$formfields[$i]["field_name"]]))
			echo '<option selected  value="">None';
		for($z=0;$z<$counter;$z++) {
			if($_POST[$formfields[$i]["field_name"]] == $formfields[$i]["list"][$z])
				echo '<option selected value="'.$formfields[$i]["list"][$z].'">' . $formfields[$i]["list"][++$z]."\n";
			else
				echo '<option value="'.$formfields[$i]["list"][$z].'">'.$formfields[$i]["list"][++$z]."\n";
		}
		echo "</select>";
	}

	elseif($dates != TRUE && $orderby != TRUE) {
		echo '<input class=text title="'.$formfields[$i]["title"];
		echo '" name="'.$formfields[$i]["field_name"];
		echo '" type="text';
		echo '" size="'.$formfields[$i]["size"];
		echo '" maxlength="'.$formfields[$i]["maxlength"].'"';
		if (isset($formfields[$i]["read_only"])) {
			echo ' '.$formfields[$i]["read_only"].' ';
		}
		echo ' value="'.$_POST[$formfields[$i]["field_name"]].'">';
	}
	// ------- comment field

	if ($formfields[$i]["type"] != "hidden" && $formfields[$i]["type"] != "title" && $formfields[$i]["type"] != "textarea" && $formfields[$i]["type"] != "button" && $formfields[$i]["type"] != "cust_info" && $dates != TRUE && $orderby != TRUE && $formfields[$i]["type"] != "display_order") {
		#echo '<p class=comment>';
		if ($formfields[$i]["required"] == "yes" && $submitattempt=="yes" && empty($_POST[$formfields[$i]["field_name"]]))
			echo '<font class=font_red><b> <-- Missing entry '.$formfields[$i]["label"].'</b></font>';
		elseif ($formfields[$i]["required"] == "yes" && $submitattempt=="yes" && $badentry[$i]=="yes")
			echo '<font class=font_green><b> <-- Improper entry '.$formfields[$i]["label"].'</b></font>';
		elseif ($formfields[$i]["field_name"] == "user_id" && $duplicateentry=="yes")
			echo '<font class=font_blue><b> <-- Duplicate entry '.$formfields[$i]["label"].'</b></font>';
		#elseif ( $formfields[$i]["imagelink"] == 'yes' && isset($_GET["searchfield"]) && (isset($_GET["value"]) || isset($POST["value"])) )
		elseif ( $formfields[$i]["imagelink"] == 'yes' && isset($_GET["searchfield"]) ) {
			if (is_file("images/".$_POST[$formfields[$i]["field_name"]]))
				$class='font_green';
			else
				$class='font_red';
			echo '<a class='.$class.' href="images/'.$_POST[$formfields[$i]["field_name"]].'">'.$_POST[$formfields[$i]["field_name"]].'</a>';
		} elseif ( $formfields[$i]["orderlink"] == 'yes' && isset($_GET["searchfield"]) ) {
			echo '<a class=dark_med href="'.$_SERVER[""].'?main=list_report&list=user_id&value='.$_POST[$formfields[$i]["field_name"]].'">Search Orders</a>';
		}
		else
			echo '&nbsp;';
		echo "<br />\n";
	}

}
echo "</div>\n";
$reqitems="no";
for ($i=0;$i<$FIELDCNT;$i++)
	if ($formfields[$i]["required"] == "yes") {
		$reqitems="yes";
		break;
	}

if ($reqitems=="yes")
	echo '<p><font class=font_black><font class=font_red>*Field is required</font> / <font class=font_green> Indicates improper entry</font> / <font class=font_blue>Duplicate Entry</font></font></p>';
?>
</form>
