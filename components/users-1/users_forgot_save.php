<?

function users_forgot_save(){
	if(!$email = trim(strip_tags($_REQUEST['email'])) ){
		echo "err - ".__LINE__;
		die();
	}
	$h = sha1($email."01q!");
	if($_REQUEST['h']!=$h){
		echo "err - ".__LINE__;
		die();
	} else if(!$password = trim(strip_tags($_REQUEST['password'])) ){
		echo "err - ".__LINE__;
	} else if(!dbq(" UPDATE `users` SET `password`='$password' WHERE `email`='$email' LIMIT 1 ")){
		echo "err - ".__LINE__;
	} else {
		$_SESSION['uid'] = table("users", $email, "id", "email");
		echo "<div style='width: 70%; margin: 120px auto 120px auto;' class='convbox'>We have set the new password on your account.<br>now you are logged in.<br><br><a href='./userpanel'>Go to user panel</a></div>";
	}
}

