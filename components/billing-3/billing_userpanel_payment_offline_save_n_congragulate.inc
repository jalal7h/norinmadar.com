<?

function billing_userpanel_payment_offline_save_n_congragulate(){
	if(!$uid = $_SESSION['uid']){
		e(__LINE__." : ".__FILE__);
	} else if(!$cost = intval($_REQUEST['cost'])){
		e(__LINE__." : ".__FILE__);
	} else if(!$method = $_REQUEST['method']){
		e(__LINE__." : ".__FILE__);
	} else if(!$transaction = $_REQUEST['transaction']){
		e(__LINE__." : ".__FILE__);
	} else if(!$date = $_REQUEST['date']){
		e(__LINE__." : ".__FILE__);
	} else if(!$date = Vaght2U($date." 12:00:00")){
		e(__LINE__." : ".__FILE__);
	} else if(!dbq(" INSERT INTO `billing_invoice` (`uid`,`cost`,`method`,`transaction`) VALUES ('$uid','$cost','$method','".$transaction.":".$date."') ")){
		e(__FUNCTION__.__LINE__);
	} else {

		echo "
		<div class='_buposnc'>
			<icon></icon>
			<span>پرداخت شما ثبت شد.<br>
			به زودی مورد بررسی قرار خواهد گرفت.</span>
		</div>";
		return true;
	}

	return false;
}
