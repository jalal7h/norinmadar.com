<?

# jalal7h@gmail.com
# 2015/09/21
# Version 1.0

function userpanel_desk(){
	
	#
	# fix if there is no "do" selected.
	if(!$_REQUEST['do']){
		foreach($GLOBALS['userpanel_item'] as $_REQUEST['do'] => $name){
			break;
		}
	}

	#
	# check to run the selected "do".
	if(!$_SESSION['uid']){
		die();	
	} else if(!$do = $_REQUEST['do']){
		return false;
	} else foreach($GLOBALS['userpanel_item'] as $func => $name){
		if($func==$do){
			return call_user_func($func);
		}
	}

	return false;
}

