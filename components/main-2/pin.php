<?

function SendPinNumber($username,$pin){
	$send_cont="please try the last sent pin-code\nyour pin-code is: ".$pin."\n\n_______________\nRegards";
	if(!send_mail( $username, "pin-code for admin login, t:".date("H:i:s"), $send_cont, tab__temp('email_address_webadmin'))){
		echo "unable to send pin-code";
		die();
	} else {
		return true;
	}
}

function InsertPinForm($username){
	f_admin__a_html__header();
	?>
	<form name="pFORM" method="post" action="" autocomplete=off onsubmit="
		pFORM.pin.value=document.getElementById('PIN').value;
		document.getElementById('PIN').value='';
		document.getElementById('CNFRM').disabled=1;
	">
	<input type="hidden" name="page" value="<?=$_REQUEST['page']?>" >
	<center class="TX1">
	<table height="100%" width="500" cellpadding="5">
	<tr><td></td></tr>
	<tr height="10"><td>
	<table width="100%" cellpadding="0" cellspacing="1" bgcolor="#d2d2d2"><tr><td>
	<table width="100%" dir="rtl" bgcolor="#F5F5F5" cellpadding="5" style="background-image:url('templates/<?=_THEME?>/admin/insertpincode.png'); background-repeat:no-repeat;">
		<tr height="50px"><td colspan="3"></td></tr>
		<tr><td colspan="3"></td></tr>
		<tr height="50"><td colspan="3">
			<?="<b>آي پي شما تغيير کرده است</b><br><br>براي حفظ امنيت شماره اي(pin-code) 
			که به آدرس ايميل شما<br>($username) ارسال شده را در فيلد زير وارد و تاييد کنيد<br>";
			?>
		</td></tr>
		<tr height="30px"><td colspan="3"></td></tr>
		<tr bgcolor="#a0a0a0" height="1px"><td colspan="3"></td></tr>
		<tr dir="rtl" height="10" bgcolor="#dde5e7">
			<td align="center" colspan="3">
				<?="<b>کد پين</b> را وارد کنيد <span style='font-size:10px; color:#828282'>(يراي نمونه 123-658)</span>" ?> : 
				<input type="text" dir="ltr" id="PIN"><input type="hidden" name="pin">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input style='font-size:12px; font-family:tahoma; width:80px' type="submit" value="ورود" id="CNFRM">
			</td>
		</tr>
		<tr bgcolor="#a0a0a0" height="1px"><td colspan="3"></td></tr>
		<tr><td colspan="3"></td></tr>
		<tr height="50px"><td colspan="3" align="center"><?=$GLOBALS['PINPROMPT']?></td></tr>
	</table>
	
	</td></tr></table>
	</td></tr>
	<tr><td></td></tr>
	</table>
	
	</center>
	</form>
	<br>
	<?
	f_admin__a_html__footer();
	die();
}


function knownIP($username,$AdminAcc=false){
	
	return true;

	// if($AdminAcc){
	// 	$addQuery=" and `permission`>1 ";
	// }
	// if(!$res=db_query(" select `_ip`,`_pin` from `users` where 1 and `username`='$username' $addQuery limit 1 ")){
	// 	IncAtc();
	// 	echo "invalid mysql-query";
	// 	return false;
	// } else if(mysql_num_rows($res)!=1){
	// 	IncAtc();
	// 	echo "invalid username";
	// 	return false;
	// } else { // user exists.
	// 	$rec=mysql_fetch_array($res);
	// 	if($rec['_ip']!=$_SERVER['REMOTE_ADDR']){ // unknown ip.
	// 		if($_POST['pin']!=$rec['_pin']){ // invalid pin, or no pin submited.
	// 			if($_POST['pin']){ // invalid pin submited.
	// 				$GLOBALS['PINPROMPT']="incorrect pin";
	// 				IncAtc();
	// 			}
	// 			$pin=rand(111,999)."-".rand(111,999);
	// 			if(!db_query(" update `users` set `_pin`='$pin' where 1 and `username`='$username' $addQuery limit 1 ")){ // invalid query
	// 				IncAtc();
	// 				echo "invalid mysql-query";
	// 			} else {
	// 				SendPinNumber($username,$pin);
	// 				InsertPinForm($username);
	// 			}
	// 			die();
	// 		} else { // correct pin
	// 			if(!db_query(" update `users` set `_pin`='0',`_ip`='".$_SERVER['REMOTE_ADDR']."' where 1 and `username`='$username' $addQuery limit 1 ")){ // invalid query
	// 				IncAtc();
	// 				echo "invalid mysql-query";
	// 			} else {
	// 				return true;
	// 			}
	// 		}
	// 	} else { // known ip.
	// 		return true;
	// 	}
	// }
}



