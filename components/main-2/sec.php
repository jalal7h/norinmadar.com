<?php

function cpt($string, $dynamic=false){
	
	return $string;
	
	// if($dynamic){
	// 	$string=date("Ymd").$string;
	// }
	// $string=sha1($string);
	// $string=md5($string."mc");
	// return $string;	
}

function IncAtc(){
	tab__temp('unsuccessful_attack',true,intval(tab__temp('unsuccessful_attack'))+1);
	
	return true;
}

function checkPublicSecuity(){
	/**
	 * $BrowserInfo=detectBrowserInfo();
	 * if(!in_array($BrowserInfo['browser'],array('IE','FIREFOX'))){
	 * 	echo "<br><br><br><br><br><br><br><center style='font-family:tahoma; font-size:40px; color:#b10000;'>Invalid Browser</center>";
	 * 	die();
	 * }
	**/
	if(intval(getVersionGd())==0){
		$prompts[]="+ GD Library not enabled, enabled it!<br>";
	}
	
	// if((int)ini_get('magic_quotes_gpc')==0){
	// 	$prompts[]="+ Magic quotes not enabled, enabled it!<br>";
	// }
	
 	if((int)ini_get('register_globals')!=0){
 		$prompts[]="+ Register globals is enabled, unable it!<br>";
 	}
	
	if($prompts){
		?>
		<table style="position:absolute; top:0px; left:0px;" width="100%" height="40" bgcolor="#ffe3df" cellpadding="0" cellspacing="0" >
			<tr height="10"><td colspan="2"></td></tr>
			<?
			for($i=0; $i<sizeof($prompts); $i++){
				?><tr><td width="30"></td><td style="color:#540a00;"><?=$prompts[$i]?></td></tr><?
			}
			?>
			<tr height="10"><td colspan="2"></td></tr>
			<tr height="1" bgcolor="#ffffff"><td colspan="2"></td></tr>
			<tr height="1" bgcolor="#ff5900"><td colspan="2"></td></tr>
			<tr height="1" bgcolor="#ffb48b"><td colspan="2"></td></tr>
			<tr height="1" bgcolor="#ffede3"><td colspan="2"></td></tr>
		</table>
		<?
	}
}

function getVersionGd(){
	ob_start();
	phpinfo(8);
	$phpinfo = ob_get_contents();
	ob_end_clean();
	$phpinfo = strip_tags($phpinfo);
	$phpinfo = stristr($phpinfo, "gd version");
	$phpinfo = stristr($phpinfo, "version");
	if ($phpinfo === false && function_exists('gd_info')) {
		$phpinfo = gd_info();
		$phpinfo = $phpinfo['GD Version'];
	}
	$end = strpos($phpinfo, ".");
	$phpinfo = substr($phpinfo, 0, $end);
	$length = strlen($phpinfo) - 1;
	$phpinfo = substr($phpinfo, $length);
	$GLOBALS['gdInfo'] = $phpinfo;
	return $phpinfo;
}

function ipBinProgress(){
	$userIp=$_SERVER['REMOTE_ADDR'];
	$user_noaccess_delay=tab__temp('user_noaccess_delay');
	$date=U();
	$since=$date-$user_noaccess_delay;
	if(!$res=db_query(" select count(*) from `_ip_bin` where `_date`>='$since' ")){
		//echo "error fs252";
		return false;
	} else {
		//$now_access=(int)mysql_result($res,0,0);
		//$max_access=tab__temp('user_max_access');
		//if($now_access>=$max_access){
		//	$rand=$_SESSION['hcfalf'];
		//	$su='ssus'.$rand;
		//	if(!$_SESSION['admin'.$su]){
		//		echo "<br><br><br><br><br><br><br><br><center style='font-size:40px; font-family:tahoma; color:#8b0000;' >Invalid Access</center>";
		//		die();
		//	}
		//}
	}
	if(!db_query(" insert into `_ip_bin` (`_ip`,`_date`) values ('$userIp','$date') ")){
		echo "error fs275: ".mysql_error();
		return false;
	}
}











