<?

function billing_management_stat_total(){
	#
	# today
	$date = substr( U2Vaght( U() ) , 0 , 10) ;
	$list = array (
		"skipwallet" => true ,
		"date" => array ("day" => $date)
	);
	$stat_today = number_format( billing_stat_payment( $list ) );
	#
	# yesterday
	$date_yesterday = substr( U2Vaght( U()-(24*3600) ) , 0 , 10) ;
	$list = array (
		"skipwallet" => true ,
		"date" => array ("day" => $date_yesterday)
	);
	$stat_yesterday = number_format( billing_stat_payment( $list ) );
	#
	# week
	$list = array (
		"skipwallet" => true ,
		"date" => array ("week" => $date)
	);
	$stat_week = number_format( billing_stat_payment( $list ) );
	#
	# month
	$list = array (
		"skipwallet" => true ,
		"date" => array ("month" => $date)
	);
	$stat_month = number_format( billing_stat_payment( $list ) );
	#
	# year
	$list = array (
		"skipwallet" => true ,
		"date" => array ("year" => $date)
	);
	$stat_year = number_format( billing_stat_payment( $list ) );
	#
	# total
	$list = array (
		"skipwallet" => true
	);
	$stat_total = number_format( billing_stat_payment( $list ) );
	
	echo "
	<div class='billing_management_stat_total'>
		<div>
			<span>امروز :‌ </span>
			<span>$stat_today تومان</span>
		</div>
		<div>
			<span>دیروز :‌ </span>
			<span>$stat_yesterday تومان</span>
		</div>
		<div>
			<span>هفته :‌ </span>
			<span>$stat_week تومان</span>
		</div>
		<div>
			<span>ماه :‌ </span>
			<span>$stat_month تومان</span>
		</div>
		<div>
			<span>سال :‌ </span>
			<span>$stat_year تومان</span>
		</div>
		<div>
			<span>کل :‌ </span>
			<span>$stat_total تومان</span>
		</div>
	</div>";
}






