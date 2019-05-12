<?php

$where_stat=' where '.$add_stat;
$x=0;
while(list($key, $value) = each($_POST))
{
        if($value != "" && $key != "MAX_FILE_SIZE")
        {
		
		if($add_stat != '')
			$x=1;
                if($key != "order" && $key != "asc" && $key != "end_date" && $key != "start_date" && $key != "action" && $key != "user_id"
			&& $key != "search_")
                {
			if($x>0)
			{
				$where_stat.=' and';
			}
                        $where_stat.=' '.$key.' like \''.$value.'%\' ';
			$x++;
                }
		elseif($key == "user_id")
		{
			if($MAINBASE == "order")
				$key = "cust_info.".$key;
			if($x>0)
			{
				$where_stat.=' and';
			}
                        $where_stat.=' '.$key.' like \''.$value.'%\' ';
			$x++;
		}
        }
}

if($_POST["start_date"] != "" or $_POST["end_date"] != "")
{
        if($x>0)
                $where_stat.=' and';
        if($_POST["start_date"] == "")
                $_POST["start_date"] = '1111-01-01';
        if($_POST["end_date"] == "")
                $_POST["end_date"] = '9999-12-31';
	$date = "start_date";	// this needs to be changed in the future
	if($MAINBASE == "order")
		$date = "order_date";
        $where_stat.=' '.$date.' between \''.$_POST["start_date"].'\' and \''.$_POST["end_date"].'\'';
}
if($where_stat == ' where ')
        $where_stat = '';

?>
