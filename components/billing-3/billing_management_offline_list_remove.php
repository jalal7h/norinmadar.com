<?

function billing_management_offline_list_remove(){
	if(!$id = $_REQUEST['id']){
		e(__FUNCTION__.__LINE__);
	} else if(!$rw = table("billing_invoice", $id)){
		// e(__FUNCTION__.__LINE__);
	} else if(dbq(" DELETE FROM `billing_invoice` WHERE `id`='$id' LIMIT 1 ")){
		// e(__FUNCTION__.__LINE__);
	} else {
		return true;
	}

	return false;
}
