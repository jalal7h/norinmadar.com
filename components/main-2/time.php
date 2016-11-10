<?

# jalal7h@gmail.com
# 2015/06/27
# Version 8.0.1

function Vaght_2_Taghvim( $TIME,$HR=0,$CLEAR=0,$TDayFlag=false){
	
	$ALlDATE = array();
	
	if($TIME==''){
		return "not valid";
	}
	
	$TYear 	= @ substr($TIME, 0, 4);
	$TMont 	= @ substr($TIME, 5, 2);
	$TDate 	= @ substr($TIME, 8, 2);
	$E = @ substr($TIME, 11, 8);
	$TDay =  @ substr($TIME, 20, 1);
	
	switch( $TDay ){
		case 0 	:	{$TDAY = 'شنبه';break;}
		case 1 	:	{$TDAY = 'یکشنبه';break;}
		case 2 	:	{$TDAY = 'دوشنبه';break;}
		case 3 	:	{$T07DAY = 'سه شنبه';break;}
		case 4 	:	{$TDAY = 'چهارشنبه';break;}
		case 5 	:	{$TDAY = 'پنجشنبه';break;}
		case 6 	:	{$TDAY = 'جمعه';break;}
	}

	switch( $TMont ){
		case '01' 	:	{$TMONT = 'فروردین';break;}
		case '02' 	:	{$TMONT = 'اردیبهشت';break;}
		case '03' 	:	{$TMONT = 'خرداد';break;}
		case '04' 	:	{$TMONT = 'تیر';break;}
		case '05' 	:	{$TMONT = 'مرداد';break;}
		case '06'	:	{$TMONT = 'شهریور';break;}
		case '07' 	:	{$TMONT = 'مهر';break;}
		case '08' 	:	{$TMONT = 'آبان';break;}
		case '09' 	:	{$TMONT = 'آذر';break;}
		case '10' 	:	{$TMONT = 'دی';break;}
		case '11'	:	{$TMONT = 'بهمن';break;}
		case '12' 	:	{$TMONT = 'اسفند';break;}
	}
	
	$TIME = intval($TDate).'&nbsp;'.$TMONT.'&nbsp;'.$TYear;
	if($TDayFlag){
		$TIME = $TDAY.'&nbsp;'.$TIME;
	}
	
	if($HR)$TIME .= ' ساعت '.$E;
	if(!$CLEAR)$TIME = '<span dir='._DIR.' align=center>&nbsp;'.$TIME.'</span>';
	
	return $TIME;
}


function Time_2_Date( $TIME ,$HR=0,$CLEAR=0 ){

	$ALlDATE = array();	

	$TYear 	= substr($TIME, 2, 2);
	$TMont 	= substr($TIME, 5, 2);
	$TDate 	= substr($TIME, 8, 2);

	$E = substr($TIME, 11, 8);
	$TDay =  substr($TIME, 20, 1);

	switch( $TDay ){
		case 0 	:	{$TDAY = 'Saturday';break;}
		case 1 	:	{$TDAY = 'Sunday';break;}
		case 2 	:	{$TDAY = 'Monday';break;}
		case 3 	:	{$TDAY = 'Tuesday';break;}
		case 4 	:	{$TDAY = 'Wednesday';break;}
		case 5 	:	{$TDAY = 'Thursday';break;}
		case 6 	:	{$TDAY = 'Friday';break;}
	}

	switch( $TMont ){
		case '01' 	:	{$TMONT = 'January';break;}
		case '02' 	:	{$TMONT = 'February';break;}
		case '03' 	:	{$TMONT = 'March';break;}
		case '04' 	:	{$TMONT = 'April';break;}
		case '05' 	:	{$TMONT = 'May';break;}
		case '06'	:	{$TMONT = 'June';break;}
		case '07' 	:	{$TMONT = 'July';break;}
		case '08' 	:	{$TMONT = 'August';break;}
		case '09' 	:	{$TMONT = 'September';break;}
		case '10' 	:	{$TMONT = 'October';break;}
		case '11'	:	{$TMONT = 'November';break;}
		case '12' 	:	{$TMONT = 'December';break;}
	}

	$TIME = $TDAY.'&nbsp; '.$TDate.'&nbsp;'.$TMONT.'&nbsp;20'.$TYear;
	if($HR)$TIME.=' Time: '.$E;
	if(!$CLEAR)$TIME = '<span align=center class=TX1>&nbsp;'.$TIME.'</span>';

	return $TIME;
}


function Vaght2U($VAGHT){
	$TIME = Vaght2Time($VAGHT);
	$U = Time2U($TIME);
	return $U;
}


function U2Vaght($U){
	$TIME = U2Time($U);
	$VAGHT = Time2Vaght($TIME);
	return $VAGHT;
}


function Time2U($T){
	$H = intval( substr($T, 11, 2));
	$i = intval( substr($T, 14, 2));
	$s = intval( substr($T, 17, 2));
	$m = intval( substr($T, 5, 2));
	$d = intval( substr($T, 8, 2));
	$Y = intval( substr($T, 0, 4));
	$U = gmmktime($H, $i, $s, $m, $d, $Y, -1 );
	return $U;
}


function U2Time($U){
	if(!$U){
		return null;
	// } if($U>1542507122){
	// 	$d = date_create( "@2192806533 " );
	// 	return date_format( $d, 'Y.m.d H:i:s' );
	} else {
		return gmdate('Y/m/d H:i:s', $U)."|".gmdate('w', $U+86400);
	}
}


function MLD_2_SMSI( $TIME){
	$year = substr($TIME, 0, 4);
	$month = intval(substr($TIME, 5, 2));
	$day = intval(substr($TIME, 8, 2));
	$E = substr($TIME, 11,8);
	$Converter = new Converter;
	$g2j = $Converter->GregorianToJalali($year,$month,$day);
	$Y = $g2j[0];
	$M = addZiro($g2j[1]);
	$D = addZiro($g2j[2]);
	$W = gmdate('w', Time2U($TIME)+86400);
	$TIME = $Y . '-' . $M . '-' . $D . ' ' . $E . '|' . $W ;
	return $TIME;
}


function Time2Vaght($TIME){
	$year = substr($TIME, 0, 4);
	$month = intval(substr($TIME, 5, 2));
	$day = intval(substr($TIME, 8, 2));
	$E = substr($TIME, 11,8);
	$Converter = new Converter;
	$g2j = $Converter->GregorianToJalali($year,$month,$day);
	$D = addZiro($g2j[2]);
	$M = addZiro($g2j[1]);
	$Y = addZiro($g2j[0]);
	$W = gmdate('w', Time2U($TIME)+86400);
	$VAGHT = $Y . '/' . $M . '/' . $D . ' ' . $E . '|' . $W ;

	return $VAGHT;
}


function Vaght2Time($VAGHT){
	$sall = substr($VAGHT, 0, 4);
	$mah = intval(substr($VAGHT, 5, 2));
	$ruz = intval(substr($VAGHT, 8, 2));
	$E = substr($VAGHT, 11,8);
	$Converter = new Converter;
	$j2g = $Converter->JalaliToGregorian($sall, $mah, $ruz);
	$Y = $j2g[0];
	$M = addZiro($j2g[1]);
	$D = addZiro($j2g[2]);
	$W = gmdate('w', Time2U($Y.'.'.$M.'.'.$D." 12:00:00")+86400);
	$TIME = $Y . '.' . $M . '.' . $D . ' ' . $E . '|' . $W ;

	return $TIME;
}


function addZiro($Q){
	if($Q<10){
		return '0'.$Q;
	} else {
		return $Q;
	}
}


function FIX_U($U,$LEX=0){
	$xd = $U;
	$xd = $xd%31554850;
	$xd -= $xd%60;
	$xd -= $xd%3600;
	$xd -= $xd%86400;
	$xd /= 86400;
	if(($xd<243)&&($xd>79))
		if($LEX)$U-=3600;
		else $U+=3600;
	return $U;
}


function U2U($X='',$U){

	$U = FIX_U($U);
	
	$EE = $U;
	
	$Y = $U-($U%31554850);//.
	$U = $U%31554850;
	$s = $U%60 ;//.
	$U = $U - $U%60;
	$i = $U%3600;//.
	$U = $U - $U%3600;
	$H = $U%86400;//.
	$U = $U - $U%86400;
	$d = $U;//.

	for($F=0; $F<strlen($X); $F++){
		$K = substr($X,$F,1);
		if($K=='m' || $K=='d')return false;
		switch($K){
			case 'Y' :
				$EE -= $Y;
				break;
			case 'H' :
				$EE -= $H;
				break;
			case 'i' :
				$EE -= $i;
				break;
			case 's' :
				$EE -= $s;
				break;
		}
	}
	$EE = FIX_U($EE,1);
	return $EE;
}


function U($O=''){
	
	$U = gmdate("U");
	$SERVER_TIME_REGION  = (float)tab__temp('server_time_region');
	$U+=$SERVER_TIME_SECONDS;
	$U+=$SERVER_TIME_REGION*3600;
	
	$TIME= U2Time($U);

	if($O){
		switch($O){
			case 'Y' : return intval(substr($TIME, 0,4)); break;
			case 'm' : return intval(substr($TIME, 5,2)); break;
			case 'd' : return intval(substr($TIME, 8,2)); break;
			case 'H' : return intval(substr($TIME,11,2)); break;
			case 'i' : return intval(substr($TIME,14,2)); break;
			case 's' : return intval(substr($TIME,17,2)); break;
			case 'w' : return intval(substr($TIME,20,1)); break;
		}
	} else {
		return $U;
	}
}






/* *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** 
* GregorianToJalali & JalaliToGregorian Converter
* GregorianToJalali Function source : http://www.farsiweb.info/jalali/jalali.phps
*
*
*	$test = new Converter;
*		$g2j = $test->GregorianToJalali('2000','10','10');
*			echo $g2j[0]." ".$g2j[1]." ".$g2j[2];
*		$j2g = $test->JalaliToGregorian('1386','12','26');
*			echo $j2g[0]." ".$j2g[1]." ".$j2g[2];
*
*/
class Converter {
	
var $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
var $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);

function GregorianToJalali($g_y, $g_m, $g_d)
{
	$g_days_in_month = $this->g_days_in_month;
	$j_days_in_month = $this->j_days_in_month;

	$gy = $g_y-1600;
	$gm = $g_m-1;
	$gd = $g_d-1;

	$g_day_no = 365*$gy+$this->div($gy+3,4)-$this->div($gy+99,100)+$this->div($gy+399,400);

	for ($i=0; $i < $gm; ++$i)
		$g_day_no += $g_days_in_month[$i];
	if ($gm>1 && (($gy%4==0 && $gy%100!=0) || ($gy%400==0)))
	/* leap and after Feb */
		++$g_day_no;
	$g_day_no += $gd;

	$j_day_no = $g_day_no-79;

	$j_np = $this->div($j_day_no, 12053);
	$j_day_no %= 12053;

	$jy = 979+33*$j_np+4*$this->div($j_day_no,1461);

	$j_day_no %= 1461;

	if ($j_day_no >= 366) {
		$jy += $this->div($j_day_no-1, 365);
		$j_day_no = ($j_day_no-1)%365;
	}

	for ($i = 0; $i < 11 && $j_day_no >= $j_days_in_month[$i]; ++$i) {
		$j_day_no -= $j_days_in_month[$i];
	}
	$jm = $i+1;
	$jd = $j_day_no+1;
	return array($jy, $jm, $jd);
}

function JalaliToGregorian($year,$month,$day){
	$gDaysInMonth = $this->g_days_in_month;
	$jDaysInMonth = $this->j_days_in_month;
	$jy=$year-979;
	$jm=$month-1;
	$jd=$day-1;
	$jDayNo=365*$jy + $this->div($jy,33)*8 + $this->div((($jy%33)+3),4);
		for ($i=0; $i < $jm; ++$i)  
		$jDayNo += $jDaysInMonth[$i];
	$jDayNo +=$jd;
	$gDayNo=$jDayNo + 79;
	//146097=365*400 +400/4 - 400/100 +400/400
	$gy=1600+400*$this->div($gDayNo,146097);
	$gDayNo = $gDayNo%146097;
	$leap=1;
	if($gDayNo >= 36525)
	{
		$gDayNo =$gDayNo-1;
		//36524 = 365*100 + 100/4 - 100/100
		$gy +=100* $this->div($gDayNo,36524);
		$gDayNo=$gDayNo % 36524;

		if($gDayNo>=365)
		$gDayNo = $gDayNo+1;
		else
		$leap=0;
	}
	//1461 = 365*4 + 4/4
	$gy += 4*$this->div($gDayNo,1461);
	$gDayNo %=1461;
	if($gDayNo>=366)
	{
		$leap=0;
		$gDayNo=$gDayNo-1;
		$gy += $this->div($gDayNo,365);
		$gDayNo=$gDayNo %365;
	}
	$i=0;
	$tmp=0;
	while ($gDayNo>= ($gDaysInMonth[$i]+$tmp))
	{
		if($i==1 && $leap==1)
		$tmp=1;
		else
		$tmp=0;

		$gDayNo -= $gDaysInMonth[$i]+$tmp;
		$i=$i+1;
	}
	$gm=$i+1;
	$gd=$gDayNo+1;
	return array($gy, $gm, $gd);
}


function div($a, $b) {
   return (int) ($a / $b);
}

}//Class END


$GLOBALS['do_action'][] = "echo_date";

function echo_date(){
    echo date("Y/m/d H:i:s", U());
}
