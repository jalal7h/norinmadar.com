<?

function users_changepassword_save(){
	if(!$uid = $_SESSION['uid']){
		$prompt = "error on ".__LINE__;
	} else if(!$rw = table("users", $uid)){
		$prompt = "error on ".__LINE__;
	} else if($rw['password']!=trim(strip_tags($_REQUEST['old_password']))){
		$prompt = "کلمه عبور به درستی وارد نشده است";
	} else if(!$password = trim(strip_tags($_REQUEST['password'])) ){
		$prompt = "error on ".__LINE__;
	} else if(!dbq(" UPDATE `users` SET `password`='$password' WHERE `id`='$uid' LIMIT 1 ")){
		$prompt = "error on ".__LINE__;
	} else {
		$prompt = "کلمه عبور جدید شما با موفقیت ثبت شد.";
	}
	echo "<div style='width: 70%; margin: 100px auto 110px auto;' class='convbox'>$prompt</div>";
}

