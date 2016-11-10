<?

function draw_tasks(){
	if($GLOBALS['task']){
		foreach($GLOBALS['task'] as $k => $r){
			call_user_func($r);
		}
	}
}
