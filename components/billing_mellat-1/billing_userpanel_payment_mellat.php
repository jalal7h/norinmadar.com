<?


function billing_userpanel_payment_mellat( $invoice_id ){
	
	if(!$rw_invoice = table("billing_invoice", $invoice_id)){
		e(__LINE__." : ".__FILE__);
	} else {
		switch ($_REQUEST['bp_do']) {

			case 'verify':
				bpProcess();
				break;
			
			default:
				echo "<div class='convbox'>درحال انتقال به درگاه بانک ..</div>";
				$_REQUEST['ACT'] = "CREATE_FORM";
				$_REQUEST['Amount'] = $rw_invoice['cost'];
				$_REQUEST['invoice_id'] = $invoice_id;
				$_REQUEST['memo'] = $rw_invoice['cost'];
				bpPayRequest();
				break;
		}
	}
}

