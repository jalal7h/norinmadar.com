<?

# -spi-

# accounting user wallet, setting order as paid (if exists) and at the final congragulating.	

function billing_settle( $billing_invoice_id , $transaction ){
	if(!$rs=dbq(" SELECT * FROM `billing_invoice` WHERE 1 AND `id`='$billing_invoice_id' AND `date`='0' LIMIT 1 ")){
		echo "billing_settle - ".__LINE__."<br>";
	} else if(dbn($rs)!=1){
		echo "billing_settle - ".__LINE__."<br>";
	} else if(!$rw = dbf($rs)){
		echo "billing_settle - ".__LINE__."<br>";
	} else if($rw['uid']!=$_SESSION['uid']){
		echo "billing_settle - ".__LINE__."<br>";
	} else if(!dbq(" UPDATE `billing_invoice` SET `date`='".U()."', `transaction`='$transaction' WHERE `id`='".$billing_invoice_id."' LIMIT 1 ")){
		echo "billing_settle - ".__LINE__."<br>";
	} else if(!dbq(" UPDATE `users` SET `wallet_credit`=`wallet_credit`+'".$rw['cost']."' WHERE `id`='".$_SESSION['uid']."' LIMIT 1 ")){
		echo "billing_settle - ".__LINE__."<br>";
	} else if($order_id = $rw['order_id']){
		// if its an order
		if(!$order_cost = dbr(dbq(" SELECT SUM(`count` * `unitcost`) FROM `orders_item` WHERE `order_id`='".$order_id."' "), 0, 0)) {
			echo "billing_settle - ".__LINE__."<br>";
		} else if(!$userCredit = dbr(dbq(" SELECT `wallet_credit` FROM `users` WHERE `id`='".$_SESSION['uid']."' LIMIT 1 "), 0, 0)) {
			echo "billing_settle - ".__LINE__."<br>";
		} else if($userCredit < $order_cost){
			echo "billing_settle - ".__LINE__."<br>";
		} else if(!dbq(" UPDATE `users` SET `wallet_credit`=`wallet_credit`-".$order_cost." WHERE `id`='".$_SESSION['uid']."' LIMIT 1 ")) {
			echo "billing_settle - ".__LINE__."<br>";
		} else if(!dbq(" UPDATE `orders` SET `date_paid`='".U()."' WHERE `id`='".$order_id."' LIMIT 1 ")) {
			echo "billing_settle - ".__LINE__."<br>";
		} else {
			# 
			# congragulate the payment
			echo "<div class='convbox'>پرداخت به مبلغ ".number_format($rw['cost'])." تومان با موفقیت انجام شد.<br><a href='./userpanel'>بازگشت به محیط کاربری</a></div>";
			# 
			# congragulate the order confirm
			orders_confirmAfterPayment( $order_id );
			echo "<div class='convbox'>پرداخت بابت سفارشات شما به شماره <b>".$order_id."</b> تایید شد.<br>پس برای دریافت کوپن های تخفیف <a href='./?do_action=orders_user_copon_print&order_id=".$order_id."'>کلیک کنید</a>.</div>";
		}
	} else {
		// if its an account balancing
		echo "<div class='convbox'>پرداخت به مبلغ ".number_format($rw['cost'])." تومان با موفقیت انجام شد.<br><a href='./userpanel'>بازگشت به محیط کاربری</a></div>";
	}
}




