<?

function users_profile_save(){
	if(!$uid = $_SESSION['uid']){
		$prompt = "error on ".__LINE__;
	} else if(!$rw = table("users", $uid)){
		$prompt = "error on ".__LINE__;
	} else if(!$name = trim(strip_tags($_REQUEST['name'])) ){
		$prompt = "لطفا نام خود را به درستی وارد کنید!";
	} else if(!$username = trim(strip_tags($_REQUEST['username'])) ){
		$prompt = "لطفا آدرس ایمیل خود را به درستی وارد کنید!";
	} else {
		$tell = trim(strip_tags($_REQUEST['tell']));
		$cell = trim(strip_tags($_REQUEST['cell']));
		if(!dbq(" UPDATE `users` SET `name`='$name',`username`='$username',`tell`='$tell',`cell`='$cell' WHERE `id`='$uid' LIMIT 1 ")){
			$prompt = "error on ".__LINE__;
		} else {
			$prompt = "اطلاعات شما با موفقیت بروز شد.";
		}
		echo "<div style='width: 70%; margin: 100px auto 110px auto;' class='convbox'>$prompt</div>";
	}
}

