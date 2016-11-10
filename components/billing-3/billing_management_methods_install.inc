<?

function billing_management_methods_install(){
	if(!$method = $_REQUEST['method']){
		e(__FUNCTION__.__LINE__);
	} else if(!$rs = dbq(" SELECT * FROM `billing_method` WHERE `method`='$method' ")){
		e(__FUNCTION__.__LINE__);
	} else if(dbn($rs)!=0){
		e(__FUNCTION__.__LINE__);
	} else if(!dbq(" INSERT INTO `billing_method` (`method`,`unit`) VALUES ('".$method."','0.1') ")){
		e(__FUNCTION__.__LINE__);
	} else {
		return true;
	}

	return false;
}

