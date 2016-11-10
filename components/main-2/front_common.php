<?

function SUB_STRING($STR, $S, $V){
	
	if(strlen($STR)<=($V-$S))return $STR;
	
	$STR = substr($STR, $S, $V);
	$tmp = explode(' ', $STR);
	for($i=0,$STR='' ; $i<sizeof($tmp)-1; $i++)
		$STR.= ' '.$tmp[$i];
	return $STR;
}

function cadr($prompt,$ptype="ERR"){
	if($ptype!="INF"){
		$ptype = "ERR";
	}
	$bgcolor_tb['INF'] = "#2f7500";
	$bgcolor_td['INF'] = "#efffdf";
	$bgcolor_tb['ERR'] = "#7a0000";
	$bgcolor_td['ERR'] = "#ffd2d2";
	
	$vars['bgcolor_tb']=$bgcolor_tb[$ptype];
	$vars['bgcolor_td']=$bgcolor_td[$ptype];
	$vars['prompt']=$prompt;
	
	return "<div class='convbox' >".$prompt."</div>";
	return template_engine('error-prompt-cadre',$vars);
}




