<?

function users_login_form(){
	switch ($_REQUEST['do']) {
		case 'login_do':
			users_login_do();
			break;
	}
	if($_SESSION['uid']){
		header("Location: ./userpanel");
		die();
	}
	?>
	<form method="post" action="./login" id="users_login_form" >
	<input type="hidden" name="do" value="login_do"/>
		<div class="container"> 
			<div class="d01">ورود</div>
			<div class="d02">اگر هنور عضو نیستید، الان <a href="./register">ثبت نام</a> کنید.</div>
			<input type="text" name="username" placeholder="پست الکترونیک" dir="ltr" />
			<input type="password" name="password" placeholder="کلمه عبور" dir="ltr" />
			<div class="d03">شما با کلیک کردن روی دکمه ثبت نام موافقت می کنید که تمامی <a href="./terms">قوانین سایت</a> را پذیرفته اید.</div>
			<input type="submit" value="ورود" />
			<a class="d04" href="./forgot">کلمه عبورام را فراموش کرده ام</a>
		</div>
	</form>
	<?
}

