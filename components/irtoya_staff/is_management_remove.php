<?

# jalal7h@gmail.com
# 2015/10/21
# Version 1.0.0

function is_management_remove(){

	if(!$id = $_REQUEST['id']){
		e(__FUNCTION__.__LINE__);
	} else if(!dbq(" DELETE FROM `irtoya_staff` WHERE `id`='$id' LIMIT 1 ")){
		e(__FUNCTION__.__LINE__);
	} else {
		return true;
	}

	return false;
}

