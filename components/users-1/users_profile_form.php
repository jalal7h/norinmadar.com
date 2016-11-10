<?

function users_profile_form(){
	
	switch($_REQUEST['do2']){
		case 'save':
			return users_profile_save();
	}

	if(!$uid = $_SESSION['uid']){
		die();
	} else if(!$rw = table("users", $uid)){
		die();
	}
	echo "<form id=users_profile_form method=post action='./?page=".$_REQUEST['page']."&do=".$_REQUEST['do']."&do2=save' onsubmit='return checkform_uprform();' name=uprform >
			<div class='container' >
				<div class=d01>پروفایل !</div>
				<input placeholder='نام و نام خانوادگی' type='text' name='name' value='".$rw['name']."' /><br>
				<input placeholder='آدرس ایمیل' type='text' name='username' value='".$rw['username']."' /><br>
				<input placeholder='شماره تلفن' type='text' name='tell' value='".$rw['tell']."' /><br>
				<input placeholder='شماره همراه' type='text' name='cell' value='".$rw['cell']."' /><br>
				<input type='submit' value='ثبت تغییرات' />
			</div>
		</form>";
		?>
		<script>
		function checkform_uprform(){
			if(uprform.name.value==''){
				alert("لطفا نام خود را درست وارد کنید!");
			} else if(uprform.username.value==''){
				alert("لطفا آدرس ایمیل خود را درست وارد کنید!‌");
			} else {
				return true;
			}
			return false;
		}
		</script>
		<?
}

