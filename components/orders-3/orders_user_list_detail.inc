<?

function orders_user_list_detail( $order_id ){
	#
	# list of items
	if(!$rw_orders = table("orders",$order_id)){
		e("orders_user_list_detail - ".__LINE__);
	} else if(!$rs_item = dbq(" SELECT * FROM `orders_item` WHERE `order_id`='$order_id' ")){
		e("orders_user_list_detail - ".__LINE__);
	} else {
		?>
		<div class="orders_user_list_detail" >
		<table cellpadding="10" cellspacing="5px">
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
				$total_cost+= orders_user_list_detail_this($rw_item);
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

		<center>
		<?
		
		if(!$rw_orders['date_paid']){
			?>
			<div class="convbox">پرداخت هنوز انجام نشده است</div>
			<?
		} else {
			//
		}
		if(!$rw_orders['date_sent']){
			
		} else {
			?>
			<div class="convbox convgreen">تاریخ ارسال <b dir=ltr ><?=substr(U2Vaght($rw_orders['date_sent']),0,16)?></b></div>
			<?
		}
		?>
		</center>
		</div>
		<?
	}
}

function orders_user_list_detail_this($rw_item){
	$id = $rw_item['product_id'];
	$count = $rw_item['count'];
	$rw = table( _products_table , $id);
	$name = $rw['name'];
	$cost = number_format(intval($rw['cost']))." ".tab__temp("money_unit");
	$total = $rw['cost'] * $count;
	$r = $total;
	$total = number_format($total)." ".tab__temp("money_unit");
	$link = "./".$rw['id']."-".name_for_link($rw['name']).".html";
	?>
	<tr>
		<td><a href="<?=$link?>" target="_blank" ><img src="resize/70x70/<?=$rw['pic']?>" /></a></td>
		<td><a href="<?=$link?>" target="_blank" ><?=$name?></a></td>
		<td><?=$count?></td>
		<td><?=$cost?></td>
		<td><?=$total?></td>
	</tr>
	<?
	
	return $r;
}

