<?

function orders_basket_confirm(){
	$date = U();
	$address = $_REQUEST['address'];
	$tell = $_REQUEST['tell'];
	if(!$uid = $_SESSION['uid']){
		echo "err - ".__LINE__;
	} else if(sizeof($_SESSION['orders_basket'])==0){
		echo "err - ".__LINE__;
	} else if(!dbq(" INSERT INTO `orders` (`uid`, `date`,`address`,`tell`) VALUES ('$uid', '$date','$address','$tell') ")){
		echo "err - ".__LINE__;
	} else if(!$order_id = dbi()){
		echo "err - ".__LINE__;
	} else {
		foreach ($_SESSION['orders_basket'] as $id => $count) {
			$rw = table(_products_table, $id);
			$unitcost = $rw['cost'];
			if($count<=0){
				continue;
			} else if(!dbq(" INSERT INTO `orders_item` (`order_id`, `product_id`, `count`, `unitcost`) VALUES ('$order_id', '$id', '$count', '$unitcost') ")){
				echo "err - ".__LINE__;
				echo dbe();
			} else {
				$total+= $count * $unitcost;
				unset($_SESSION['orders_basket'][$id]);
			}
		}

		if( $total==0 ) {
			dbq(" UPDATE `orders` SET `date_paid`='$date' WHERE `id`='$order_id' LIMIT 1 ");
		}

		?>
		<div class="orders_basket_confirm">
			<img class="lampp" src="{orders-lampp.png}" />
			<div class="convbox">
				سفارش شما به شماره <b>#<?=$order_id?></b> ثبت شد.
				<? if( $total > 0 ){ ?>
				<br>پس از پرداخت به مبلغ <?=number_format($total)?> <?=tab__temp('money_unit')?> سفارش شما فعال خواهد شد.
				<? } else { ?>
				<br>پس از بررسی با شما تماس گرفته خواهد شد.
				<? } ?>
			</div>
			<? if( $total > 0 ){ ?>
			<a class="payment_button" href="./billing-payment<?=$order_id?>">پرداخت</a>
			<? } ?>
			<a class="list_button" href="./userpanel">مشاهده لیست سفارشات</a>
		</div>
		<?
	}
}









