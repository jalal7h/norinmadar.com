<?
$GLOBALS['payment_method']['wallet'] = 'کیف پول';

function billing_userpanel_payment_wallet( $invoiceId ){
	if(!$uid = $_SESSION['uid']){
		e("billing_userpanel_payment_wallet - ".__LINE__);
	} else if(!$credit = billing_userCredit($uid)){
		e("billing_userpanel_payment_wallet - ".__LINE__);
	} else if(!$rw_invoice = table("billing_invoice", $invoiceId)){
		e("billing_userpanel_payment_wallet - ".__LINE__);
	} else if(!$rw_invoice['order_id']){
		e("billing_userpanel_payment_wallet - wrong status - ".__LINE__);
	} else if($rw_invoice['cost'] > $credit){
		e("billing_userpanel_payment_wallet - ".__LINE__);
	} else if(!$cost = $rw_invoice['cost']){
		e("billing_userpanel_payment_wallet - ".__LINE__);
	} else if(!billing_userCredit($uid , -1*$cost)){
		e("billing_userpanel_payment_wallet - ".__LINE__);
	} else {
		billing_settle( $invoiceId , $transaction="wallet" );
	}
}

