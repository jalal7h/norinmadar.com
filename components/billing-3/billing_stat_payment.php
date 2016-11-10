<?

// $list = array (
// 	"uid" => "11" ,
// 	"method" => "mellat" ,
// 	"skipwallet" => true ,
// 	"date" => array ( 
// 		"day" => "1394/12/12" , // the day
// 		"week" => "1394/12/12" , // end day
// 		"month" => "1394/12/12" , // end day
// 		"monthIn" => "1394/12" , // this month
// 		"year" => "1394/12/12" , // end day
// 		"yearIn" => "1394" , // this year
// 	) ,
// );
// echo billing_stat_payment( $list );

function billing_stat_payment( $list ){
	$q = " SELECT SUM(`cost`) FROM `billing_invoice` WHERE `date`>0 ";
	if($uid = $list['uid']){
		$q.= " AND `uid`='$uid' ";
	}
	if($method = $list['method']){
		$q.= " AND `method`='$method' ";
	}
	if($list['skipwallet']){
		$q.= " AND `method`!='wallet' ";
	}
	if($date = $list['date']){
		foreach ($date as $k => $d) {
			switch ($k) {
				case 'day':
					$d = $d." 00:00:00";
					$d = vaght2u($d);
					$date_from = $d;
					$date_to = $d + (3600 * 24);
					break;

				case 'week':
					$d = $d." 23:59:59";
					$d = vaght2u($d);
					$date_to = $d;
					$date_from = $d - (3600 * 24 * 7);
					break;

				case 'month':
					$d = $d." 23:59:59";
					$d = vaght2u($d);
					$date_to = $d;
					$date_from = $d - (3600 * 24 * 30);
					break;
				
				case 'monthIn':
					$d_month = substr($d, 5, 2);
					$day_max = ($d_month<=6?31:($d_month==12?29:30));
					$date_from = vaght2u( $d."/01 00:00:00" );
					$date_to = vaght2u( $d."/$day_max 23:59:59" );
					break;
				
				case 'year':
					$d = $d." 23:59:59";
					$d = vaght2u($d);
					$date_to = $d;
					$date_from = $d - (3600 * 24 * 365);
					break;

				case 'yearIn':
					$d_year = substr($d, 0, 4);
					$date_from = vaght2u( $d."/01/01 00:00:00" );
					$date_to = vaght2u( $d."/12/29 23:59:59" );
					break;
			}
			break;
		}
		$q.= " AND (`date`>'$date_from' AND `date`<'$date_to') ";
	}
	// e($q);
	if(!$rs = dbq( $q )){
		e(__LINE__);
	} else {
		return (int) dbr($rs,0,0);
	}
}



