<?

function orders_user_list(){

	if(!$uid = $_SESSION['uid']){
		echo "err - ".__LINE__;
		die();
	}
	
	switch ($_REQUEST['do2']) {
		case 'detail':
			return orders_user_list_detail( $_REQUEST['id'] );
	}
	
	$tdd = 10;
	$stt = intval($_REQUEST['p']) * $tdd;

	$query = " SELECT * FROM `orders` WHERE `uid`='$uid' ORDER BY `date` DESC LIMIT $stt,$tdd ";
	if(!$rs = dbq($query)){
		echo "err - ".__LINE__;
		echo dbe();
	} else if(!dbn($rs)){
		echo "<div class='convbox'>شما هنوز سفارشی ثبت نکرده اید.</div>";
	} else {
		?>
		<table class="orders_user_list">
		<tr>
			<th>#</th>
			<th>تعداد کالا</th>
			<th>مبلغ کل</th>
			<th>تاریخ سفارش</th>
			<th>تاریخ پرداخت</th>
			<th>تاریخ ارسال</th>
			<th></th>
		</tr>
		<tr><td colspan="6"></td></tr>
		<?
		while($rw = dbf($rs)){
			$count = dbr(dbq(" SELECT SUM(`count`) FROM `orders_item` WHERE `order_id`='".$rw['id']."' "),0,0);
			$count = number_format($count)." قلم";
			$total_cost = dbr(dbq(" SELECT SUM(`unitcost`*`count`) FROM `orders_item` WHERE `order_id`='".$rw['id']."' "),0,0);
			$total_cost = number_format($total_cost)." ".tab__temp("money_unit");
			?>
			<tr>
				<th class="ltr"><?=$rw['id']?></th>
				<td><?=$count?></td>
				<td><?=$total_cost?></td>
				<td><?=substr(U2Vaght($rw['date']),0,10)?></td>
				<td><?=($rw['date_paid']?"<div class='payment2'>".substr(U2Vaght($rw['date_paid']),0,10)."</div>":"<a class='payment' href='./billing-payment".$rw['id']."'>پرداخت</a>")?></td>
				<td><?=($rw['date_sent']?substr(U2Vaght($rw['date_sent']),0,10):"ارسال نشده")?></td>
				<td>
					<a href="./?page=<?=$_REQUEST['page']?>&do=<?=$_REQUEST['do']?>&do2=detail&id=<?=$rw['id']?>" class="submit_button">مشاهده</a>
				</td>
			</tr>
			<?
		}
		?>
		<tr><td colspan="6"></td></tr>
		<tr>
			<th>#</th>
			<th>تعداد کالا</th>
			<th>مبلغ کل</th>
			<th>تاریخ سفارش</th>
			<th>تاریخ پرداخت</th>
			<th>تاریخ ارسال</th>
			<th></th>
		</tr>
		</table>
		<?
	}

	$link = "./?page=".$_REQUEST['page']."&do=".$_REQUEST['do']."&p=";
	echo listmaker_paging($query, $link, $tdd);
}

