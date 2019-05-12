<?php

function record_useragent ($ip_addr, $user_agent, $request_uri) {
	if(!empty($ip_addr) && !empty($user_agent)) {
		$select = 'select * from record_useragent where user_agent like \''.$user_agent.'\' and ip_addr = "'.$ip_addr.'"';
		$result = query_db($select);
		$row = mysqli_fetch_array($result);
		#echo $select;
		if (empty($row["id"]) ) {
			$insert = 'insert into record_useragent (user_agent, ip_addr, last_date, first_date, page_count) values (\''.$user_agent.'\', "'.$ip_addr.'", curdate(), curdate(), 1)';
			#echo $insert;
			$result = query_db($insert);
			$id=mysqli_insert_id();
			$insert = 'insert into record_page values ('.$id.', \''.$request_uri.'\', 1)';
			$result = query_db($insert);
		} else {
			$row["page_count"]++;
			$update = 'update record_useragent set page_count = '.$row["page_count"].' ,last_date = curdate() where id = '.$row["id"];
			#echo $update;
			$result = query_db($update);
			$select = 'select * from record_page where id = '.$row["id"].' and page like \''.$request_uri.'\'';
			$result = query_db($select);
			$row2 = mysqli_fetch_array($result);
			if (empty($row2["id"]) ) {
				$insert = 'insert into record_page values ('.$row["id"].', \''.$request_uri.'\', 1)';	
				$result = query_db($insert);
			} else {
				$row2["page_count"]++;
				$update = 'update record_page set page_count = '.$row2["page_count"].' where id = '.$row2["id"].' and page like \''.$request_uri.'\'';	
				$result = query_db($update);
			}
		}	

	}	
}

?>
