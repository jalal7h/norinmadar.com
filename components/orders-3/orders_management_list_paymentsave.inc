<?

function orders_management_list_paymentsave(){
	if(!$order_id = $_REQUEST['id']){
		echo "err - ".__FILE__." : ".__LINE__;
	} else if(!$method = $_REQUEST['method']){
		echo "err - ".__FILE__." : ".__LINE__;
	} else if(!$date_paid = $_REQUEST['date_paid']){
		echo "err - ".__FILE__." : ".__LINE__;
	} else if(!$cost = str_replace(",", "", $_REQUEST['cost'])){
		echo "err - ".__FILE__." : ".__LINE__;
	} else if(!$transaction = $_REQUEST['transaction']){
		echo "err - ".__FILE__." : ".__LINE__;
	} else {
		$rw_orders = table("orders", $order_id);
		$uid = $rw_orders['uid'];
		$order_date_paid = $rw_orders['date_paid'];
		$date = Vaght2U($date_paid." 12:00:00");
		
		if($order_date_paid!=0){
			echo "this order already paid; ".__FILE__." : ".__LINE__;
		} else if(!dbq(" INSERT INTO `billing_invoice` (`uid`, `order_id`, `cost`, `method`, `transaction`, `date`) VALUES ('$uid', '$order_id', '$cost', '$method', '$transaction', '$date') ")){
			echo "err - ".__FILE__." : ".__LINE__;
		} else {
			if(!dbq(" UPDATE `orders` SET `date_paid`='".$date_paid."' WHERE `id`='$order_id' LIMIT 1 ")){
				echo "err - ".__FILE__." : ".__LINE__;
			} else {
				return true;
			}
		}
	}
	return false;
}

