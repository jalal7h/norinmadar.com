<?

# jalal7h@gmail.com
# 2015/10/17
# Version 1.1.0

function billing_management_users_invoicelist(){
	if(!$uid = $_REQUEST['id']){
		die();
	}
	$tdd = 5;
	$p = intval($_REQUEST['p']);
	$stt = $tdd * $p;
	billing_management_users_activity( $uid );
	echo "<div class='billing_management_users_invoice_list'>";
	$query = " SELECT * FROM `billing_invoice` WHERE `date`>0 AND `uid`='$uid' AND `method`!='wallet' ORDER BY `date` DESC LIMIT $stt,$tdd ";
	if(!$rs = dbq($query)){
		e(__LINE__);
	} else if(dbn($rs)==0){
		echo "<div class='convbox' >هنوز صورتحسابی برای شما ثبت نشده است.</div>";
	} else {
		echo "<div class=r >
			<div>#</div>
			<div>مبلغ</div>
			<div>روش پرداخت</div>
			<div>سریال پرداخت</div>
			<div>تاریخ</div>
		</div>";
		while($rw = dbf($rs)){
			if(substr($rw['method'],0,6)=='manual'){
				$paymentmethod_name = table("billing_method", $rw['method'], "c1", "method");
			} else {
				$paymentmethod_name = $GLOBALS['billing_method'][$rw['method']];
			}
			echo "<div class=r >
				<div>".$rw['id']."</div>
				<div>".number_format($rw['cost'])." تومان</div>
				<div>".$paymentmethod_name."</div>
				<div>".$rw['transaction']."</div>
				<div>".substr(u2vaght($rw['date']),0,16)."</div>
			</div>";
		}
	}
	echo "</div>";

	$link = "./?page=".$_REQUEST['page']."&cp=".$_REQUEST['cp']."&func=".$_REQUEST['func']."&do=".$_REQUEST['do']."&id=".$uid."&p=";
	echo listmaker_paging($query, $link, $tdd);
}





