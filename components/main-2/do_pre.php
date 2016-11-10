<?

function do_pre(){
	if($_REQUEST['do_action']){
		return true;
	} else if(!$GLOBALS['do_pre']){
		return true;
	} else foreach($GLOBALS['do_pre'] as $k=>$do_pre){
		call_user_func($do_pre);
	}
}
