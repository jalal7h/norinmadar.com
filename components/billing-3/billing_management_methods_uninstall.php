<?

function billing_management_methods_uninstall(){
	if(!$method = $_REQUEST['method']){
		e(__FUNCTION__.__LINE__);
	} else if(!dbq(" DELETE FROM `billing_method` WHERE `method`='$method' ")){
		e(__FUNCTION__.__LINE__);
	} else {
		return true;
	}

	return false;
}

