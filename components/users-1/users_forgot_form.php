<?

function users_forgot_form(){
	if($_SESSION['uid']){
		header("Location: ./userpanel");
		die();
	}
	switch ($_REQUEST['do']) {

		case 'send':
			return users_forgot_send();
		
		case 'new':
			return users_forgot_new();

		case 'save':
			return users_forgot_save();
	}
	?>
	<form method="post" action="./?page=<?=$_REQUEST['page']?>&do=send" id="users_forgot_form" >
		<div class="container"> 
			<div class="d01">فراموشی کلمه عبور!</div>
			<div class="d02">لطفا آدرس ایمیل خود را برای دریافت پیوند تنظیم مجدد کلمه عبور وارد نمایید.</div>
			<input type="text" name="username" placeholder="Email address" dir="ltr" />
			<input type="submit" value="ارسال درخواست" />
		</div>
	</form>
	<?
}

