<?

$GLOBALS['block_layers']['post'] = 'پست دلخواه';

function post($table_name, $page_id){
	
	switch($table_name){
		case '_page_layers' :
			$query = " select * from `_page_layers` where `_id`='$page_id' limit 1 ";
			break;
		case '_page_frames' :
			$query = " select * from `_page_frames` where `_id`='$page_id' limit 1 ";
			break;
	}
	
	if(!$res=db_query($query)){
		cadr("Invalid page-id", "ERR");
		return false;
	} else {
		$rec = mysql_fetch_array($res);
		$allow_eval=false;
		switch(strtoupper($rec['_type'])){
		
			case 'HTML' :
				//if($rec['_framed']){
					//$rec['_data']= "<div style=padding:10px >".$rec['_data']."</div>";
				//}
				break;
				
			case 'PHP5' : 
				$allow_eval=true;
				break;
			
			case 'TEXT' :
			DEFAULT : 
				$rec['_data']=htmlspecialchars($rec['_data']);
				$rec['_data']=nl2br($rec['_data']);
				break;
				
		}
		if(strtoupper($rec['_type'])!='PHP5'){
			$rec['_data'] = "<div class='block-html-content'>".$rec['_data']."</div>";
		}
		return create_box($rec['_title'], $rec['_data'], $allow_eval, $rec['_framed'], $rec['_position']);
	}
}



