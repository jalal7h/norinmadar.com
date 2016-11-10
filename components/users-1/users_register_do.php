<?

function users_register_do(){
	if(!$username = trim($_REQUEST['username'])){
		echo "<script>alert('لطفا آدرس ایمیل خود را وارد کنید.'); history.go(-1);</script>";
		die();
	} else if(!$password = trim($_REQUEST['password'])){
		echo "<script>alert('لطفا آدرس ایمیل خود را وارد کنید.'); history.go(-1);</script>";
		die();
	} else if(!$name = trim($_REQUEST['name'])){
		echo "<script>alert('لطفا آدرس ایمیل خود را وارد کنید.'); history.go(-1);</script>";
		die();
	}

	if($_SESSION['uid']){
		header("Location: ./userpanel");
		die();
	} else if(!$rs = dbq(" SELECT COUNT(*) FROM `users` WHERE `username`='$username' LIMIT 1 ")){
		echo "err - ".__LINE__;
	} else if(dbr($rs,0,0)=='1'){
		echo "<div class='convbox' >حساب کاربری با آین آدرس ایمیل قبلا ثبت شده است</div>";
	} else if(!dbq(" INSERT INTO `users` (`username`,`password`,`name`) VALUES ('$username','$password','$name') ")){
		echo "err - ".__LINE__;
		echo dbe();
		echo " INSERT INTO `users` (`username`,`password`,`name`) VALUES ('$username','$password','$name') ";
	} else {

		#
		# sending email to client after registration
		if( function_exists("msg") ){
			msg( $username , "users_register_do" , array(
				"main_title"=>tab__temp("main_title"),
				"user_name"=>$name,
				"username"=>$username,
				"password"=>$password,
				"_URL"=>_URL,
			) );
		}
		
		#
		# congragulating cient
		?>
		<div class="convbox">
			<img style="float: right; margin-left: 20px;" src="http://parsunix.com/cdn/img/checked11.png" />
			ثبت نام با موفقیت انجام شد!
			<br><a href="./userpanel">ورود به محیط کاربری</a>
			<div style="clear: both;"></div>
		</div>
		<br><br><br>
		<?

		# 
		# loging in client
		$_SESSION['uid'] = table("users", $username, "id", "username");
	}
}

