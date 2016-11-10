<?

function billing_management_offline_list_flag(){
	if(!$id = $_REQUEST['id']){
		e(__FUNCTION__.__LINE__);
	} else if(!$rw = table("billing_invoice", $id)){
		e(__FUNCTION__.__LINE__);
	} else if($rw['date']!=0){
		e(__FUNCTION__.__LINE__);
	} else if(!dbq(" UPDATE `billing_invoice` SET 
			`date`='"._bmol_separate( $rw['transaction'] , 0 )."',`transaction`='"._bmol_separate( $rw['transaction'] , 1 )."'
			WHERE `id`='$id' AND `date`='0' LIMIT 1 ")){
		e(__FUNCTION__.__LINE__);
		e(dbe());
	} else if(!billing_userCredit( $rw['uid'] , $rw['cost'] )){
		e(__FUNCTION__.__LINE__);
	} else {
		return true;
	}

	return false;
}
