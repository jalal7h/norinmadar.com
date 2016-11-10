<?

function billing_userpanel_payment_offline(){

	switch ($_REQUEST['do3']) {
		case 'save':
			return billing_userpanel_payment_offline_save_n_congragulate();
	}

	?>
	<form class="billing_userpanel_payment_offline" action="./?page=<?=$_REQUEST['page']?>&do=<?=$_REQUEST['do']?>&do2=<?=$_REQUEST['do2']?>&method=<?=$_REQUEST['method']?>&cost=<?=$_REQUEST['cost']?>&do3=save" method="post">
		
		<h1>فرم پرداخت بانکی</h1>
		
		<div>
			<span>بانک : </span>
			<input type="text" readonly="1" value="<?=table('billing_method',$_REQUEST['method'],'c1','method')?>" />
		</div>
		
		<div>
			<span>مبلغ : </span>
			<input type="text" readonly="1" value="<?=number_format($_REQUEST['cost'])." ".tab__temp("money_unit");?>" />
		</div>
		
		<div>
			<span>شماره تراکنش / سریال : </span>
			<input type="text" dir="ltr" name="transaction" />
		</div>

		<div>
			<span>تاریخ پرداخت :‌ </span>
			<input type="text" class="calendar" name="date" />
		</div>
		<div><centeR>
			<span></span>
			<input type="submit" class="submit_button" value="ثبت پرداخت"/>

		</div>
	</form>
	<?
}
