<?php

global $link;
// this function builds a select box from a database field.
function db_selectbox($tablename, $namefield, $valuefield, $selectname, $selectedvalue, $boxsize, $boxwidth) {
	global $link;
	$sql_query="select " . $namefield . ", " . $valuefield . " from " . $tablename ." order by ". $namefield ;
	$result = query_db($sql_query);
	echo "\n".'<select name="'. $selectname.'"';
	if($boxsize != "none")
		echo ' size="'.$boxsize.'"';
	echo " style=\"width:$boxwidth;\" class=select>\n";
	while($row = mysqli_fetch_array($result)) {
		$SELECTED="";
		if ($row[$valuefield] == $selectedvalue) {
			$SELECTED="selected ";
		}
		echo '<option '.$SELECTED.'value="'.$row[$valuefield].'">'.$row[$namefield]."\n";
	}
	echo "</select>\n";
}

function db_selectboxgroup($table1name, $name1field, $value1field, $table2name, $name2field, $value2field, $selectname, $boxsize, $boxwidth)
{
	global $link;
	$sql1_query="select " . $name1field . ", " . $value1field . " from " . $table1name . " order by ". $name1field;
	$result1 = query_db($sql1_query);
	echo '<select name="'. $selectname .'" size="'.$boxsize.'" style="width:'.$boxwidth.';" class=select>'."\n";
	while($row1 = mysqli_fetch_array($result1)) {
		$sql2_query="select " . $name2field . ", " . $value2field . " from " . $table2name . " where " . $value1field . " = '" . $row1[$value1field] . "' order by " .$name2field;
		$result2 = query_db($sql2_query);
		if (mysqli_num_rows($result2)!=0) {
			echo '<optgroup label="' . $row1[$name1field] . '">' . "\n";
			#echo '<option value="'.$row1[$value1field].'">'.$row1[$name1field]."\n";
			while($row2 = mysqli_fetch_array($result2)) {
				echo '	<option value="' . $row2[$value2field] . '">' . $row2[$name2field] . "\n";
			}
			echo '</optgroup>' . "\n";
		}
	}
	echo "</select>\n";
}

function db_selectboxgroup2($selectname, $selectedvalue, $boxsize, $boxwidth) {
	global $link;
	$sql = 'select cat_name, cat.cat_id, subcat_name, subcat.subcat_id, prod_name, id from cat, subcat, product where cat.cat_id = product.cat_id and subcat.subcat_id = product.subcat_id order by cat_name, subcat_name, prod_name';
	$result = query_db($sql);
	if (mysqli_num_rows($result)!=0) {
		#global $CATHEAD, $SUBCATHEAD;
		if(isset($boxsize))
			$boxsize = 'size='.$boxsize;

			echo '<select name="'. $selectname .'" '.$boxsize.' style="width:'.$boxwidth.';" class=select>' . "\n";
		while($row = mysqli_fetch_array($result)) {
			if (!empty($SUBCATHEAD) && $SUBCATHEAD != $row["subcat_name"]) {
				echo '</optgroup>'."\n";
				if (isset($CATHEAD) && $CATHEAD != $row["cat_name"]) {
					echo '</optgroup>'."\n";
				}
			}

			if (empty($CATHEAD) || $CATHEAD != $row["cat_name"]) {
				$CATHEAD = $row["cat_name"];
				echo '<optgroup label="'.$CATHEAD."\">\n";
			}
			if (empty($SUBCATHEAD) || $SUBCATHEAD != $row["subcat_name"]) {
				$SUBCATHEAD = $row["subcat_name"];
				echo '<optgroup label="&nbsp; '.$SUBCATHEAD."\">\n";
			}
			if ($row["id"] == $selectedvalue)
				$SELECTED = 'selected';
			echo '<option '.$SELECTED.' value="'.$row["id"].'">'.$row["prod_name"]."\n";
			unset($SELECTED);
		}
		echo "</select>\n";
	
	}		
}
?>

