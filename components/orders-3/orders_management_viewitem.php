<?

function orders_management_viewitem(){
	#
	# list of items
	if(!$order_id = $_REQUEST['id']){
		e(__FILE__.__LINE__);
	} else if(!$rw_orders = table("orders",$order_id)){

	} else if(!$rs_item = dbq(" SELECT * FROM `orders_item` WHERE `order_id`='$order_id' ")){

	} else {
		?>
		<form class="orders_management_viewitem" name="f0" method="post" action="./orders-basket-confirm" onsubmit="f0checkform();" >
		<table cellpadding="10" cellspacing="5">
			<tr>
				<th></th>
				<th>شرح محصول</th>
				<th>تعداد</th>
				<th>قیمت واحد</th>
				<th>قیمت کل</th>
			</tr>
			<tr class="header-delimiter"><td colspan="5"></td></tr>
			<?
			while($rw_item = dbf($rs_item)){
				$total_cost+= orders_management_viewitem_thisitem($rw_item);
			}
			$total_cost = number_format($total_cost)." ".tab__temp("money_unit");
			?>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><?=$total_cost?></td>
			</tr>
		</table>

		<div class="path">
			<div class="name">
				نام کاربر:<br>
				<a target="_blank" href="./?page=admin&cp=billing_management&func=billing_management_users&do=invoice_list&id=<?=$rw_orders['uid']?>" ><?=table("users", $rw_orders['uid'], "name")?></a>
			</div>
			<div class="address">آدرس : <br><?=$rw_orders['address']?></div>
			<div class="tell">شماره تماس : <br><?=$rw_orders['tell']?></div>
		</div>

		<center>
		<?
		
		if(!$rw_orders['date_paid']){
			?>
			<div class="convbox">پرداخت هنوز انجام نشده است</div>
			<?
		} else {
			?>
			<div class="convbox convgreen">تاریخ پرداخت <b dir=ltr ><?=substr(U2Vaght($rw_orders['date_paid']),0,16)?></b></div>
			<?
		}
		if(!$rw_orders['date_sent']){
			
		} else {
			?>
			<div class="convbox convgreen">تاریخ ارسال <b dir=ltr ><?=substr(U2Vaght($rw_orders['date_sent']),0,16)?></b></div>
			<?
		}
		if($rw_orders['date_paid']>0 and $rw_orders['date_sent']==0){
			?>
			<a class="sendbutton" href="./?page=admin&cp=<?=$_REQUEST['cp']?>&func=orders_management_notsentpaid&p=&do=sent&id=<?=$order_id?>">ارسال</a>
			<?
		}
		?>
		</center>
		</form>
		<?
	}

	// total cost

	// address and phone

	// send button if its not sent and its paid

	// if paid, list of payments
}

function orders_management_viewitem_thisitem($rw_item){
	$id = $rw_item['product_id'];
	$count = $rw_item['count'];
	$rw = table( _products_table , $id);
	$name = $rw['name'];
	$cost = number_format($rw['cost'])." ".tab__temp("money_unit");
	$total = $rw['cost'] * $count;
	$r = $total;
	$total = number_format($total)." ".tab__temp("money_unit");
	$link = "./".$rw['id']."-".name_for_link($rw['name']).".html";
	?>
	<tr>
		<td><a href="<?=$link?>"><img src="resize/50x60/<?=$rw['pic']?>" /></a></td>
		<td><a href="<?=$link?>"><?=$name?></a></td>
		<td><?=$count?></td>
		<td><?=$cost?></td>
		<td><?=$total?></td>
	</tr>
	<?

	return $r;
}

