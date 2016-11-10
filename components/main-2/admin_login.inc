<?

function admin_logged(){
	
	$rand = $_SESSION['hcfalf'];
	// e($rand);
	$su = 'ssus'.$rand;
	$sp = 'sspw'.$rand;
	
	if($_SESSION['admin'.$su]){
		return true;
	} else {
		return false;
	}
}

function admin_check( $username , $password ){
	if(empty($username)){
		return false;
	}
	if(empty($password)){
		IncAtc();
		return false;
	}
	$query = " select `username` from `users` where `username`='$username' and `password`='".$password."' and `permission`>1 limit 1 ";
	if(!$res = db_query($query)){
		IncAtc();
		return false;
	} else {
		if(mysql_num_rows($res)!=1){
			$_REQUEST['REPORT'] = "invalid username or password";
			IncAtc();
			return false;
		} else {
			return true;
		}
	}
}

function admin_login( $username , $password ){ // just first
	if(!$username){
		return false;
	}
	$rand=$_SESSION['hcfalf'];
	$fc=cpt('fc2#'.$rand, true);
	$sc=cpt('secn'.$rand, true);
	$su='ssus'.$rand;
	$sp='sspw'.$rand;
	$FixedCode=intval($_POST[$fc]);
	// $security_number=tab__temp('security_number');
	$security_number = $_SESSION['security_number'];
	if(!defined('__FC')){
		IncAtc();
		return false;
	} else if($FixedCode!=__FC){
		$_REQUEST['REPORT']="invalid Fix-Code";
		IncAtc();
		return false;
	} else if($_POST[$sc]!=$security_number) {
		$_REQUEST['REPORT']="invalid security-number";
		IncAtc();
		return false;
	} else {
		if(admin_check($username,$password)){
			$_SESSION['admin'.$su] = $username;
			$_SESSION['admin'.$sp] = $password;
			return true;
		} else {
			return false;
		}
	}
}

function admin_logout(){
	$rand=$_SESSION['hcfalf'];
	$su='ssus'.$rand;
	$sp='sspw'.$rand;
	$_SESSION['admin'.$su]=NULL;
	$_SESSION['admin'.$sp]=NULL;
	return true;
}

function admin_login_form(){
	$rand=rand(10000000,99999999);
	$_SESSION['hcfalf']=$rand;
	$us=cpt('user'.$rand, true);
	$pw=cpt('pass'.$rand, true);
	$fc=cpt('fc2#'.$rand, true);
	$sc=cpt('secn'.$rand, true);
	?>
	<form method="post" action="" >
	<input type="hidden" name="do" value="admin_login">
	
	<div class="admin_login_form" >
		<div class="legend">مدیریت سایت</div>
		<div class="container">
		<input placeholder="Username .." type="text" class="username" name="<?=$us?>" >
		<input placeholder="Password .." type="password" class="password" name="<?=$pw?>" >
		<input placeholder="FC2" maxlength="3" type="password" class="fc2 numeric" name="<?=$fc?>" title="کد مشخصه ثابت برای هر لایسنس" >
		<table cellpadding="0" cellspacing="0" ><tr>
		<td><input maxlength="4" type="text" name="<?=$sc?>" class="captcha numeric"></td>
		<td><img dir="rtl" class="captcha_img" title="این قسمت برای مقابله با روبوت های brute force در نظر گرفته شده، با وارد کردن شماره در فرم ادامه دهید" 
			src="<?=_URL?>/?do_action=admin_captcha&nocache=<?=rand(10000000,99999999)?>" >
		</td>
		<td><input type="submit" value="Login" class="submit" ></td>
		</tr></table>
		</div>
	</div>
	
	</form>
	<center class="TX2">&nbsp;<?=$_REQUEST['REPORT'] ?></center>
	<script type="text/javascript">
	$(document).ready(function(){
		$('.admin_login_form').css({'transform':'rotate(0deg)','opacity':'1.0'});
	});
	</script>
	<?
}








