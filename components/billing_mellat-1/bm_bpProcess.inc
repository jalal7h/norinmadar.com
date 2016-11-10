<?

function bpProcess(){
	if(!$_REQUEST){
		echo "billing_userpanel_payment_mellat - ".__LINE__;
		return false;
	} else if($_REQUEST['ResCode']!=0){
		echo "<div class='convbox'>پرداخت شما لغو شد!</div>";
		return false;
	} else if(!bpVerifyRequest()){
		/******************/
		if(!bpInquiryRequest()){
			if(!bpReversalRequest()){
				echo "<hr>".$result['return']."<hr>";
				echo "<font color=red >transaction not reversed, wrong response from bpReversalRequest.</font>";
				return false;
			} else {
				echo "<hr>".$result['return']."<hr>";
				echo "<font color=green >transaction reversed, please try again.</font>";
				return false;
			}
		} else if(!bpSettleRequest()){
			echo "billing_userpanel_payment_mellat - ".__LINE__;
			return false;
		} else if(!bpSettleDone($_REQUEST['SaleReferenceId'])){
			echo "billing_userpanel_payment_mellat - ".__LINE__;
		} else {
			// its OK.
		}
		/******************/
	} else if(!bpSettleRequest()){
		echo "billing_userpanel_payment_mellat - ".__LINE__;
	} else if(!bpSettleDone()){
		echo "billing_userpanel_payment_mellat - ".__LINE__;
	} else {
		// its OK.
	}
}




