<?

function billing_management_methods(){
	switch ($_REQUEST['do']) {
		
		case 'save':
			billing_management_methods_config_save();
			break;
			
		case 'form':
			return billing_management_methods_config_form();

		case 'install':
			billing_management_methods_install();
			break;

		case 'uninstall':
			billing_management_methods_uninstall();
			break;
			
	}
	echo "<div class='billing_management_methods'>";
	if(!sizeof($GLOBALS['billing_method'])){
		echo "<div style=margin-top:80px >هنوز درگاهی نصب نشده است</div>";
	} else foreach( $GLOBALS['billing_method'] as $method => $name ){
		$cost = number_format( billing_stat_payment( array("method" => $method) ) );

		if(!$rs = dbq(" SELECT * FROM `billing_method` WHERE `method`='$method' LIMIT 1 ")){
			e(__FUNCTION__.__LINE__);
		} else if(!dbn($rs)){
			// $installed = false;
			$inputs = "
			<input type='button' class='submit_button' value='نصب' onclick='location.href=\"./?page=".$_REQUEST['page']."&cp=".$_REQUEST['cp']."&func=".$_REQUEST['func']."&do=install&method=".$method."\"' />";
		} else {
			// $installed = true;
			$rw = dbf($rs);
			$inputs = "
			<input type='button' class='submit_button' value='تنظیمات' onclick='location.href=\"./?page=".$_REQUEST['page']."&cp=".$_REQUEST['cp']."&func=".$_REQUEST['func']."&do=form&method=".$method."\"' />
			<input type='button' class='submit_button' value='لغو' onclick='location.href=\"./?page=".$_REQUEST['page']."&cp=".$_REQUEST['cp']."&func=".$_REQUEST['func']."&do=uninstall&method=".$method."\"' />";
		}

		echo "<div class=r >
			<img src='image.list/billing_".$method.".png' />
			<span>جمع پرداختی ها از طریق درگاه ".$name." :‌ <b>".$cost."</b> ".tab__temp("money_unit")."</span>
			<div class='input-box'>".$inputs."</div>
		</div>";
	}
	echo "</div>";
}


