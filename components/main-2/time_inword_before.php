<?

function time_inword_before( $U ){
	$now = U();
	$aMinute = 60;
	$anHour = $aMinute * 60;
	$aDay = $anHour * 24;
	$aMonth = $aDay * 30;
	
	$diff = $now - $U;
	
	if($diff > $aMonth){
		return ceil($diff/$aMonth)." ماه قبل";
	} else if($diff > $aDay){
		return ceil($diff/$aDay)." روز قبل";
	} else if($diff > $anHour){
		return ceil($diff/$anHour)." ساعت قبل";
	} else if($diff > $aMinute){
		return ceil($diff/$aMinute)." دقیقه قبل";
	} else {
		return ceil($diff)." ثانیه قبل";
	}
}

