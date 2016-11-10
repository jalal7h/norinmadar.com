<?

function billing_userpanel_credit(){
	echo "<div class='billing_userpanel_credit'>
		<span>اعتبار شما :‌ </span>
		<span style='font:bold 16px BYekan;'>".number_format(billing_userCredit($_SESSION['uid']))."</span> تومان
	</div>";
}


