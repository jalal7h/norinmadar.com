<?


function bpInquiryRequest(){
	
	if(__BP_TEST){
		echo "bpInquiryRequest<br>";
		echo "waiting for bank response ...";flush();
	}
	
	include_once ("modules/nusoap.mellat/nusoap.php");
	$client = new soapclient2(_MELLAT_SOAPV);
	$namespace = 'http://interfaces.core.sw.bps.com/';
	
	// Check for an error
	$err = $client->getError();
	
	if ($err) {
		// Display the error
		echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
		// At this point, you know the call that follows will fail
	}
	
	$invoice_id = $_REQUEST['SaleCode'];
	$inquirySaleOrderId = $_REQUEST['SaleOrderId'];
	$inquirySaleReferenceId = $_REQUEST['SaleReferenceId'];
	
	// Check for an error
	$err = $client->getError();
	if ($err) {
		echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
		die();
	}
	
	$parameters = array(
		'terminalId' => $GLOBALS['payment_method_datafield']['mellat']['TermID'],
		'userName' => $GLOBALS['payment_method_datafield']['mellat']['TermUS'],
		'userPassword' => $GLOBALS['payment_method_datafield']['mellat']['TermPW'],
		'orderId' => $invoice_id,
		'saleOrderId' => $inquirySaleOrderId,
		'saleReferenceId' => $inquirySaleReferenceId
	);
	
	// Call the SOAP method
	$result = $client->call('bpInquiryRequest', $parameters, $namespace);
	
	if(__BP_TEST){
		echo "<div style='position:absolute; left:5px; top:500px;' ><b style='color:green;'>bpInquiryRequest</b>:<bt>";
		echo "<pre>parameters:";
		print_r($parameters);
		echo "</pre>";

		echo "<pre>bpPayRequest-result:";
		print_r($result);
		echo "</pre>";
		echo "</div>";
	}
	
	// Check for a fault
	if ($client->fault) {
		echo '<h2>Fault</h2><pre>';
		print_r($result);
		echo '</pre>';
		die();
	} else if($err = $client->getError()) {
		// Display the error
		echo '<h2>Error</h2><pre>' . $err . '</pre>';
		die();
	} else if($result['return']==0){
		// Display the result
		// Update Table, Save Verify Status 
		// Note: Successful Verify means complete successful sale was done.
		# echo "<script>alert('Verify Response is : " . $resultStr . "');</script>";
		# echo "Verify Response is : " . $resultStr;
		return true;
	} else if(!bpReversalRequest()){
		echo "<hr>".$result['return']."<hr>";
		echo "<font color=red >transaction not reversed, wrong response from bpReversalRequest.</font>";
		return false;
	} else {
		echo "<hr>".$result['return']."<hr>";
		echo "<font color=green >transaction reversed, please try again.</font>";
		return false;
	}
}
