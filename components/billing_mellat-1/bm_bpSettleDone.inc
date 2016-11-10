<?

function bpSettleDone(){
	if(!$transaction = $_REQUEST['SaleReferenceId']){
		echo "f__api - ".__LINE__."<br>";
	} else if(!$billing_invoice_id = intval($_REQUEST['SaleCode'])){
		echo "f__api - ".__LINE__."<br>";
	} else {
		billing_settle( $billing_invoice_id , $transaction );
		return true;
	}

	return false;
}

