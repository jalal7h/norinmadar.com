<?

# list of payments done by user

function billing_userpanel_list(){
	if(!$uid = $_SESSION['uid']){
		echo __FUNCTION__.__LINE__;
		die();
	}
	
	$tdd = 5;
	$p = intval($_REQUEST['p']);
	$stt = $tdd * $p;
	$query = " SELECT * FROM `billing_invoice` WHERE `date`>0 AND `uid`='$uid' ORDER BY `date` DESC LIMIT $stt,$tdd ";
	if(!$uid = $_SESSION['uid']){
		die();
	} else if(!$rs = dbq($query)){
		e(__LINE__);
	} else if(dbn($rs)==0){
		echo "<div class='convbox' >هنوز صورتحسابی برای شما ثبت نشده است.</div>";
	} else {
		?>
		<table class="billing_userpanel_list">
		<tr>
			<th>#</th>
			<th>مبلغ</th>
			<th>روش پرداخت</th>
			<th>تاریخ</th>
		</tr>
		<tr><td colspan="4"></td></tr>
		<?
		while($rw = dbf($rs)){
			if(is_numeric($rw['method'])){
				$paymentmethod_name = cat_translate($rw['method']);
			} else {
				$paymentmethod_name = $GLOBALS['payment_method'][$rw['method']];
			}
			?>
			<tr>
				<th class="ltr"><?=$rw['id']?></th>
				<td><?=number_format($rw['cost'])." ".tab__temp("money_unit")?></td>
				<td><?=$paymentmethod_name?></td>
				<td><?=substr(u2vaght($rw['date']),0,16)?></td>
			</tr>
			<?
		}
		?>
		</table>
		<?
	}

	$link = "./?page=".$_REQUEST['page']."&do=".$_REQUEST['do']."&p=";
	echo listmaker_paging($query, $link, $tdd);

	billing_userpanel_credit();
	
}
