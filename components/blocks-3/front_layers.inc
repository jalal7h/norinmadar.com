<?

function f_front__f_layers__draw($page){
	
	ob_start();
	f_front__f_layers__draw_position('top', $page);
	$vars['f_front__f_layers__draw_position-top'] = ob_get_contents();
	ob_end_clean();
	
	ob_start();
	f_front__f_layers__draw_position('left', $page);
	$vars['f_front__f_layers__draw_position-left'] = ob_get_contents();
	ob_end_clean();
	
	ob_start();
	f_front__f_layers__draw_position('center', $page);
	$vars['f_front__f_layers__draw_position-center'] = ob_get_contents();
	ob_end_clean();
	
	ob_start();
	f_front__f_layers__draw_position('right', $page);
	$vars['f_front__f_layers__draw_position-right'] = ob_get_contents();
	ob_end_clean();
	
	ob_start();
	f_front__f_layers__draw_position('down', $page);
	$vars['f_front__f_layers__draw_position-down'] = ob_get_contents();
	ob_end_clean();
	
	echo template_engine('main',$vars);
}

function f_front__f_layers__draw_position($position, $page){
	
	switch($position){
		case 'center' : 
		$query = " select `_id`,`_page`,`_func` from `_page_layers` where `_page`='$page' and `_status`=1 order by `_priority`,`_id` ";
		$table_name = "_page_layers";
		break;
		
		DEFAULT : 
		$query = " select `_id`,`_func` from `_page_frames` where `_position`='$position' and `_status`=1 order by `_priority`,`_id` ";
		$table_name = "_page_frames";
		break;
	}
	
	if($res = db_query($query)){
		$numrows = mysql_num_rows($res);
		for($i=0; $i<$numrows; $i++){
			$rec = mysql_fetch_array($res);
			if(function_exists($rec['_func'])){
				call_user_func($rec['_func'], $table_name, $rec[0]);
			} else {
				echo cadr("invalid function called: <i>".$rec['_func']."</i>","ERR");
			}
		}
	} else {
		echo cadr("er54");
	}
	return true;
}







