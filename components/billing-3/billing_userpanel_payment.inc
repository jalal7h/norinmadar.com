<?

# jalal7h@gmail.com
# 2015/09/15
# Version 1.0

function billing_userpanel_payment(){
	# 
	# verify
	if(!$uid = $_SESSION['uid']){
		die();
	}
	#
	# action switch
	switch($_REQUEST['do2']){
		case 'invoiceCreate':
			return billing_userpanel_payment_invoiceCreate();
	}
	#
	# form
	$order_id = intval($_REQUEST['order_id']);
	$cost = dbr(dbq(" SELECT SUM(`unitcost`*`count`) FROM `orders_item` WHERE `order_id`='$order_id' "), 0, 0);
	asort($GLOBALS['billing_method']);
	$wallet_credit = "<span class='wallet_credit'>".number_format(billing_userCredit($uid))." ".tab__temp('money_unit')." اعتبار</span>";
	foreach($GLOBALS['billing_method'] as $method => $method_title){
		if( $order_id==0 and $method=="wallet"){
			continue;
		}
		$method_str.= "<div class='r'><label><input title='$method_title' type=radio name='method' value='$method' /><img src='image.list/billing_".$method.".png'/>".($method=='wallet'?$wallet_credit:"")."</label></div>";
	}

	#
	# offline methods
	if(!$rs_off = dbq(" SELECT * FROM `billing_method` WHERE `hide`='0' AND `c5`='offline' ORDER BY `id` DESC ")){
		e(__FUNCTION__.__LINE__);
	} else if(!dbn($rs_off)){
		;//
	} else {
		$method_str_offline = "<div style='clear: both; float: none;'></div><h1 style='border-top: 1px dashed #ccc; padding-top: 27px;'>آفلاین</h1>";
		while($rw_off = dbf($rs_off)){
			$method_str_offline.= "
			<label class='r offline'>
				<input title='".$rw_off['c1']."' type=radio name='method' value='".$rw_off['method']."' />
				<span class='c1'>".$rw_off['c1']."</span>
			    <div class='c-container'>
					<span class='c2'>حساب:‌ ".$rw_off['c2']."</span>
					<span class='c3'>کارت:‌ ".$rw_off['c3']."</span>
				</div>
			</label>";
		}
	}

	echo "
	<script> var billing_userCredit='".billing_userCredit($_SESSION['uid'])."';</script>
	<form method='post' action='./?page=".$_REQUEST['page']."&do=".$_REQUEST['do']."&do2=invoiceCreate".($order_id?"&order_id=$order_id":"")."' class='billing_userpanel_payment' name='blngpf'>
		<div class='text' >نحوه پرداخت:</div>
		<div class='method_list'>
			<h1>آنلاین</h1>
			".$method_str."
			".$method_str_offline."
		</div>
		<div class='cost-container'>
			<span>مبلغ قابل پرداخت</span>
			<input type=text name='cost' class='numeric' id='billing_cost' value='$cost' ".($cost?"readonly='1'":"")." />
			<span>تومان</span>
			<div class='convbox'>
				با کلیک روی پرداخت به درگاه بانک می روید<br/>
				شما می توانید پرداخت خود را با کلیه کارت عضو شتاب انجام دهید
			</div>
			<input type='submit' value='پرداخت' />
		</div>
	</form>";
}




