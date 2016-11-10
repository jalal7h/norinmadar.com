<?

# after payment form, it will create an invoce, and try to 
# send user to payment form which selected by hyser

function billing_userpanel_payment_invoiceCreate(){
	if(!$uid = $_SESSION['uid']){
		e(__LINE__." : ".__FILE__);
	} else if(!$cost = intval($_REQUEST['cost'])){
		e(__LINE__." : ".__FILE__);
	} else if(!$method = $_REQUEST['method']){
		e(__LINE__." : ".__FILE__);
	} else if(substr($method, 0, 6)=='manual'){
		return billing_userpanel_payment_offline();
	} else if(!function_exists('billing_userpanel_payment_'.$method)){
		e(__LINE__." : ".__FILE__);
	} else {
		$order_id = $_REQUEST['order_id'];
		if($order_id){
			if(!$rs = dbq(" SELECT COUNT(*) FROM `billing_invoice` WHERE `order_id`='$order_id' ")){
				e("billing_userpanel_payment_invoiceCreate - ".__LINE__);
			} else if(dbn($rs)==0){
				;// its new, we need to insert it
			} else if(!$rw = dbf($rs)){
				e("billing_userpanel_payment_invoiceCreate - ".__LINE__);
			} else {
				$invoiceId = $rw['id'];
			}
		}
		if($invoiceId){
			;// it already inserted
		} else if(!dbq(" INSERT INTO `billing_invoice` (`uid`,`order_id`,`cost`,`method`) VALUES ('$uid','$order_id','$cost','$method') ")){
			e(__LINE__." : ".__FILE__." ".dbe());
		} else {
			$invoiceId = dbi();
		}
		call_user_func('billing_userpanel_payment_'.$method, $invoiceId);
	}
}













