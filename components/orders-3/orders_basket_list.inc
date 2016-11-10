<?

function orders_basket_list(){
	
	#
	# stop if user logged in.
	if(!$uid = $_SESSION['uid']){
		echo "<script>location.href='./login'</script>";
		die();
	}

	#
	# switch 1
	switch($_REQUEST['do']){
		case 'add' :
			return orders_basket_add();
	}

	#
	# stop if basket is empty
	if(!sizeof($_SESSION['orders_basket'])){
		echo "err - ".__LINE__;
		return false;
	}

	#
	# switch 2
	switch($_REQUEST['do']){

		case 'count':
			orders_basket_count();
			break;

		case 'remove':
			unset($_SESSION['orders_basket'][intval($_REQUEST['id'])]);
			break;

		case 'confirm':
			return orders_basket_confirm();
	}
	
	#
	# get the last address / tell from orders
	if(!$order_last_rs = dbq(" SELECT * FROM `orders` WHERE `uid`='$uid' AND `address`!='' ORDER BY `date` DESC LIMIT 1 ")){
		echo "err - ".__LINE__;
		echo dbe();
	} else if(dbn($order_last_rs)>0){
		$order_address = dbr($order_last_rs, 0, 'address');
		$order_tell = dbr($order_last_rs, 0, 'tell');

	}

	?>
	<form class="orders_basket_list" name="f0" method="post" action="./orders-basket-confirm" onsubmit="f0checkform();" >
	<a class="confirm-button" href="#" onclick="f0checkform();" style="background-image: url('<?=imgp('purchase_button.png')?>');"></a>
	<table>
		<tr>
			<th></th>
			<th>شرح محصول</th>
			<th>تعداد</th>
			<th>قیمت واحد</th>
			<th>قیمت کل</th>
			<th></th>
		</tr>
		<?
		foreach ($_SESSION['orders_basket'] as $id => $count) {
			$total_cost+= orders_basket_list_this($id,$count);
		}
		$total_cost = number_format($total_cost)." ".tab__temp("money_unit");
		?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td><?=$total_cost?></td>
			<td></td>
		</tr>
	</table>

	<div class="path">
		<input type="text" name="address" placeholder="آدرس پستی" class="address" value="<?=$order_address?>"/>
		<input type="text" name="tell" placeholder="شماره تماس" class="tell" value="<?=$order_tell?>"/>
	</div>

	<a class="confirm-button" href="#" onclick="f0checkform();" style="background-image: url('<?=imgp('purchase_button.png')?>');"></a>
	</form>
	<script type="text/javascript">
		function f0checkform(){
			if(f0.address.value==''){
				alert('لطفا آدرس خود را وارد کنید.');
			} else if(f0.tell.value==''){
				alert('لطفا شماره تماس خود را وارد کنید.');
			} else {
				f0.submit();
			}
		}
	</script>
	<?
}

function orders_basket_list_this( $id , $count ){
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
		<td>
			<select id="select-tag-<?=$id?>" onchange="location.href='./?page=<?=$_REQUEST['page']?>&do=count&id=<?=$id?>&count='+this.value">
				<?
				for($i=1; $i<=20; $i++){
					$options.= "<option value='".$i."'>".$i."</option>";
				}
				for($i=25; $i<=50; $i+=5){
					$options.= "<option value='".$i."'>".$i."</option>";
				}for($i=60; $i<=100; $i+=10){
					$options.= "<option value='".$i."'>".$i."</option>";
				}
				for($i=200; $i<=1000; $i+=100){
					$options.= "<option value='".$i."'>".$i."</option>";
				}
				echo $options;
				?>
			</select>
			<script>$('#select-tag-<?=$id?>').val('<?=$count?>')</script>
		</td>
		<td><?=$cost?></td>
		<td><?=$total?></td>
		<td>
			<a href="./?page=<?=$_REQUEST['page']?>&do=remove&id=<?=$id?>" class="delete" style="background-image:url(<?=imgp('delete_button.png')?>);" ></a>
		</td>
	</tr>
	<?

	return $r;
}

