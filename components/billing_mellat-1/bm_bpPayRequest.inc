<?


function bpPayRequest(){
	# ResCode
	# refID
	if(__BP_TEST){
		echo "bpInquiryRequest<br>";
		echo "waiting for bank response ...";flush();
	}
	
	if(!$amount = intval($_REQUEST['Amount']) / $GLOBALS['payment_method_datafield']['mellat']['UnitCost'] ){
		echo "invalid amount";
		return false;
	} else if(!$invoice_id = $_REQUEST['invoice_id']){
		
	}
	
	if(__BP_TEST){
		echo "waiting for bank response ... (bpPayRequest)<br>";flush();
	}
	
	require_once("modules/nusoap.mellat/nusoap.php"); 
	$client = new soapclient2(_MELLAT_SOAPV);
	$namespace = 'http://interfaces.core.sw.bps.com/';
	
	// Check for an error
	$err = $client->getError();
	if ($err) {
		echo __FILE__." - ".__LINE__."<br>";
		echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
		die();
	}
	
	$localDate = substr(date('Ymd'), 2);
	$localTime = date('His');
	$additionalData = "";
	$callBackUrl = _URL."/process.php?SaleCode=".$invoice_id;
	$callBackUrl = _URL."/?page=".$_REQUEST['page']."&do=".$_REQUEST['do']."&do2=".$_REQUEST['do2']."&cost=".$_REQUEST['cost']."&method=".$_REQUEST['method']."&bp_do=verify&SaleCode=".$invoice_id;
	$payerId = 0;

	
	$parameters = array(
		'terminalId' => $GLOBALS['payment_method_datafield']['mellat']['TermID'],
		'userName' => $GLOBALS['payment_method_datafield']['mellat']['TermUS'],
		'userPassword' => $GLOBALS['payment_method_datafield']['mellat']['TermPW'],
		'orderId' => $invoice_id,
		'amount' => $amount,
		'localDate' => $localDate,
		'localTime' => $localTime,
		'additionalData' => $additionalData,
		'callBackUrl' => $callBackUrl,
		'payerId' => $payerId
	);
	
	// Call the SOAP method
	$result = $client->call('bpPayRequest', $parameters, $namespace);
	
	if(__BP_TEST){
		echo "<div style='position:absolute; left:5px; top:25px;' ><b style='color:green;'>bpPayRequest</b>:<bt>";
		echo "<pre>parameters:";
		print_r($parameters);
		echo "</pre>";
		
		echo "<pre>bpPayRequest-result:";
		print_r($result);
		echo "</pre>";
		echo "</div>";
	}
	
	if($client->fault) {
		echo __FILE__." - ".__LINE__."<br>";
		echo '<h2>Fault</h2><pre>';
		print_r($result);
		echo '</pre>';
		die();
	} else {
		// Check for errors
		$err = $client->getError();
		if ($err) {
			echo '<h2>Error</h2><pre>' . $err . '</pre>';
			die();
		} else {
			// Display the result
			$result = explode (',',$result);
			$ResCode = $result[0];
			$refID = $result[1];
			
			if(__BP_TEST){
				echo "<div style='position:absolute; left:500px; top:25px;' >";
				echo "	<br>ResCode : ".$ResCode;
				echo "	<br>refID : ".$refID;
				echo "</div>";
			}
			if($ResCode == 0){ // bank verification result code.
				//here insert Hashcode to your databse and log it
				//**********************************
				
				if(!$sql=dbq(" select * from `billing_invoice` where `transaction`='$refID' ")){
					echo "EpMeEa".__LINE__."<br>";
					return false;
				} else if(dbn($sql)){
					echo "DOUBLE refID !<br>EpMeEa".__LINE__."<br>";
					return false;
				} else if(!dbq(" UPDATE `billing_invoice` SET `transaction`='$refID' WHERE `id`='$invoice_id' LIMIT 1 ")){
					echo "EpMeEa".__LINE__."<br>";
					return false;
				} else {
					$prmpt = "<br>تراکنش ثبت شد";
				}
				//***********************************
				echo '
					<script language="javascript" type="text/javascript">    
						
						function postRefId (refIdValue) {
							var form = document.createElement("form");
							form.setAttribute("method", "POST");
							form.setAttribute("action", "'._MELLAT_RDRCT.'");         
							//form.setAttribute("target", "formresult");
							var hiddenField = document.createElement("input");              
							hiddenField.setAttribute("name", "RefId");
							hiddenField.setAttribute("value", refIdValue);
							form.appendChild(hiddenField);
							document.body.appendChild(form);         
							form.submit();
							document.body.removeChild(form);
						}
					</script>
					
				<table dir=rtl width=100% height=100% ><tr><th style="font-family:tahoma; font-size:12px; " >ارتباط با بانک برقرار شد
				'.$prmpt.'
				<br>در حال ورود به بانک ...</th></tr></table>
				<script language=javascript type="text/javascript" >postRefId("'.$refID.'");</script>
				';
				die();
			} else {
				// log error in app
				echo "خطایی در سیستم به وجود آمده است <b>شماره خطا</b> :"; 
				echo $ResCode ;
				echo "<br/>";
				echo "شماره فاکتور :".$invoice_id;
				die();
			}
		}
	}
}
