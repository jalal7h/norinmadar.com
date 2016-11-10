<?

function orders_management_list_paymentform(){
	if(!$order_id = $_REQUEST['id']){
		echo "err - ".__FILE__." : ".__LINE__;
	} else if(!$orders_rw = table("orders", $order_id)){
		echo "err - ".__FILE__." : ".__LINE__;
	} else if($orders_rw['date_paid']>0){
		;//
	} else {
		$total_cost = dbr(dbq(" SELECT SUM( `count` * `unitcost` ) as sum0 FROM `orders_item` WHERE `order_id`='$order_id' "), 0, 0);
		echo "<form onsubmit='if( $(\"#method01\").val()==\"\" ){return false;}' class='orders_management_list_payment' method='post' action='./?page=admin&cp=".$_REQUEST['cp']."&func=".$_REQUEST['func']."&p=".$_REQUEST['p']."&do=save_payment&id=".$_REQUEST['id']."' >
		<div><span>نوع پرداخت : </span><select name='method' id='method01' ><option></option>".cat_display('paymentmethod', $is_array=false)."</select></div>
		<div><span>تاریخ پرداخت : </span><input type='text' id=calendar class='calendar' name='date_paid' value='".substr(U2Vaght(U()), 0, 10)."' /></div>
		<div><span>شماره سریال : </span><input type=text onclick='this.select();' name=transaction value='' /></div>
		<div><span>مبلغ : </span><input type=text onclick='this.select();' name='cost' readonly=1 value='".number_format($total_cost)."' /> ".tab__temp("money_unit")."</div>
		<div><span></span><input type=submit value='ثبت پرداخت'/></div>
		</form>";
	}
	// orders_management_list_paymentlist($order_id);
	
	return false;
}

